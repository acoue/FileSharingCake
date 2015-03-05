<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 * @property PaginatorComponent $Paginator
 */
class TagsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tag->recursive = 1;
		$this->set('tags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
		$this->set('tag', $this->Tag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash('Le container a été sauvegardé.', "message", array('type'=>'info'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Erreur dans la sauvegarde du container', "message", array('type'=>'erreur'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash('Le container a été sauvegardé.', "message", array('type'=>'info'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Erreur dans la sauvegarde du container', "message", array('type'=>'erreur'));
			}
		} else {
			$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
			$this->request->data = $this->Tag->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tag->delete()) {
			$this->Session->setFlash('Le container a été supprimé.', "message", array('type'=>'info'));
		} else {
			$this->Session->setFlash('Erreur dans la suppression du container', "message", array('type'=>'erreur'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
