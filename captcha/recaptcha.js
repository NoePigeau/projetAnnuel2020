

let Mouse_X; //cordonnée x, y écran
let Mouse_Y;
let Mouse_X_canvas; //cordonnée x,y canvas
let Mouse_Y_canvas;

let x=[35,95,155,215];  //coordonné des cercles
let y=[150,150,150,150];

let souris_up = 1; //quand souris pas pressé
let block = 0; // vient maitenir le cercle dans le grand cercle

let letters = ["A" , "B" , "C" , "D"];
let random_number = parseInt(Math.random()*4);
let tmp;


function retry(){
	window.requestAnimationFrame(draw);  // relance la function draw avec une bonne frame
  x=[35,95,155,215];
	y=[150,150,150,150];

}




function WhereMouse( evt ){

	  const canvas_location= document.getElementById('canvas');

		if(evt){
        evt =evt;
    }else{

        evt = event;
    }

		 Mouse_X = evt.clientX;
		 Mouse_Y = evt.clientY;

		let scroll_x=document.body.scrollLeft || document.documentElement.scrollLeft;
		let scroll_y=document.body.scrollTop || document.documentElement.scrollTop;

		Mouse_X = Mouse_X + scroll_x;
		Mouse_Y = Mouse_Y + scroll_y;

		Mouse_X_canvas = Mouse_X - window.innerWidth /2 + 130; // taille de l'ecran sur 2
		Mouse_Y_canvas = Mouse_Y - canvas_location.offsetTop -260  ; //offsetTop revoie la taille entre la balise et son element parent





}

if(typeof window.addEventListener == 'undefined'){

    document.attachEvent("onmousemove",WhereMouse);

}else{

    document.addEventListener('mousemove',WhereMouse,false);

}

//fonction qui dessine un cercle avec un lettre si declarer dans

function dessiner(position ,x_dessin ,y_dessin, taille,nuance_rouge, nuance_vert,nuance_bleu , lettre){

    let rond = position;

        rond.fillStyle = 'rgb(' + nuance_rouge + ',' + nuance_vert +','+ nuance_bleu +')';
        rond.beginPath();
        rond.arc( x_dessin, y_dessin, taille, 0, 2 * Math.PI);
        rond.stroke();
        rond.fill();
        rond.fillStyle = 'black';
        rond.font = "30px Anton";
        rond.strokeStyle = 'black';
        rond.fillText(lettre , x_dessin - taille/4 , y_dessin + taille/4 );



}




function draw() {


        block = 0;
        let canvas = document.getElementById("canvas");
        let ctx = canvas.getContext("2d");

        ctx.clearRect(0, 0, 260, 260); //clear le canvas

        dessiner(ctx , 125 , 45, 35 ,214, 231, 233, letters[random_number]); // cercle validation


       for(let i = 0 ; i < x.length ; i++){

        dessiner(ctx , x[i] , y[i],28 ,62, 154, 243   ,letters[i]);

       }


        window.addEventListener('mouseup',function() {
            if(block == 0) {

                for(let i = 0 ; i < x.length ; i++){

                 x[i] = 35 + 60*i;
                 y[i] = 150;


            }




            }



        souris_up=1;

        });


        window.addEventListener('mousedown',function() {

            for(let i = 0 ; i < x.length ; i++){


                if(Math.sqrt( Math.pow((Mouse_X_canvas-x[i]), 2) + Math.pow((Mouse_Y_canvas-y[i]), 2) ) < 30
                    && souris_up == 1)
                {
                	x[i] = Mouse_X_canvas;
                    y[i] = Mouse_Y_canvas;
                    souris_up = 0;
                }
            }
        });




            for(let i = 0 ; i < x.length ; i++){
                    if(souris_up==0
                       && Math.sqrt( Math.pow((Mouse_X_canvas-x[i]), 2) + Math.pow((Mouse_Y_canvas-y[i]), 2) ) < 30 ){

                    	x[i]=Mouse_X_canvas;
                    	y[i]=Mouse_Y_canvas;

                    }

                    if(Math.sqrt( Math.pow((125-x[i]), 2) + Math.pow((40-y[i]), 2) ) < 10 ){
                    x[i] = 125;
                    y[i] = 30;
                    block = 1;
                    tmp = i;

                    }

            }





        if(block == 0){

             window.requestAnimationFrame(draw); // lance la fonction en boucle
        }
        else{


            if( random_number == tmp){

                dessiner(ctx , 125 , 45, 40 ,24, 249, 77, "OK");
								document.getElementById('validator').value='valide';
								/* console.log(document.getElementById('validator').value);
								document.getElementById('validator').type='hidden'; */



            }
            else{



                dessiner(ctx , 125 , 45, 40 ,120,0,0, "X");
								setTimeout(retry,1800);



            }




        }






    }
