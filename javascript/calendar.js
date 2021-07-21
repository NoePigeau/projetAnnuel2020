
//prend la date actuelle et selection le jour de la semaine

let week = ['lun' , 'mar' , 'mer' , 'jeu' , 'ven' , 'sam' , 'dim'];
let ladate = new Date();
let the_year = ladate.getFullYear();
let the_month = ladate.getMonth();
let the_day = ladate.getDate();
let la_date = ladate.getDay(); // the day of the week
let days = document.getElementsByClassName("day");

//si le jour est dimanche c'est à dire 0, il prend la valeur 7 pour des faciliter de programmation
if(la_date == 0){
  la_date = 7;
}

//lance la fonction calendar.
setTimeout( selected_input_and_reset_planning, 100);


// permet d'accéder à la prochaine semaine
function next() {

   let days = document.getElementsByClassName("day");

   for(let i = 0 ; i < days.length ; i++){

     days[i].abbr = parseInt(days[i].abbr) + 7;

   }
    selected_input_and_reset_planning();
}


//permet d'accéder à la semaine d'avant
function back() {

  let days = document.getElementsByClassName("day");

    for(let i = 0 ; i < days.length ; i++){

        days[i].abbr = parseInt(days[i].abbr) - 7;

    }
   selected_input_and_reset_planning();
}


//selectionne les inputs et cases du tableaux et affiche les dates
function selected_input_and_reset_planning(){

  let days = document.getElementsByClassName("day");
  let selected_columns = document.getElementsByTagName('td');

  let ids = document.getElementById('ids').value;
  ids = ids.split(" ");

  let cours = document.getElementById('cours').value;
  cours = cours.split(" ");

  let type_training = document.getElementById('type_training').value;
  type_training = type_training.split(" ");

  let room = document.getElementById('salle').value;
  room = room.split(" ");

  let hours = document.getElementById('hours').value;
  hours = hours.split(" ");

  let duration = document.getElementById('durée').value;
  duration = duration.split(" ");

  //calcul la date des autres jours de la semaines en fonction de la date actuelle.
  for (let i = 0; i < 7; i++) {

    let futur_date = new Date(the_year,the_month,the_day + (parseInt(days[i].abbr)-la_date));
    days[i].innerHTML = week[i] + " " + futur_date.getDate() +"/"+  (futur_date.getMonth()+1);

  }
  // reset les cases du tableau
  for(let i = 0 ; i < selected_columns.length ; i++ ){

    selected_columns[i].innerHTML = "";
    selected_columns[i].style.backgroundColor = 'black';

  }

  calendar(days,selected_columns, ids ,cours,type_training,room,hours,duration);
}



// fonction qui vient ajouter les cours sur le planning
function calendar(days,selected_columns, ids , cours,type_training,room,hours,duration) {

    let count = 0;
    for(let i = 0 ; i < selected_columns.length ; i++ ){

          let tmp = days[count].innerHTML.split(" ");
          selected_columns[i].abbr = tmp[1];
          count++;

          if(count > 6) count = 0;

          for(let j = 0 ; j < cours.length ; j++){

            let line = parseInt(selected_columns[i].closest("tr").id);
            let new_button;
            if(selected_columns[i].abbr == cours[j] && line == parseInt(hours[j])){

              create_button(ids[j] , selected_columns[i] , cours[j]);

              let add_7 = 0;
              for(let k  = 0 ; k < parseInt(duration[j]) ; k++){

                    selected_columns[i + add_7].style.backgroundColor = 'rgb(200,10,10)';
                    new_p = document.createElement('p');
                    new_p.style.textAlign = 'center';
                    new_p.innerHTML = type_training[j] + "<br>" + " salle " + room[j];
                    selected_columns[i + add_7].appendChild(new_p);
                    add_7 += 7;


                }
            }

          }
      }
}


function create_button(id , column , cours){

  let session = document.getElementById('session').value;
  let days = cours.split("/");

  if(session == '1' && (parseInt(days[0]) >= the_day && parseInt(days[1]) >= the_month )  ){

    new_button = document.createElement('button');
    new_button.id = id;
    new_button.className = 'btn btn-success btn-sm';
    registration_training_default(new_button.id , new_button);
    new_button.onclick = function(){
      registration_training(this.id);
      entry_or_not(this.id);
     };
    column.appendChild(new_button);


  }


}



function registration_training(myId){

  const request = new XMLHttpRequest();
  request.open('POST' , 'process/add_registration_training');
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200 ){


    }
  };
     request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
     request.send(`id_cours=${myId}`);



}

function registration_training_default(myId , button){
  let init = 0;

  const request = new XMLHttpRequest();
  request.open('POST' , 'process/add_registration_training');
  request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
  request.send(`id_cours=${myId}&default=${init}`);
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200){

      if(request.responseText == '1'){

          button.innerHTML = 'se désinscrire';

      }else if(request.responseText == '0') {

        button.innerHTML = 's\'inscrire';
      }else{
        button.innerHTML = 'complet';
        button.disabled = true ;
      }

      console.log(request.responseText);

    }
  };


}


function entry_or_not(id){
  let button = document.getElementById(id);

   if(button.innerHTML == 's\'inscrire'){

     button.innerHTML = 'se désinscrire';


   }else if(button.innerHTML == 'se désinscrire'){

     button.innerHTML = 's\'inscrire';

   }




}
