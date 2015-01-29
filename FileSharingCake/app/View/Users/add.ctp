<!-- app/View/Users/add.ctp -->
<h2>Ajout d'un utilisateur</h2>
<?= $this->Form->create('User'); ?>
<table width='50%' align='center'>
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
    	<td><label>Mot de passe</label></td>
    	<td><?= $this->Form->input('password', array('label' => false,'div' => false, 'size' => '70px','type'=>'password','placeholder' => 'Entrez le mot de passe', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td><label>Rôle</label></td>
    	<td><?= $this->Form->input('role', array('label' => false,'div' => false, 'options' => array('user' => 'Utilisateur','admin' => 'Admin'))); ?></td>
    </tr>
    <tr>
    	<td colspan='2' align='center' ><?php echo $this->Form->end(__('Ajouter'));?></td>
    </tr>
</table>
<p align='center'>
<?= $this->html->link(
		$this->Html->image('retour.png'),
		array("controller" => "users", "action" => "index"),
					array('escape' => false) 
			);?>
</p>