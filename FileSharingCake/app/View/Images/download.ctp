<script language="javascript" type="text/javascript">
function afficheMessage() {

 document.getElementById('boiteInfo').style.position = 'absolute';
 document.getElementById('boiteInfo').style.display = 'block';
 document.location.replace('../images/doDownload/' + + document.getElementById('tag_id').value);
}
</script>
<p><h3>T&eacute;l&eacute;chargement des images</h3></p>
<p align='center'><?= $this->Form->input('tag_id', array('label' => 'Container : ','empty'=>'Tous')) ?></p>
<?php
if(empty($zipOb) || !$zipOb) {
	echo "<p align='center'>Pour lancer la g&eacute;n&eacute;ration du zip contenant les photos cliquez sur le bouton</p>";
	echo "<p align='center'><input type='button' name='telecharger' value='Télécharger les images' onclick='afficheMessage();' /></p>";
//Div cache pour le gif
	echo "<p align='center'><div id='boiteInfo'>";
	echo $this->Html->image("patience.gif");
	echo "</div></p>";
} else {
	echo "<p align='center'>T&eacute;l&eacute;charger le zip contenant les photos</p>";
	echo "<p align='center'>";
	echo $this->Html->link($this->Html->image("download.png"),"/img/data/photo.zip", array('escape' => false));
	echo "</p>";
	
	
}?>