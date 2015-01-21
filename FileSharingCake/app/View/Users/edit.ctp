<!-- app/View/Users/add.ctp -->
<h2>Modifier un utilisateur</h2>
<?= $this->Form->create('User'); ?>
<table width='40%' align='center' >
    <tr>
    	<td width='50%'><label>Nom</label></td>
    	<td><?=$this->Form->input('nom', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez le nom', 'required' =>'required','autofocus'=>'autofocus')); ?></td>
    </tr>
    <tr>
    	<td width='50%'><label>Prénom</label></td>
    	<td><?=$this->Form->input('prenom', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez le prénom', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td width='50%'><label>Identifiant</label></td>
    	<td><?=$this->Form->input('username', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez le login', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td><label>Rôle</label></td>
    	<td><?= $this->Form->input('role', array('label' => false,'div' => false, 'options' => array('user' => 'Utilisateur','admin' => 'Admin'))); ?></td>
    </tr>
    <tr>
    	<td colspan='2' align='center' ><?php echo $this->Form->end(__('Modifier'));?></td>
    </tr>
</table>
<p align='center'>
<?= $this->html->link(
		$this->Html->image('retour.png',array('width' =>'40px')),
		array("controller" => "users", "action" => "index"),
					array('escape' => false) 
			); ?>
</p>