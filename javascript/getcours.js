function add_training(){

  const type_cours = document.getElementById('type_cours').value;
  const date = document.getElementById('date').value;
  const hours = document.getElementById('hours').value;
  const time = document.getElementById('time').value;
  const salle = document.getElementById('salle').value;

  const request = new XMLHttpRequest();
  request.open('POST' , 'add_training');

  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200 ){

      resultat('');
      document.getElementById('msg').className="alert alert-warning form-control";
      document.getElementById('msg').innerHTML = request.responseText;

      }


  };
  request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
  request.send(`type_cours=${type_cours}&date=${date}&hours=${hours}&time=${time}&salle=${salle}`);


}


function resultat(res) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { // requête finis et statut OK
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getcours?r=" + res, true); // enlever le .php pour le serveur
    xmlhttp.send();
}

function delete_training(myId){

  const request = new XMLHttpRequest();
	request.open('DELETE' , 'delete_cours?id=' + myId);
	request.onreadystatechange = function(){
		if(request.readyState === 4 ){
			resultat('');

		}
	};
     request.send();




}
