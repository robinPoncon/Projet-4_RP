
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

$("h2").click(function(){
	alert("c'est bien un titre");
});

$("#deletePost").click(function(){
	$("#confirm").css("display", "inline-block !important");
	alert("test");
});















