let pos = 0, test, test_statut, question, choice, choices, chA, chB, chC, chD, correct = 0;
let questions = [
		["En quelle année est sorti le premier ordinateur Apple ?", "1973", "1976","1978","1980","B"],
		["En quelle année fut crée l'ESGI ?","1978","1981","1983","1987","C"],
		 ["Quel est le meilleur langage de Programmation ?", "C", "Javascript","Aucun des deux","Tout dépend de ce que l'on veut faire", "D"]
	    ];

function quizz(x){return document.getElementById(x);}

function retournequestion()
{
	test = quizz("test");
	if(pos >= questions.length){
		test.innerHTML = "<h2>Ton score est de "+correct+"/"+questions.length+" !</h2>";
		test.innerHTML += "<button onclick='retourneaccueil()'>Retour à l'Accueil</button>";
		quizz("test_statut").innerHTML = "FIN DU JEUX SECRET PRTFITNESS ! MERCI POUR VOTRE PARTICIPATION ! A BIENTÔT ! ";
		pos = 0;
		correct = 0;
		return false;
	}
	quizz("test_statut").innerHTML = "PRTFITNESS SECRET GAME : Niveau Expert" + " Question "+(pos+1)+" sur "+questions.length;
	question = questions[pos][0];
	chA = questions[pos][1];
	chB = questions[pos][2];
	chC = questions[pos][3];
	chD = questions[pos][4];
	test.innerHTML = "<h3>"+question+"</h3>";
	test.innerHTML += "<input type='radio' name='choices' value='A'> "+chA+"<br>";
	test.innerHTML += "<input type='radio' name='choices' value='B'> "+chB+"<br>";
	test.innerHTML += "<input type='radio' name='choices' value='C'> "+chC+"<br>";
	test.innerHTML += "<input type='radio' name='choices' value='D'> "+chD+"<br><br>";
	test.innerHTML += "<button onclick='verifreponse()'>Question suivante</button>";
}
function verifreponse()
{
	choices = document.getElementsByName("choices");
	for(var i=0; i<choices.length; i++){
		if(choices[i].checked){
			choice = choices[i].value;
		}
	}
	if(choice == questions[pos][5]){
		correct++;
	}
	pos++;
	retournequestion();
}
function retourneaccueil(){
	document.location.href="index.php";
}
window.addEventListener("load", retournequestion, false);
