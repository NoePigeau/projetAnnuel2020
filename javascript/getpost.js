function resultat(res) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { // requête finis et statut OK
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getpost?r=" + res, true); // enlever le .php pour le serveur
    xmlhttp.send();
}


function delete_post(myId){

  const request = new XMLHttpRequest();
	request.open('DELETE' , 'delete_post?id=' + myId);
	request.onreadystatechange = function(){
		if(request.readyState === 4 ){
			resultat('');

		}
	};
     request.send();




}
