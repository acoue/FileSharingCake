<h2>Connexion au site</h2>
<?= $this->Session->flash('auth'); ?>
<?= $this->Form->create('User'); ?>
<table width='40%' align='center'>
    <tr>
    	<td width='50%'><label>Identifiant</label></td>
    	<td><?=$this->Form->input('username', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez votre login', 'required' =>'required','autofocus'=>'autofocus')); ?></td>
    </tr>
    <tr>
    	<td><label>Mot de passe</label></td>
    	<td><?= $this->Form->input('password', array('label' => false,'div' => false, 'size' => '70px','type'=>'password','placeholder' => 'Entrez votre mot de passe', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td colspan='2' align='center' ><?= $this->Form->end(__('Se connecter')); ?></td>
    </tr>
</table>
