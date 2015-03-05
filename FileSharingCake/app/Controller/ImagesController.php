<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ImagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
	public $components = array('Paginator', 'Session');	
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

	public function liste($tag = null) {
		//debug("tag : ".$tag.", taille : ".strlen($tag));die();

		if('admin' == $_SESSION['Auth']['User']['role']) {
			//Administrateur
			if(strlen($tag) == 0) {
				$total = $this->Image->find('count');
				$this->Paginator->settings = $this->paginate;
			} else {
				$total = $this->Image->find('count', array('conditions' => array('Image.tag_id' =>$tag)));
				$this->Paginator->settings = array('conditions' => array('Image.tag_id' =>$tag));
			}
		} else {
			//User
			if(strlen($tag) == 0) {
				$total = $this->Image->find('count', array('conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id'])));
				$this->Paginator->settings = array('conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id']));
			} else {
				$total = $this->Image->find('count', array('conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id'],'Image.tag_id' =>$tag)));
				$this->Paginator->settings = array('conditions' => array('Image.user_id' => $_SESSION['Auth']['User']['id'],'Image.tag_id' =>$tag));
			}
		}

		// similaire à un findAll(), mais récupère les résultats paginés
		$this->Image->recursive = 1;
		$images = $this->Paginator->paginate('Image');
		$listeTags = $this->Image->Tag->find('all', array('conditions' => array('online'=>'1')));
		$tags = $this->Image->Tag->find('list', array('conditions' => array('online'=>'1')));
		//debug($listeTags);die();
		$this->set('title_for_layout', 'FileSharing - Gestion des images');
		$this->set(array('images'=>$images, 'tags' => $tags,'listeTags'=>$listeTags, 'total' => $total,'tagSelected'=>$tag));
		$this->render('liste');

	}

	public function add() {
		$listeFile = $this->request->data['Image']['files'];
		$multiOk=true;
		$message="";
		//debug($this->request->data);
		//die();
		foreach ($listeFile as $fichier) {
			$filename = strtolower($fichier['name']);
			$extension = strtolower(pathinfo($filename , PATHINFO_EXTENSION));
			//break;
			if ($fichier['size'] > 3145728 ) {
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
				$destinationMini = IMAGES.'mini'.DS.$nomFichier;
				move_uploaded_file($fichier['tmp_name'], $destination);
				//Miniature
				darkroom($destination, $destinationMini, 200, 0);
				
				
				$this->Image->create();
				if ($this->Image->save(array('name' => $nomFichier, 'user_id' => $_SESSION['Auth']['User']['id'],'tag_id'=>$this->request->data['Image']['tag_id']))) {
					$message .= "Upload du fichier ".$filename." réussi. ";
				} else {
					$message .="Echec de l\'upload du fichier ".$filename." ";
				}
				$this->Session->setFlash($message, "message", array('type'=>'info'));
			}
		} else {
			$this->Session->setFlash($message, "message", array('type'=>'erreur'));
		}
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
							$destinationMini = IMAGES.'mini'.DS.$fileName;
							unlink($destinationMini);
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
		$tags = $this->Image->Tag->find('list', array('conditions' => array('online'=>'1')));
		$this->set(array('zipOb'=>false,'tags' => $tags));
		$this->render('download');

	}

	public function doDownload($tag = null) {
		$zipOb=false;
		
		//recuperation de toutes les images
		$this->Image->recursive = 1;
		if(strlen($tag) == 0) $files = $this->Image->find('all');
		else $files = $this->Image->find('all', array('conditions' => array('tag_id' =>$tag)));
		
		$dir = IMAGES."data".DS;		
		$idNom = "User".$_SESSION['Auth']['User']['id']."_";
		
		if(strlen($tag) == 0) {
			$nameFileZip = $idNom.'photos.zip';
		} else {
			//Recherche du libelle du tag
			$this->loadModel('Tag');
			$this->Tag->recursive = -1;
			$tagName = $this->Tag->find('first', array('conditions' => array('id' =>$tag)));
			$nameFileZip = $idNom.$tagName['Tag']['name'].'.zip';
		}
		
		$dirZip = $dir."zip".DS;
		$fileZip = $dirZip.$nameFileZip;
		//Suppression
		foreach (glob("{$dirZip}*{$idNom}*") as $fn) unlink($fn);
		
		$zip = new ZipArchive();
		//Creation du fichier zip
		if(($zip->open($fileZip, ZIPARCHIVE::OVERWRITE))===TRUE){
			foreach ($files as $file) {
				$fileName = $file['Image']['name'];
				$fileNamePhoto = $file['User']['nom'].'_'.$file['User']['prenom'].'_'.$file['Image']['name'];
				// Ajout de fichier
				$zip->addFile($dir.$fileName, $fileNamePhoto);
			}
			$zip->close();
		}
		$today = strftime('%d %B %Y &agrave; %H:%M');
		$this->Session->setFlash(__("Le fichier photo.zip (G&eacute;n&eacute;r&eacute; le ".$today.") est pr&ecirc;t à etre t&eacute;l&eacute;charger."), "message", array('type'=>'info'));
		$zipOb=true;
		$tags = $this->Image->Tag->find('list', array('conditions' => array('online'=>'1')));
		$this->set('title_for_layout', 'FileSharing - Téléchargement des images');
		$this->set(array('zipOb'=>$zipOb,'tags'=>$tags,'nomZip'=>$nameFileZip));
		$this->render('download');
	}
}

/**
 * La fonction darkroom() renomme et redimensionne les photos envoyées lors de l'ajout d'un objet.
 * @param $img String Chemin absolu de l'image d'origine.
 * @param $to String Chemin absolu de l'image générée (.jpg).
 * @param $width Int Largeur de l'image générée. Si 0, valeur calculée en fonction de $height.
 * @param $height Int Hauteur de l'image génétée. Si 0, valeur calculée en fonction de $width.
 * Si $height = 0 et $width = 0, dimensions conservées mais conversion en .jpg
 */
function darkroom($img, $to, $width = 0, $height = 0){
	ini_set('memory_limit', '-1');
	$dimensions = getimagesize($img);
	$ratio      = $dimensions[0] / $dimensions[1];

	// Calcul des dimensions si 0 passé en paramètre
	if($width == 0 && $height == 0){
		$width = $dimensions[0];
		$height = $dimensions[1];
	}elseif($height == 0){
		$height = round($width / $ratio);
	}elseif ($width == 0){
		$width = round($height * $ratio);
	}

	if($dimensions[0] > ($width / $height) * $dimensions[1]){
		$dimY = $height;
		$dimX = round($height * $dimensions[0] / $dimensions[1]);
		$decalX = ($dimX - $width) / 2;
		$decalY = 0;
	}
	if($dimensions[0] < ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = round($width * $dimensions[1] / $dimensions[0]);
		$decalY = ($dimY - $height) / 2;
		$decalX = 0;
	}
	if($dimensions[0] == ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = $height;
		$decalX = 0;
		$decalY = 0;
	}

	$pattern = imagecreatetruecolor($width, $height);
	$type = mime_content_type($img);
	switch (substr($type, 6)) {
		case 'jpeg':
			$image = imagecreatefromjpeg($img);
			break;
		case 'gif':
			$image = imagecreatefromgif($img);
			break;
		case 'png':
			$image = imagecreatefrompng($img);
			break;
	}
	imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
	imagedestroy($image);
	imagejpeg($pattern, $to, 100);

	return TRUE;

}