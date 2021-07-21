function resultat(res) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { // requête finis et statut OK
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getuser?r=" + res, true); // enlever le .php pour le serveur
    xmlhttp.send();
}

function downloadFile() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    xmlhttp.open("GET", "writelist?verif=true" , true);
    xmlhttp.send();
}

function send_list(){
    const email = document.getElementById('email').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
         if(this.responseText == 'Entrer un email valide'){
         document.getElementById('msg').className="text-center alert alert-warning form-control2";
         }
         if(this.responseText == 'mail envoye'){
         document.getElementById('msg').className="text-center alert alert-success form-control2";
         }
         document.getElementById('msg2').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("POST", "sendmail");
    xmlhttp.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
    xmlhttp.send(`email=${email}`);
}


function delete_users(myId){

  const request = new XMLHttpRequest();
	request.open('DELETE' , 'delete_users?id=' + myId);
	request.onreadystatechange = function(){
		if(request.readyState === 4 ){
			resultat('');

		}
	};
     request.send();
}
