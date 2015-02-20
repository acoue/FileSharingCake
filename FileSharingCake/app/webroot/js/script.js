/**
 * Script perso
 */

/*
 * Recherche des images sur liste deroulante container
 */
jQuery(function($) {
	$('#ImageTagId').onchange( function(){
		$field = $(this);
	    $('#results').html(''); // on vide les resultats	
	    $('#ajax-loader').remove(); // on retire le loader
		 
	    // on commence à traiter à partir du 2ème caractère saisie
		if( $field.val().length > 1 ) {
		      // on envoie la valeur recherché en GET au fichier de traitement
		      $.ajax({
			  	type : 'GET', // envoi des données en GET ou POST
				url : '/images/getImagesByTag', // url du fichier de traitement
				data : 'tag='+$(this).val() , // données à envoyer en  GET ou POST
				beforeSend : function() { // traitements JS à faire AVANT l'envoi
					$field.after('<img src="ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
				},
				success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
					$('#ajax-loader').remove(); // on enleve le loader
					$('#results').html(data); // affichage des résultats dans le bloc
				}
		      });
		}		
	});
});
