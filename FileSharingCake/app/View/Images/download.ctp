<script language="javascript" type="text/javascript">
function afficheMessage() {
	document.getElementById('openModal').style.opacity = '1';
	document.location.replace('../images/doDownload/' + document.getElementById('tag_id').value);
}
</script>
<div id="openModal" class="modalDialog"><div><?php echo $this->Html->image("patience.gif");?></div></div>
<p><h3>T&eacute;l&eacute;chargement des images</h3></p>
<p align='center'><?= $this->Form->input('tag_id', array('label' => 'Container : ','empty'=>'Tous')) ?></p>
<?php
if(empty($zipOb) || !$zipOb) {
	echo "<p align='center'>Pour lancer la g&eacute;n&eacute;ration du zip contenant les photos cliquez sur le bouton</p>";
	echo "<p align='center'><input type='button' name='telecharger' value='Télécharger les images' onclick='afficheMessage();' /></p>";
} else {
	echo "<p align='center'>T&eacute;l&eacute;charger le zip contenant les photos</p>";
	echo "<p align='center'>";
	echo $this->Html->link($this->Html->image("download.png"),"/img/data/zip/".$nomZip, array('escape' => false));
	echo "</p>";
	
	
}?>