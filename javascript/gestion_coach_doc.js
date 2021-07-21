function validated(myId){

    console.log(myId);

    const request = new XMLHttpRequest();
    request.open('POST' , 'coach_doc_process');
    request.onreadystatechange = function(){
      if(request.readyState === 4 && request.status == 200 ){

          console.log(request.responseText);
          button.closest('td').innerHTML = "compte validé";
      }
    };
       request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
       request.send(`id_sub=${myId}&action=${'yes'}`);


    let button = document.getElementById(myId);



}

function not_validated(myId){

    console.log(myId);

    const request = new XMLHttpRequest();
    request.open('POST' , 'coach_doc_process');
    request.onreadystatechange = function(){
      if(request.readyState === 4 && request.status == 200 ){

          console.log(request.responseText);
           button.closest('td').innerHTML = "compte refusé";
      }
    };
       request.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');
       request.send(`id_sub=${myId}&action=${'no'}`);

       let button = document.getElementById(myId);


}
