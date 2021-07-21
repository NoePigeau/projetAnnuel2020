

let div_secret = document.getElementById('sct');
let div_quizz = document.getElementById('quizz');
console.log(div_secret);
div_secret.addEventListener("mouseover", div_change);

function div_change(){
  div_quizz.innerHTML="";

  let a = document.createElement('a');
  a.href='quizz.html';
  a.innerHTML='???';
  div_quizz.appendChild(a);


}
