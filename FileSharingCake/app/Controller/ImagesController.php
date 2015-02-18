<?php

class ImagesController extends AppController {

	public $components = array('Paginator');
	
	public $paginate = array(
			'limit' => 12,
			'order' => array(
					'Image.created' => 'asc'
			)
	);

	function beforeFilter(){
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	public function index() {
		$this->set('title_for_layout', 'FileSharing - Accueil');
		$this->render('index');
	}

	public function liste() {
		$this->set('title_for_layout', 'FileSharing - Gestion des images');

		if('admin' == $_SESSION['Auth']['User']['role']) {
			//Administrateur
			$total = $this->Image->find('count');
			$this->Paginator->settings = $this->paginate;
		} else {
			//User
			$total = $this->Image->find('count', array(
					'conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id'])));
			$this->Paginator->settings = array(
					'conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id'])
			);
		}

		// similaire à un findAll(), mais récupère les résultats paginés
		$this->Image->recursive = 1;
		$images = $this->Paginator->paginate('Image');
		$this->set(array('images'=>$images,'total' => $total));
		$this->render('liste');

	}

	public function add() {
		$listeFile = $this->request->data['Image']['files'];
		$multiOk=true;
		$message="";
		//debug($listeFile);
		//die();
 		foreach ($listeFile as $fichier) {
 			$filename = strtolower($fichier['name']);
 			$extension = strtolower(pathinfo($filename , PATHINFO_EXTENSION));
 			//break;
 			if ($fichier['size'] > 5242880 ) {
 				$message .= "Le fichier ".$fichier['name']."d&eacute;passe la limite autoris&eacute;e. ";
 				$multiOk = false;
 			} else if (! in_array($extension,array('png','jpeg','jpg'))) {
 				$message .= "Vous ne pouvez uploader que des fichiers de type PNG JPG ou JPEG. ";
 				$multiOk = false;
			} 			
 		}
 		
 		if($multiOk) {
 			$message = "";
 			foreach ($listeFile as $fichier) {
 				//Insertion 
 				$now = date("YmdHis");
 				$nomFichier = $now."-".mt_rand(1,300).".".$extension;
 				$destination = IMAGES.'data'.DS.$nomFichier;
 				move_uploaded_file($fichier['tmp_name'], $destination);
 				
 				$this->Image->create();
 				if ($this->Image->save(array('name' => $nomFichier, 'user_id' => $_SESSION['Auth']['User']['id']))) {
 					$message .= "Upload du fichier ".$filename." réussi. ";
 				} else {
 					$message .="Echec de l\'upload du fichier ".$filename." ";
 				}
 				$this->Session->setFlash($message, "message", array('type'=>'info'));
 			}
 		} else {
 			$this->Session->setFlash($message, "message", array('type'=>'erreur'));
 		}
 		
		/* if ($this->request->data['Image']['image_file']['size'] > 5242880 ) {
			$this->Session->setFlash("Le fichier d&eacute;passe la limite autoris&eacute;e.", "message", array('type'=>'erreur'));
		} else if(!empty($this->request->data['Image']['image_file']['tmp_name']) && in_array($extension,array('png','jpeg','jpg'))){
			$now = date("YmdHis");
			$nomFichier = $now.".".$extension;
			$destination = IMAGES.'data'.DS.$nomFichier;
			move_uploaded_file($this->request->data['Image']['image_file']['tmp_name'], $destination);

			//$this->Image->create();
			if ($this->Image->save(array('name' => $nomFichier, 'user_id' => $_SESSION['Auth']['User']['id']))) {
				$this->Session->setFlash("Upload du fichier ".$filename." réussi", "message", array('type'=>'info'));
			} else {
				$this->Session->setFlash(__("Echec de l\'upload du fichier ".$filename), "message", array('type'=>'erreur'));
			}
		} else if (!empty($this->request->data['Image']['image_file']['tmp_name'])){
 			$this->Session->setFlash("Vous ne pouvez uploader que des fichiers de type PNG JPG ou JPEG", "message", array('type'=>'erreur'));
		}
 */
		//Tag
		//debug($this->data);
		//die();
		/* if(!empty($this->request->data['Image']['tags'])) {
			$tags = explode(',', $this->request->data['Image']['tags']);
			foreach ($tags as $tag):
			$tag = trim($tag);
			if(!empty($tag)) {
				$this->loadModel('Tag');
				$data = $this->Tag->findByName($tag);
				if(!empty($d)) {
					$this->Tag->id = $data['Tag']['id'];
				} else {
					$this->Tag->create();
					$this->Tag->save(array('name'=>$tag));
				}
				$this->loadModel('ImagesTag');
				$this->ImagesTag->create();
				$this->ImagesTag->save(array('image_id'=>$this->id,'tag_id'=>$this->Tag->id));
			}
			endforeach;
		} */
		
		$this->set('title_for_layout', 'FileSharing - Gestion des images');
		return $this->redirect(array('controller' => 'Images', 'action' => 'liste'));
	}

	public function delete() {
		if ($this->request->is('post')) {
			$imageTab = $this->request->data;
			$listeFile="";
			for ($i=0; $i< count($imageTab['fichiers']); $i++) {
				$idImg = $imageTab['fichiers'][$i];
				if($idImg !== '0') {
					$res = $this->Image->find('all', array('fields' => array('Image.name'),'conditions' => array('Image.id' => $idImg)));
					if (empty($res)) {
						$this->Session->setFlash(__('Erreur dans la suppression de l\'image'), "message", array('type'=>'erreur'));
						return $this->redirect(array('controller' => 'Images', 'action' => 'liste'));
					} else {
						$this->Image->id = $idImg;
						$fileName = $res[0]['Image']['name'];

						if ($this->Image->delete()) {
							$destination = IMAGES.'data'.DS.$fileName;
							unlink($destination);
							$listeFile .= $fileName.", ";
						} else {
							$this->Session->setFlash(__('L\'image n\'a pas été supprimée'), "message", array('type'=>'erreur'));
							return $this->redirect(array('controller' => 'Images', 'action' => 'liste'));
						}
					}
				}
			}
			$this->Session->setFlash(__('Image(s) '.$listeFile.' supprimée(s)'), "message", array('type'=>'info'));
			return $this->redirect(array('controller' => 'Images', 'action' => 'liste'));
		}
	}

	public function download() {
		$this->set('title_for_layout', 'FileSharing - Téléchargement des images');
		$this->set(array('zipOb'=>false));
		$this->render('download');

	}

	public function doDownload() {
		$zipOb=false;

		$dir = IMAGES."data".DS;
		//recuperation de toutes les images
		$this->Image->recursive = -1;
		$files = $this->Image->find('all', array('fields' => array('Image.name')));

		//debug($files);
		//die();

		$zip = new ZipArchive();
		//Creation du fichier zip
		if(($zip->open($dir.'photo.zip', ZIPARCHIVE::OVERWRITE))===TRUE){
			foreach ($files as $file) {
				$fileName = $file['Image']['name'];
				// Ajout de fichier
				$zip->addFile($dir.$fileName, $fileName);
			}
			$zip->close();
		}
		$today = strftime('%d %B %Y &agrave; %H:%M');
		$this->Session->setFlash(__("Le fichier photo.zip (G&eacute;n&eacute;r&eacute; le ".$today." est pr&ecirc;t à etre t&eacute;l&eacute;charger."), "message", array('type'=>'info'));
		$zipOb=true;
		$this->set('title_for_layout', 'FileSharing - Téléchargement des images');
		$this->set(array('zipOb'=>$zipOb));
		$this->render('download');
	}
	
	public function deleteTag($id) {
		$this->Image->ImagesTag->delete($id);
		$this->Session->setFlash('Tag supprimé', "message", array('type'=>'info'));
		$this->set('title_for_layout', 'FileSharing - Gestion des images');
		return $this->redirect(array('controller' => 'Images', 'action' => 'liste'));
	
	}
}
