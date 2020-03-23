
$("#modifMDP").click(function(){

	if ($("#changeMDP input").attr("class") === "d-none")
	{
		$("#changeMDP input").attr("class", "d-inline-block form-control");
		$("#changePseudo input").attr("class", "d-none");
		$("#changeEmail input").attr("class", "d-none");
	}

	else
	{
		$("#changeMDP input").attr("class", "d-none");
	}
});

$("#modifPseudo").click(function(){

	if ($("#changePseudo input").attr("class") === "d-none")
	{
		$("#changePseudo input").attr("class", "d-inline-block form-control");
		$("#changeMDP input").attr("class", "d-none");
		$("#changeEmail input").attr("class", "d-none");
	}

	else
	{
		$("#changePseudo input").attr("class", "d-none");
	}
});

$("#modifEmail").click(function(){

	if ($("#changeEmail input").attr("class") === "d-none")
	{
		$("#changeEmail input").attr("class", "d-inline-block form-control");
		$("#changeMDP input").attr("class", "d-none");
		$("#changePseudo input").attr("class", "d-none");
	}

	else
	{
		$("#changeEmail input").attr("class", "d-none");
	}

});

$(".buttonUpdate").click(function(){

	if ($(".mytextarea").css("display") === "none")
	{
		$(".mytextarea").css("display", "inline-block");
	}
	else
	{
		$(".mytextarea").css("display", "none");
	}
});

tinymce.init({
    selector: '#mytextarea',
    height: "400px"
});

/*function validerSuppression(link){
    if(confirm('Confirmer la suppression ?')){
     document.location.href = link;
    }
} */



function deletePost(id)
{
	$("#confirm" + id).css("visibility", "visible");
	$(".news").css("opacity", 0.5).css("pointer-events", "none");
}

function deleteComment(id)
{
	$("#confirm" + id).css("visibility", "visible");
	$(".commentaire, #perso, #newPost").css("opacity", 0.5).css("pointer-events", "none");
}

function cancelComment(id)
{
	$("#confirm" + id).css("visibility", "hidden");
	$(".commentaire, #perso, #newPost").css("opacity", 1).css("pointer-events", "auto");
}

function cancelPost(id)
{
	$("#confirm" + id).css("visibility", "hidden");
	$(".news").css("opacity", 1).css("pointer-events", "auto");
}















