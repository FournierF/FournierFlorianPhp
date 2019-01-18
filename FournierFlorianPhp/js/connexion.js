$(function () {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    $("#connexion").submit(function (e) {
        
        // on récupère les champs mail et password
        var mail = document.getElementById("Mail");
        var password = document.getElementById("password");


        // si mail ou password est null
        if (mail.value == "" || password.value == "") {
            // on arrête l'envoie du script
            e.preventDefault();

            // on affiche le message d'alerte
            var alert = document.getElementById("alert");
            alert.style.display ="block";
            mail.style.border = "red 1px solid";
            password.style.border = "red 1px solid";
            return false;
        }
        // sinon on test si c'est bien une adresse mail
        else if(reg.test(mail.value)) {
            return true;
        }
        else{
            // si c'est pas une adresse mail :
            e.preventDefault();
            mail.style.border = "red 1px solid";
            console.log("adresse pass valide");
            var alert = document.getElementById("alert");
            alert.innerHTML = "Veuillez rentrer une adresse mail."
            alert.style.display ="block";
            return false;            
        }

    });


    $("input").click(function(){
        $("#alert").fadeOut();
        $(this).css('border','1px solid #ccc');
    });
});