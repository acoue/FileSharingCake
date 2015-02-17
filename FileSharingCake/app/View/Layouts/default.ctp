<!doctype html>
<html lang="fr">
    <head>
    	<meta charset="ISO-8859-1" />
    	<?= $this->Html->css(array('style','menu')); ?>
    	<?= $this->fetch('css'); ?>
        <title><?php if(isset($title_for_layout)) echo "FileSharing"; else echo $title_for_layout; ?></title>
    </head>
	<body>
		<div id="page">
	        <div id="header">
	        	<?=	$this->Html->image('ALLIANCE.png', array('width' => '100%', 'border' => '0', 'align' => 'left'),
	        			array('title' => 'Retour &agrave; l\'accueil', 'target' => '_self'));  
				?>
	        </div> 
	        <div id="global">
				<div id="page_principale_100">
					<?php
						if(!empty($_SESSION['Auth']['User'])) echo $this->element('menu'); 	
						//echo $this->Session->flash('auth');
						echo $this->Session->flash();
						
						echo "<br />".$this->fetch('content'); 
					?>
				</div> 
				<?php //echo $this->element('debug'); ?>
    			<?= $this->fetch('script'); ?>
				 <div id="footer">
					 <table class="tableFooter" width='90%' >
						 <tr class="administration">
							 <td width='50%' align="left">&copy; Anthony COUE (anthony.coue(at)gmail.com)</td>
							 <td width='50%' align="right">version 3.0 du 20/01/2015</td>
						 </tr>
					 </table>
				 </div> 
			</div> 
		</div>  
	</body>
</html>		