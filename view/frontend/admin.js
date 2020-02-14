
$("#modifMDP").click(function(){

	if ($("#changeMDP input").attr("class") === "d-none")
	{
		$("#changeMDP input").attr("class", "d-inline-block");
	}

	else
	{
		$("#changeMDP input").attr("class", "d-none");
	}
});

$("#modifPseudo").click(function(){

	if ($("#changePseudo input").attr("class") === "d-none")
	{
		$("#changePseudo input").attr("class", "d-inline-block");
	}

	else
	{
		$("#changePseudo input").attr("class", "d-none");
	}
});

$("#modifEmail").click(function(){

	if ($("#changeEmail input").attr("class") === "d-none")
	{
		$("#changeEmail input").attr("class", "d-inline-block");
	}

	else
	{
		$("#changeEmail input").attr("class", "d-none");
	}

});