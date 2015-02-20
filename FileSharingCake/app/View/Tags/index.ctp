<div class="tags index">
	<h2><?php echo 'Gestion des Container'; ?></h2>
	<table width='80%' align='center'>
	<thead>
	<tr align='center'>
			<th width='10%'><?php echo $this->Paginator->sort('id'); ?></th>
			<th width='40%'><?php echo $this->Paginator->sort('name'); ?></th>
			<th width='10%'><?php echo $this->Paginator->sort('online'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($tags as $tag): ?>
	<tr align='center'>
		<td><?php echo h($tag['Tag']['id']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['name']); ?>&nbsp;</td>
		<td><?php if(h($tag['Tag']['online']) == '1') echo "Oui"; else echo "Non"; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('view.png'), array('action' => 'view', $tag['Tag']['id']),array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('modifier.png'), array('action' => 'edit', $tag['Tag']['id']),array('escape' => false)); ?>
			<?php echo $this->Form->postLink($this->Html->image('supprimer.png'), array('action' => 'delete', $tag['Tag']['id']), array('escape' => false), 'Etes-vous sûr de vouloir supprimer %s?', $tag['Tag']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array('format' => 'Page {:page} of {:pages}'));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< Prec. ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(' Suiv. >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<p align='center'><?php echo $this->Html->link($this->Html->image('plus.png'), array('action' => 'add'), array('escape' => false)); ?></p>
</div>
