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
</script>
<p>
<table>
	<tr>
		<td><?= $this->Html->image('document_add.png'); ?></td>
		<td><span class='vertAlign'><h3>AJOUT D'UN FICHIER</h3></span></td>
	</tr>
</table>
<? 	echo $this->Form->create('Image', array('type' => 'file', 'controller'=>'Images', 'action' =>'add'));
	echo $this->Form->input('image_file', array('label' => 'Image à insérer : ', 'type' => 'file', 'size' => '100px'));
	echo $this->Form->end(__('Envoyer'),array('align' => 'center')); 
?>
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
<p><input type="checkbox" onClick="checkAll('fichiers[]', this.checked);" /> Tout cocher/d&eacute;cocher</p>
<p>Nombres de photos : <?= $total ?></p>
<p align='center'>
<table align='center' width='90%'>
	<tr>
<?php 
	echo $this->Form->create('Image', array('controller'=>'Images', 'action' =>'delete'));
	$iCpt = 0;

    foreach ($images as $image): 
    	$iCpt++;
    	echo "<td width='5%' align='center'>".$this->Form->checkbox('imageCheck', array('name' => 'fichiers[]','value' => $image['Image']['id']))."</td>";
		echo "<td width='10%' align='center'>".$this->Html->image('data/'.$image['Image']['name'], array('height' =>'150px'))."</td>";
        echo "<td width='10%' align='center'>Publi&eacute;e par ".$image['User']['prenom']." ".$image['User']['nom']."<br /> le ".$image['Image']['created']."</td>";
        
        if($iCpt === 4) {
        	$iCpt = 0;
        	echo "<tr>";
        }
        
    endforeach;
    unset($image); 
?>
	</tr>
</table>
<?php 
echo $this->Form->end("Supprimer");?>
<br />
<? if(!empty($this->Paginator->numbers())) echo "Page(s) : ".$this->Paginator->numbers(); ?>
</p>
