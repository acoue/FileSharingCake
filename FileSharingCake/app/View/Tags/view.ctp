<h2><?php 'Visualisation d\'un container'; ?></h2>
<p align='center'>
	<table align='center' width='60%'>
		<tr>
			<td width='30%'>Identifiant : </td>
			<td><?= h($tag['Tag']['id']); ?></td>
		</tr>
		<tr>
			<td width='30%'>Libellé : </td>
			<td><?= h($tag['Tag']['name']); ?></td>
		</tr>
		<tr>
			<td width='30%'>Online : </td>
			<td><?php if(h($tag['Tag']['online']) == '1') echo "Oui"; else echo "Non"; ?></td>
		</tr>
		<tr>
			<td width='30%'>Créé le : </td>
			<td><?php echo date('d/m/Y',strtotime(h($tag['Tag']['created']))); ?></td>
		</tr>
		<tr>
			<td width='30%'>Modifié le : </td>
			<td><?php echo date('d/m/Y',strtotime(h($tag['Tag']['modified']))); ?></td>
		</tr>
		<tr>
			<td colspan='2' align='center'>
<?php echo $this->Html->link($this->Html->image('modifier.png'), array('action' => 'edit', $tag['Tag']['id']),array('escape' => false));
echo $this->Form->postLink($this->Html->image('supprimer.png'), array('action' => 'delete', $tag['Tag']['id']), array('escape' => false), 'Etes-vous sûr de vouloir supprimer %s?', $tag['Tag']['id']);
echo $this->Html->link($this->Html->image('retour.png'), array('action' => 'index'),array('escape' => false));			?>
			</td>
		</tr>
	</table>
</p>
