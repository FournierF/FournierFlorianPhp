$(function() {
    $(".like").click(function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "script/vote.php",
            data: {
                id: $(this).attr('data-id')
            },
            dataType: "json",
            success: function(json) {
                    if(json == "Vous avez deja voté"){
                            var alert = document.getElementById("alert");
                            alert.style.display = "block";
                    }else{
                            var compteur = document.getElementById("compteur"+json.id);
                            compteur.innerHTML =("("+json.vote+" votes)");
                    }     
                }
        })
    });
    $("#alert").click(function() {
        $("#alert").fadeOut();
        $(this).css('border', '1px solid #ccc');
    });
})