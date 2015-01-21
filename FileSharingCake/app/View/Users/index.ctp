<p><h3>Liste des utilisateurs</h3></p>
<?php 
echo "<p align='center'>";
echo $this->html->link(
		$this->Html->image('ajouter.png'),
		array("controller" => "users", "action" => "add"),
		array('escape' => false)
);
echo "</p>";
echo "<table align='center' width='50%'>";

foreach ($users as $user) {
		echo "<tr align='left'><td align='center' width='10%'>";
		if($user['User']['role']=='admin') echo "</td>";
		else {
			echo $this->Form->postLink(
					$this->Html->image('supprimer.png'),
					array("controller" => "users", "action" => "delete/".$user['User']['id']),
					array('escape' => false),
	   				__('Êtes-vous sûr de vouloir supprimer l\'utilisateur %s ?',
	   					$user['User']['prenom']." ".$user['User']['nom'])
			);
		}
	   	echo "<td align='center' width='10%'>";
	   	echo $this->Html->link(
			    $this->Html->image('modifier.png'),
			    array("controller" => "users", "action" => "edit/".$user['User']['id']),
    			array('escape' => false)
			);
	   	
	   	
	   	echo "</td>";
	   	echo "<td align='center' width='70%'><b>".$user['User']['prenom']." ".$user['User']['nom']."</b></td>";
	   	echo "<td align='center' width='10%'>";
	   	echo $this->html->link(
					$this->Html->image('password.png'),
					array("controller" => "users", "action" => "password/".$user['User']['id']),
					array('escape' => false)
			);
	   	echo "</td>";
	   	echo "</tr>";
	}
?>
</table>