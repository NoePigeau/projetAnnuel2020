
function modify_information(myId){

  let all_button = document.getElementsByClassName('rounded-pill');
  all_button = [all_button[0].id ,all_button[1].id ,all_button[2].id ,all_button[3].id];

  let the_div = document.getElementById('div');
  the_div.innerHTML = "";

  let button_back = document.createElement('button');
  button_back.innerHTML = 'retour';
  button_back.className='small rounded-pill';
  button_back.onclick =function(){ all_information( all_button[0] ,  all_button[1] , all_button[2],  all_button[3] , the_div) };
  the_div.appendChild(button_back);

  let input_modify = document.createElement('input');
  input_modify.className = 'input';
  if(myId != all_button[3]){

    input_modify.value = myId;

  }else{

    input_modify.value = '';

  }
  the_div.appendChild(input_modify);

  let button_modify = document.createElement('button');
  button_modify.innerHTML = 'modifier';
  button_modify.className='rounded-pill';
  button_modify.id = all_button.indexOf(myId);
  button_modify.onclick=function(){ modification_server(input_modify.value , this.id, the_div , all_button) };
  the_div.appendChild(button_modify);

  let new_msg = document.createElement('p');
  new_msg.id = "msg";
  the_div.appendChild(new_msg);

}

function all_information(id1 , id2 , id3 , id4 , the_div) {

  the_div.innerHTML = "";

  p_and_button(id1 , 'nom: ', the_div);
  p_and_button(id2 , 'Prénom: ', the_div);
  p_and_button(id3 , 'Email: ', the_div);

  let new_p4 = document.createElement('p');
  new_p4.innerHTML = 'Mot de passe: ******';
  the_div.appendChild(new_p4);
  let new_button4 = document.createElement('button');
  new_button4.className='rounded-pill';
  new_button4.id = id4;
  new_button4.innerHTML ="modifier";
  new_button4.onclick = function(){modify_information(this.id)};
  the_div.appendChild(new_button4);

}

function p_and_button(myId , name , the_div){

  let new_p = document.createElement('p');
  new_p.innerHTML = name + myId;
  the_div.appendChild(new_p);

   let new_button = document.createElement('button');
  new_button.className='rounded-pill';
  new_button.id = myId;
  new_button.innerHTML ="modifier";
  new_button.onclick =function(){modify_information(this.id)};
  the_div.appendChild(new_button);

  let br = document.createElement('br');
  the_div.appendChild(br);


}


function modification_server(myValue , myId , the_div , button){

  const request = new XMLHttpRequest();
  request.open('POST' , 'process/modification_profil_process');
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200 ){



      document.getElementById('msg').className="alert alert-warning form-control";
      document.getElementById('msg').innerHTML = request.responseText;
      if(request.responseText.indexOf('modifié') != -1){

        button[myId] = myValue;

      }



    }
  };
     request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
     request.send(`type_information=${myId}&information=${myValue}`);

}
