
// Fonction qui affiche les inputs pour modifier le pseudo et cache les inputs des autres

$("#modifPseudo").click(function(){

	if ($("#changePseudo input").attr("class") === "d-none")
	{
		$("#changePseudo input").attr("class", "d-block form-control");
		$("#changeMDP input").attr("class", "d-none");
		$("#changeEmail input").attr("class", "d-none");
	}

	else
	{
		$("#changePseudo input").attr("class", "d-none");
	}
});

// Fonction qui affiche les inputs pour modifier le mot de passe et cache les inputs des autres 

$("#modifMDP").click(function(){

	if ($("#changeMDP input").attr("class") === "d-none")
	{
		$("#changeMDP input").attr("class", "d-block form-control");
		$("#changePseudo input").attr("class", "d-none");
		$("#changeEmail input").attr("class", "d-none");
	}

	else
	{
		$("#changeMDP input").attr("class", "d-none");
	}
});

// Fonction qui affiche les inputs pour modifier l'émail et cache les inputs des autres

$("#modifEmail").click(function(){

	if ($("#changeEmail input").attr("class") === "d-none")
	{
		$("#changeEmail input").attr("class", "d-block form-control");
		$("#changeMDP input").attr("class", "d-none");
		$("#changePseudo input").attr("class", "d-none");
	}

	else
	{
		$("#changeEmail input").attr("class", "d-none");
	}

});

// Paramètre pour l'éditeur HTML

tinymce.init({
    selector: '#mytextarea',
    height: "400px",
    entity_encoding : "raw", 
    encoding: "UTF-8"
});


// Fonction qui affiche la div confirm et réduit l'opacité du bloc news ainsi que la désactivation des events pour plus de lisibilité

function deletePost(id)
{
	$("#confirm" + id).css("visibility", "visible");
	$(".news").css("opacity", 0.5).css("pointer-events", "none");
}

// Fonction qui recache la div confirm et remet l'opacité du bloc news ainsi que les events normalement 

function cancelPost(id)
{
	$("#confirm" + id).css("visibility", "hidden");
	$(".news").css("opacity", 1).css("pointer-events", "auto");
}

// Fonction qui affiche la div confirm et réduit l'opacité de la page monCompte ainsi que la désactivation des events pour plus de lisibilité

function deleteComment(id)
{
	$("#confirm" + id).css("visibility", "visible");
	$(".commentaire, #perso, #newPost, .commentaireSignaler, h4").css("opacity", 0.5).css("pointer-events", "none");
}

// Fonction qui recache la div confirm et remet l'opacité de la page monCompte ainsi que les events normalement 

function cancelComment(id)
{
	$("#confirm" + id).css("visibility", "hidden");
	$(".commentaire, #perso, #newPost, .commentaireSignaler, h4").css("opacity", 1).css("pointer-events", "auto");
}
















