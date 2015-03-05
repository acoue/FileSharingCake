<!-- app/View/Users/add.ctp -->
<h2>Modifier du mot de passe</h2>
<?= $this->Form->create('User'); ?>
<table width='40%' align='center'>
    <tr>
    	<td width='50%'><label>Nouveau password</label></td>
    	<td><?=$this->Form->input('new_password', array('label' => false,'div' => false,'size' => '70px', 'type'=>'password', 'placeholder' => 'Entrez le nmot de passe', 'value' => '', 'required' =>'required','autofocus'=>'autofocus')); ?></td>
    </tr>
    <tr>
    	<td width='50%'><label>Vérification</label></td>
    	<td><?=$this->Form->input('verif_password', array('label' => false,'div' => false,'size' => '70px', 'type'=>'password','placeholder' => 'vérification du mot de passe', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td colspan='2' align='center' ><?php echo $this->Form->end(__('Modifier'));?></td>
    </tr>
</table>
<p align='center'>
<?
if (trim(rtrim($_SESSION['Auth']['User']['role'])) === 'admin') {
	if(isset($this->request->data['User']['id'])) {
		echo $this->html->link(
			$this->Html->image('retour.png'),
			array("controller" => "users", "action" => "edit/".$this->request->data['User']['id']),
			array('escape' => false)
			);
	} else {
		echo $this->html->link(
			$this->Html->image('retour.png'),
			array("controller" => "users", "action" => "index"),
			array('escape' => false)
			);
	}
}
?>
</p>