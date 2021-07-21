let date = new Date();

function checkForm() {
  let firstname = document.getElementById("firstname");
  const firstname_success = check_name(firstname.value.trim());
  display_error(firstname,firstname_success);

  let lastname = document.getElementById("lastname");
  const lastname_success = check_name(lastname.value.trim());
  display_error(lastname, lastname_success);

  let email = document.getElementById("email");
  const email_success = check_email(email.value.trim());
  display_error(email, email_success);

  let password = document.getElementById("password");
  const password_success = check_password(password.value.trim());
  display_error(password, password_success);

  check_bank_information();



   return firstname_success && lastname_success && password_success && email_success;

}


function display_error(input, success) {
  if (success) {
    input.className = "input";
  } else {

    input.className = "input input border border-danger";
  }
}

function check_name(l) {
  if (l.length < 3 || l.length > 25) {
    return false;
  }
  return true;
}

function check_email(l) {
  const index1 = l.indexOf("@");
  const index2 = l.indexOf(".");
  if((index1 && index2) == -1 ) {
    return false;
  }
  return true;


}

function check_password(l) {
  if (l.length < 8) {
    return false;
  }
  let countNumbers = 0;
  let countMins = 0;
  let countCaps = 0;
  for (let i = 0; i < l.length; i++) {
    const code = l.charCodeAt(i);
    if (code >= 48 && code <= 57) {
      countNumbers++;
    } else if (code >= 97 && code <= 122) {
      countMins++;
    } else if (code >= 65 && code <= 90) {
      countCaps++;
    }

  }
   return countNumbers > 0 && countMins > 0 && countCaps > 0;
}

function check_bank_information(){

  if(document.getElementById('sub').checked){

    let code1 = document.getElementById('code1');
    let code2 = document.getElementById('code2');


    code1_success = code1.value.length == 16;
    display_error(code1, code1_success);
    code2_success = code2.value.length == 3;
    display_error(code2 , code2_success);


    return code1 && code2;

  }else{

    let coach_document = document.getElementById('coach_document');

    return true;



  }



}

 sub_or_coach();

function sub_or_coach(){

  let tag_parent = document.getElementById('tag_parent');
  tag_parent.innerHTML ="";
  let sub_or_coach;

  if (document.getElementById('sub').checked) {

      sub_or_coach = document.getElementById('sub').value;

      let h4 = document.createElement('h4');
      h4.innerHTML = "Abonnement: 19€ / mois";
      h4.style.textAlign = 'center';
      tag_parent.appendChild(h4);

      let text = document.createElement('p');
      text.innerHTML = "Entrez vos numéros de carte bancaire: ";
      text.style.textAlign = 'center';
      text.style.fontSize = '12px';
      tag_parent.appendChild(text);

      let input_text ;
      createInput(input_text, "input" , "text" , "XXXX XXXX XXXX XXXX", "code1" , "code1" );

      let input_text2 ;
      createInput(input_text2, "input" , "text" , "XXX" , "code2" , "code2");

      let input_text3;
      createInput(input_text3, "input" , "date" , "XXX" , "code3", "code3"  );



  }
  else{

      sub_or_coach = document.getElementById('coach').value;
      let text = document.createElement('p');
      text.innerHTML = "Document de vérification coach ( type pdf ): ";
      text.style.textAlign = 'center';
      text.style.fontSize = '12px';
      tag_parent.appendChild(text);

      let input_file;
      createInput(input_file, "input" , "file" , "" , "coach_document" , "coach_document" );
      input_file.value = date;
      input_file.min = date;
  }


}

function createInput(input, the_class , type , placeholder , name , id  ){

  let tag_parent = document.getElementById('tag_parent');
  input = document.createElement('input');
  input.className=the_class;
  input.type=type;
  input.placeholder=placeholder;
  input.name = name;
  input.id = id;
  tag_parent.appendChild(input);



}
