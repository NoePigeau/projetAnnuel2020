
setTimeout(default_like, 100);

function default_like(){

  let like = document.getElementsByClassName('likes_post');


  for(let i = 0 ; i < like.length ; i++){

    put_like_default(like[i].id);

  }

}



function put_like(myId){

  const request = new XMLHttpRequest();
  request.open('POST' , 'put_like');
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200 ){

      let all_text = request.responseText.split(" ");
      document.getElementById(myId + '1').innerHTML = all_text[0];


    }
  };
     request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
     request.send(`id=${myId}`);



}

function put_like_default(myId){


  let init = 0;

  const request = new XMLHttpRequest();
  request.open('POST' , 'put_like');
  request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
  request.send(`id=${myId}&default=${init}`);
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status == 200){


      let all_text = request.responseText.split(" ");
      console.log(all_text[1]);

      document.getElementById(myId + '1').innerHTML = all_text[0];


      if(all_text[1] == '0'){

          document.getElementById(myId).innerHTML ='J\'aime';

      }else if(all_text[1] == '1') {

        document.getElementById(myId).innerHTML ='Je n\'aime plus';


      }


    }
  };
}

function like_or_not(myId){

  let button = document.getElementById(myId);
  if(button.innerHTML == 'J\'aime'){

    button.innerHTML = 'Je n\'aime plus';


  }else if(button.innerHTML == 'Je n\'aime plus'){

    button.innerHTML = 'J\'aime';

  }




}
