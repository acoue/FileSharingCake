<div id='cssmenu'>		
	<ul>
		<li><?= $this->Html->link($this->Html->image("menu_home.png", array("alt" => "Accueil")),"/images/index", array('escape' => FALSE));?></li>
		<li><?= $this->Html->link($this->Html->image("menu_addphoto.png", array("alt" => "Gestion des photos")),"/images/liste", array('escape' => false));?></li>
<?php
if (trim(rtrim($_SESSION['Auth']['User']['role'])) === 'admin') {
	echo "	 <li>".$this->Html->link($this->Html->image("menu_dwnld.png", array("alt" => "Télécharger des photos")),"/images/download", array('escape' => false))."</li>";
	echo "	 <li>".$this->Html->link($this->Html->image("menu_users.png", array("alt" => "Gestion des utilisateurs")),"/users/index", array('escape' => false))."</li>";
	echo "	 <li>".$this->Html->link($this->Html->image("tag.png", array("alt" => "Gestion des containerss")),"/tags/index", array('escape' => false))."</li>";
}
?>
		<li><?= $this->Html->link($this->Html->image("password.png", array("alt" => "Changer son mot de passe")),"/users/password/".$_SESSION['Auth']['User']['id'], array('escape' => false));?></li>
		<li><?= $this->Html->link($this->Html->image("menu_logout.png", array("alt" => "Déconnexion")),"/users/logout", array('escape' => false));?></li>
	</ul>
</div>
