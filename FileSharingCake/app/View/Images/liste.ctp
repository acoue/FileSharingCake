<script type="text/javascript">
function checkAll(name, checked){
    //On parcourt tous les inputs de la page
    var inputs = document.getElementsByTagName('input');
    for(var i=0; i<inputs.length; i++){
        //On regarde s'il s'agit d'une checkbox avec le nom souhaité
        if(inputs[i].type == 'checkbox' && inputs[i].name == name){
            //On attribue à la case le même état (coché/décoché) que celui de la checkbox servant à tout cocher/décocher
            inputs[i].checked = checked;
        }
    }
}	

function afficheMessage() {
	 document.getElementById('openModal').style.opacity = '1';
	 return true;
}
</script>
<div id="openModal" class="modalDialog"><div><?php echo $this->Html->image("patience.gif");?></div></div>
<p>
<table>
	<tr>
		<td><?= $this->Html->image('document_add.png'); ?></td>
		<td><span class='vertAlign'><h3>AJOUT D'UN FICHIER</h3></span></td>
	</tr>
</table>
<?= $this->Form->create('Image', array('type' => 'file','controller'=>'Images', 'action' =>'add', 'onsubmit'=>'return afficheMessage();'));?>
<table width='80%'>
	<tr>
		<td width='10%'><label>Image à insérer :</label></td>
		<td ailgn='left'><?= $this->Form->input('files.', array('type' => 'file', 'multiple','label' => false,'div' => false, 'type' => 'file', 'size' => '100px','required' =>'required')); ?></td>
	</tr>
	<tr>
		<td><label>Container : </label></td>
		<td ailgn='left'><?= $this->Form->input('tag_id',array('label' => false,'div' => false)); ?></td>
	</tr>
	<tr>
		<td colspan='2' ><?= $this->Form->button('Ajouter'); ?></td>
	</tr>
</table>
<?= $this->Form->end();?>
</p>
<hr />
<p>
<table>
	<tr>
		<td><?= $this->Html->image('liste.png'); ?></td>
		<td><span class='vertAlign'><h3>LISTE DES FICHIERS</h3></span></td>
	</tr>
</table>
</p>
<p> Container : 
<?php 

if(!isset($tagSelected)) {
	echo "<span class='label label-success'>".$this->Html->link('Tous ',"/images/liste")." </span>";
	foreach ($listeTags as $t) echo "<span class='label label-tag'>".$this->Html->link($t['Tag']['name']." ","/images/liste/".$t['Tag']['id'])." </span>";
} else {
	echo "<span class='label label-tag'>".$this->Html->link('Tous ',"/images/liste")." </span>";
	foreach ($listeTags as $t) {
		if($tagSelected == $t['Tag']['id']) echo "<span class='label label-success'>".$this->Html->link($t['Tag']['name']." ","/images/liste/".$t['Tag']['id'])." </span>";
		else echo "<span class='label label-tag'>".$this->Html->link($t['Tag']['name']." ","/images/liste/".$t['Tag']['id'])." </span>";
	}
}	 
?>

</p>
<p><input type="checkbox" onClick="checkAll('fichiers[]', this.checked);" /> Tout cocher/d&eacute;cocher</p>
<!-- <p align='center'> -->
<!-- <div id="results"></div> -->

<p>Nombres de photos : <?= $total ?></p>
<p align='center'>
<table align='center' width='100%'>
  <tr>
<?php 
  echo $this->Form->create('Image', array('controller'=>'Images', 'action' =>'delete', 'onsubmit'=>'return afficheMessage();'));
  $iCpt = 0;

    foreach ($images as $image): 
      $iCpt++;
      $tags = $image['Tag'];
      echo "<td width='5%' align='center'>".$this->Form->checkbox('imageCheck', array('name' => 'fichiers[]','value' => $image['Image']['id']))."</td>";
      echo "<td width='10%' align='center'>".$this->Html->image('mini/'.$image['Image']['name'])."</td>";
        echo "<td width='10%' align='left'>".$image['User']['prenom']." ".$image['User']['nom']."<br />";
        //echo $image['Image']['name']."<br />";
		echo "le ".date('d/m/Y H:i:s',strtotime($image['Image']['created']));
        echo "<br /><span class='label label-tag'>".$image['Tag']['name']."</span></td>";
        if($iCpt === 3) {
          $iCpt = 0;
          echo "</tr><tr>";
        }
        
    endforeach;
    unset($image); 
?>
  </tr>
</table>
<?php 
echo $this->Form->end("Supprimer");?>
<br /> 
<?php
	echo $this->Paginator->counter(array('format' => __('Page {:page} de {:pages}')));
	echo "<br />";
	echo $this->Paginator->prev('< ' . __('Prec.  '), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ' '));
	echo $this->Paginator->next(__('  Suiv.') . ' >', array(), null, array('class' => 'next disabled'));
?>
</p>
