<h2>Ajout d'un container</h2>
<?= $this->Form->create('Tag'); ?>
<table width='50%' align='center'>
    <tr>
    	<td width='50%'><label>Nom</label></td>
    	<td><?=$this->Form->input('name', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez le nom du container', 'required' =>'required','autofocus'=>'autofocus')); ?></td>
    </tr>
    <tr>
    	<td width='50%'><label>Online</label></td>
    	<td><?=$this->Form->input('online', array('label' => false,'div' => false, 'options' => array('0' => 'Offline','1' => 'Online'))); ?></td>
    </tr><tr>
    	<td colspan='2' align='center' ><?php echo $this->Form->end('Ajouter');?></td>
    </tr>
</table>
<p align='center'>
<?= $this->html->link(
		$this->Html->image('retour.png'),
		array("action" => "index"),
					array('escape' => false) 
			);?>
</p>