<?php
// App::uses('Folder', 'Utility');
// App::uses('File', 'Utility');
// App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

	
	
    public function beforeFilter() {
    	parent::beforeFilter();
    	// Permet aux utilisateurs de s'enregistrer et de se déconnecter
    	$this->Auth->allow('logout');
    }
	
//     public function check(){
//     	$dir = new Folder('User', true);
//     	$files = $dir->find('.*');
//     	$passwordHasher = new SimplePasswordHasher();
//     	$contents = "";
// 	    foreach ($files as $file) {
// 		    //$file = new File($dir->pwd() . DS . $file);
// 	    	$contents .= "INSERT INTO users(username,nom,prenom,password,role) values('".$file."','";
// 		    /*Ouverture du fichier en lecture seule*/
// 		    $handle = fopen($dir->pwd() . DS . $file, 'r');
// 		    /*Si on a réussi à ouvrir le fichier*/
// 		    if ($handle) {
// 		    	/*Tant que l'on est pas à la fin du fichier*/
// 		    	$i = 0;
// 		    	while (!feof($handle)) {
// 		    		$i++;
// 		    		/*On lit la ligne courante*/
// 		    		$buffer = fgets($handle);
// 		    		if($i == 4) $contents .= $passwordHasher->hash($buffer);
// 		    		else $contents .= $buffer."','";
// 		    	}
// 		    	/*On ferme le fichier*/
// 		    	fclose($handle);
// 		    }
// 		    $contents .= "');";
// 		}
		
//     	debug($contents);
//     	die();
//     }
    
 	public function index() {
        $this->User->recursive = -1;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
		$this->set('title_for_layout', 'FileSharing - Ajout utilisateur');
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'user a été sauvegardé'), "message", array('type'=>'info'));
                return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'), "message", array('type'=>'erreur'));
            }
        }
    }

    public function edit($id = null) {
		$this->set('title_for_layout', 'FileSharing - Modification utilisateur');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur Invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'utilisateurer a été sauvegardé'), "message", array('type'=>'info'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas été sauvegardé. Merci de réessayer.'), "message", array('type'=>'erreur'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
		$this->set('title_for_layout', 'FileSharing - Suppression utilisateur');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }else {
        	if ($this->User->delete()) {
        
            	$this->Session->setFlash(__('Utilisateur supprimé'), "message", array('type'=>'info'));
            	return $this->redirect(array('action' => 'index'));
        	} else {
        	
        		$this->Session->setFlash(__('L\'utilisateur n\'a pas été supprimé'), "message", array('type'=>'erreur'));
        		return $this->redirect(array('action' => 'index'));
        	}
        }
    }
    
    public function password($id = null) {
    	
		$this->set('title_for_layout', 'FileSharing - Modification password');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur Invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

        	if($this->request->data['User']['new_password']== $this->request->data['User']['verif_password']) {

	            if ($this->User->saveField('password',$this->request->data['User']['new_password'])) {
	                $this->Session->setFlash(__('Le mot de passe de l\'utilisateur a été sauvegardé'), "message", array('type'=>'info'));
	                return $this->redirect(array('action' => 'index'));
	            } else {
	                $this->Session->setFlash(__('Le mot de passe de l\'utilisateur n\'a pas été sauvegardé. Merci de réessayer.'), "message", array('type'=>'erreur'));
	            }
        	} else {
                $this->Session->setFlash(__('Les mots de passe ne correspondent pas'), "message", array('type'=>'erreur'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
        
        
    }
    
    public function login() {
    	if ($this->request->is('post')) {
    		if ($this->Auth->login()) {
				$this->set('title_for_layout', 'FileSharing - Connexion');
				//CakeLog::write('activity', 'Un message spécial pour activité de logging');
    			return $this->redirect($this->Auth->redirectUrl());
    		} else {
    			$this->Session->setFlash(__("Nom d'user ou mot de passe invalide"), "message", array('type'=>'erreur'));
    		}
    	}
    }
    
    public function logout() {
		$this->set('title_for_layout', 'FileSharing - Deconnexion');
    	return $this->redirect($this->Auth->logout());
    }
}