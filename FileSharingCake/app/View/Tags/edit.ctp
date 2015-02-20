<h2>Modifier un container</h2>
<?= $this->Form->create('Tag'); ?>
<table width='40%' align='center' >
    <tr>
    	<td width='50%'><label>Id</label></td>
    	<td><?=$this->Form->input('id', array('label' => false,'div' => false,'size' => '10px','readonly'=>'readonly')); ?></td>
    </tr>
    <tr>
    	<td width='50%'><label>Libellé</label></td>
    	<td><?=$this->Form->input('name', array('label' => false,'div' => false,'size' => '70px', 'placeholder' => 'Entrez le libellé du container', 'required' =>'required')); ?></td>
    </tr>
    <tr>
    	<td><label>Online</label></td>
    	<td><?= $this->Form->input('online', array('label' => false,'div' => false, 'options' => array('0' => 'Offline','1' => 'Online'))); ?></td>
    </tr>
    <tr>
    	<td colspan='2' align='center' ><?php echo $this->Form->end('Modifier');?></td>
    </tr>
    <tr>
    	<td colspan="2" align='center'>
    	<?php echo $this->Form->postLink($this->Html->image('supprimer.png'), array('action' => 'delete', $this->Form->value('Tag.id')), array('escape' => false),'Etes-vous sûr de vouloir supprimer %s?', $this->Form->value('Tag.id')); ?>
    	</td>
    </tr>
</table>
<p align='center'>
<?= $this->html->link(
		$this->Html->image('retour.png'),
		array("action" => "index"),
					array('escape' => false) 
			); ?>
</p>