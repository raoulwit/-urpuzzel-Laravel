<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<body>
<div>
  <canvas id="myCanvas" width="1584" height="748"></canvas>
</div>
<script>


function chr(low, high){
  var t = Math.floor(Math.random() * (high - low + 1)  + low);
  return String.fromCharCode(t)
}

function symmetrie(){
    var resultaat = "";
    var al = "";
    var al2 = "";
    var tussen = "";
    var tussen2 = "";
    var teller_b = 0;
    var pak = "";

    while (resultaat.length<23)
    {   do {
        if ((teller_b < 1)&&(resultaat.length > 11)){
          pak = chr(65, 76);    }
        else { pak = chr(65, 70); }
      } while (al.indexOf(pak) != -1);

        switch (pak){
            case "A" : tussen = "AD" ; al = al + "AB"; break;
            case "B" : tussen = "DA" ; al = al + "AB"; break;
            case "C" : tussen = "BE" ; al = al + "CD"; break;
            case "D" : tussen = "EB" ; al = al + "CD"; break;
            case "E" : tussen = "CF" ; al = al + "EF"; break;
            case "F" : tussen = "FC" ; al = al + "EF"; break;
            case "G" : tussen = "GJ" ; al = al + "GH"; teller_b++; break;
            case "H" : tussen = "JG" ; al = al + "GH"; teller_b++; break;
            case "I" : tussen = "HK" ; al = al + "IJ"; teller_b++; break;
            case "J" : tussen = "KH" ; al = al + "IJ"; teller_b++; break;
            case "K" : tussen = "IL" ; al = al + "KL"; teller_b++; break;
            case "L" : tussen = "IL" ; al = al + "KL"; teller_b++; break;
        }

        do { pak = chr(80, 87); }  while (al2.indexOf(pak) != -1);

        switch (pak){
            case "P" : tussen2 = "12" ; al2 = al2 + "PQ"; break;
            case "Q" : tussen2 = "21" ; al2 = al2 + "PQ"; break;
            case "R" : tussen2 = "34" ; al2 = al2 + "RS"; break;
            case "S" : tussen2 = "43" ; al2 = al2 + "RS"; break;
            case "T" : tussen2 = "56" ; al2 = al2 + "TU"; break;
            case "U" : tussen2 = "65" ; al2 = al2 + "TU"; break;
            case "V" : tussen2 = "78" ; al2 = al2 + "VW"; break;
            case "W" : tussen2 = "87" ; al2 = al2 + "VW"; break;
        }
        draaiing = chr(88, 90);
        resultaat =
resultaat + tussen[0] + tussen2[0] + draaiing + tussen[1] + tussen2[1] + draaiing;

     }

    return resultaat;
}



function inner_berg(x,y,size,color,canvas){
  var c2 = canvas.getContext("2d");
  var color = color;
  c2.fillStyle = color;
  c2.beginPath();
  c2.moveTo(x, y);
  c2.lineTo(x+size,y - (size * 1.7320508));
  c2.lineTo(x+(size * 2), y);
  c2.lineTo(x, y);
  c2.closePath();
  c2.fill();
}

function inner_dal(x,y,size,color,canvas){
  var c2 = canvas.getContext("2d");
  var color = color;
  c2.fillStyle = color;
  c2.beginPath();
  c2.moveTo(x, y);
  c2.lineTo(x+size,y + (size * 1.7320508));
  c2.lineTo(x+(size * 2), y);
  c2.lineTo(x, y);
  c2.closePath();
  c2.fill();
}

function berg_stukje(x,y,arcolor,size,canvas){
  var xsize = size * 1.7320508;
  inner_berg(x,y,size,arcolor[0],canvas);
  inner_berg(x + (size * 2),y,size,arcolor[1],canvas);
  inner_berg(x + size,y - xsize,size,arcolor[2],canvas);
  inner_dal(x + size,y - xsize,size,arcolor[3],canvas);
}

function dal_stukje(x,y,arcolor,size,canvas){
  var xsize = size * 1.7320508;
  inner_dal(x,y,size,arcolor[1],canvas);
  inner_dal(x + (size * 2),y,size,arcolor[0],canvas);
  inner_dal(x + size,y + xsize,size,arcolor[2],canvas);
  inner_berg(x + size,y + xsize,size,arcolor[3],canvas);
}


function geef_kleuren (piece, turn, kleur1, kleur2){
    var w = kleur2;
    var bl = kleur1;
    switch(piece){
        case "1": return [w,w,w,w]; break;
        case "2": return [bl,bl,bl,bl]; break;
        case "3": return [w,w,w,bl]; break;
        case "4": return [bl,bl,bl,w];
        case "5": switch(turn){
                case "X": return [w,w,bl,w]; break;
                case "Y": return [w,bl,w,w]; break;
                case "Z": return [bl,w,w,w]; break;
        }
        case "6": switch(turn){
                case "X": return [bl,bl,w,bl]; break;
                case "Y": return [bl,w,bl,bl]; break;
                case "Z": return [w,bl,bl,bl]; break;
        }
        case "7": switch(turn){
                case "X": return [w,w,bl,bl]; break;
                case "Y": return [w,bl,w,bl]; break;
                case "Z": return [bl,w,w,bl]; break;
        }
        case "8": switch(turn){
                case "X": return [bl,bl,w,w]; break;
                case "Y": return [bl,w,bl,w]; break;
                case "Z": return [w,bl,bl,w]; break;
        }
    }
}

function geef_translatie(place, size){
    var xsize = size * 1.7320508; //  wortel 3 = 2 x sin 60 graden
    switch(place){
        case "A": return [0, 0];
        case "B": return [size * 2, -xsize * 2];
        case "C": return [size * 4, 0];
        case "D": return [size * 4, 0];
        case "E": return [size * 2, xsize * 2];
        case "F": return [0, 0];

        case "G": return [size * 2, 0];
        case "H": return [size * 3, -xsize];
        case "I": return [size * 3, xsize];
        case "J": return [size * 2, 0];
        case "K": return [size , xsize];
        case "L": return [size , -xsize];
   }
}


function maak_stukje(x, y, place, piece, turn, size, canvas, kleur1, kleur2){
    var arcolor = geef_kleuren(piece, turn, kleur1, kleur2);
    var trans = geef_translatie(place,size);
    switch(place){
        case "A":
        case "C":
        case "E":
        case "G":
        case "I":
        case "K": berg_stukje(x + trans[0], y + trans[1], arcolor,
size, canvas);
                  break;

        case "B":
        case "D":
        case "F":
        case "H":
        case "J":
        case "L": dal_stukje(x + trans[0], y + trans[1],
arcolor, size, canvas); break;
     }
}

function maak_de_puzzel(x, y, codepuzzel, size, canvas, kleur1, kleur2){
    var count = 0;
//    codepuzzel = "A1XB2XC3XD4XE5XF6Z";
    var code_length = codepuzzel.length;
    var piece;
    while (count < code_length){
        place = codepuzzel[count];
        if (count + 1 < code_length ){
          piece = codepuzzel[count+1]; }
        else { break; }

       if (count + 2 < code_length ){
           turn = codepuzzel[count+2];
        } else { turn = "X"; }
        maak_stukje(x, y, place, piece , turn, size, canvas, kleur1, kleur2 );
        count +=3;
    }
    if (tekst_aan){
      var ctx = canvas.getContext("2d");
      ctx.font = Math.floor(size/2) + "px Arial";
      ctx.fillStyle = "#111111";
      ctx.fillText(codepuzzel,x + size * 0.3 ,y + size * 4);
    }

}


function testje(e){
  var canvas = document.getElementById("myCanvas");
   canvas.style.opacity = (window.innerHeight-(window.innerHeight/7.4)-e.clientY)/(window.innerHeight/1.4);
    if (true || e.clientX%8 == 0 ) {
  const context = canvas.getContext('2d');
  context.clearRect(0, 0, canvas.width, canvas.height);

    var xi = Math.floor(Math.abs(e.clientX)/18);
    for (i=1; i<=1; i++){
      var  w = wit;//random_kleur();
//      var  w1 = wit;//random_kleur();
      var bl = zwart;//random_kleur();
//      var bl1 = zwart;//random_kleur();
        maak_de_puzzel(window.innerWidth/2-xi*4, window.innerHeight/2, symmetrie(), xi, canvas,bl,w);
        tekst();
        document.querySelector("html").onclick= function(e){
          blijf_zichtbaar = false;

          if(palet === 1){
            palet_x = e.clientX;
            palet_y = e.clientY;
            palet = 2;
            return;
          }
          if(palet === 2){
            palet = 0;
            var x = e.clientX;
            var y = e.clientY;
            palet1(e,x,y);
      //      canvas.Clear();
            return;
          }
              if ((e.clientX > (window.innerWidth/1.007))&&(e.clientY > (window.innerHeight/1.007))){
              var ctx = canvas.getContext("2d");
              ctx.fillStyle = "#111111";(window.innerWidth/1.007)
              ctx.font = Math.floor(window.innerWidth/6) + "px Arial";
              canvas.style.opacity = 1;
                ctx.fillText("Lorem ipsum dolor sit amet",(window.innerWidth/75),(window.innerHeight/1.9));
              return
            }
            if (((e.clientX < 270)&&(e.clientY < 50))&&
              ((e.clientX > 31)&&(e.clientY > 30)))
              {
              tekst_aan = true;
              canvas.style.backgroundColor = random_kleur();
              maak_veel_kleur();
              wit = dewit;
              zwart = dezwart;
              canvas.style.backgroundColor = deachtergrond;
              return;
            } else{
              if (((e.clientX>=56)&&(e.clientY>=65))
              &&((e.clientX<=223)&&(e.clientY<=73))){
                tekst_aan = false;
                var keus = Math.random()*10
                 if (keus>3){
                   if(keus>6){
                     zwart = random_kleur();
                     wit = "#FFFFFF";
                   } else{
                   wit = random_kleur();
                   zwart = "#000000";
                 }
                 } else{
                   wit = random_kleur();
                   zwart = random_kleur();

                 }
              }
            mux1 = e.clientX - 56;
            mux2 = e.clientX + 56;
            muy1 = e.clientY - 23
            muy2 = e.clientY + 23;
            mukleur = canvas.style.backgroundColor;
            deachtergrond = mukleur;
              if (e.clientY < (window.innerHeight/1.3)){ maak_veel()} else {
              canvas.style.opacity = 1;
              palet = 1;
              palet_x = e.clientX;
              palet_y = e.clientY - (window.innerHeight/1.15)
              palet = 1;
;
              tekst_aan = false;
              kleuren_palet(e);
            }
          }
          };
    }

 }

 function tekst(){
      var ctx = canvas.getContext("2d");
   ctx.fillStyle = "#111111";
   ctx.font = "30px Arial";
   ctx.fillText("Raoul Witsenburg",20,40);
   ctx.fillStyle = "#111111";
   ctx.font = "20px Arial";
   ctx.fillText("programming wizard",40,65);
 }

  function maak_veel(){
    console.log("maakveel");

    var canvas = document.getElementById("myCanvas");
    const context = canvas.getContext('2d');
 //   context.fillStyle = "#FF0000";//"darkgrey";
 //   context.fillRect(0,0,canvas.width,canvas.height);
    var xi = Math.floor(Math.abs(e.clientX)/(17*1584/window.innerWidth));
    if ((xi == 0)||(xi >= 87)){return};
    context.clearRect(0, 0, canvas.width, canvas.height);
   var yi= xi *1.7320508/2;
   var xteller = Math.floor(window.innerWidth/(xi * 10));
   var yteller = Math.floor(window.innerHeight/(yi * 10));
   var totaal = xteller * yteller;
   var xmarge =(window.innerWidth -((xteller-.2)*xi*10))/2;
   var ymarge =(window.innerHeight -((yteller-.2)*yi*10))/2;

    for (i=0; i<xteller; i++){
     var  w = wit;//random_kleur();
     var bl = zwart;//random_kleur();
      //  maak_de_puzzel(1250-(xi *3.5), 350-(xi/3), symmetrie(), xi, canvas2,bl,w);
      //  maak_stukje(100, 40, "B", 7 , "X", 70, canvas2);
       for (j=0; j<yteller; j++){
         var x=i * xi * 10 + xmarge;
         var y=j*yi*10 +ymarge +4*yi;
        maak_de_puzzel(x, y, symmetrie(), xi, canvas,bl,w);
      }
    }
  }

   function maak_heel_veel(){
     console.log("maakheelveel");
     return;

     var canvas = document.getElementById("myCanvas");
     const context = canvas.getContext('2d');
  //   context.fillStyle = "#FF0000";//"darkgrey";
  //   context.fillRect(0,0,canvas.width,canvas.height);
     var xi = Math.floor(Math.abs(e.clientX)/(17*1584/window.innerWidth));
     if ((xi == 0)||(xi >= 87)){return};
     context.clearRect(0, 0, canvas.width, canvas.height);
    var yi= xi *1.7320508/2;
    var xteller = Math.floor(window.innerWidth/(xi * 3.5));
    var yteller = Math.floor(window.innerHeight/(yi * 2.6));
    var totaal = xteller * yteller;
    var xmarge =(window.innerWidth/-7);
    var ymarge =(window.innerHeight/-7);

    blijf_zichtbaar = true;

    var  w = wit;//random_kleur();
    var bl = zwart;//random_kleur();
    var vvran = Math.random();
    if (vvran > 0.7){
      w = "#FFFFFF";
      bl = "#000000";
    }
     for (i=0; i<xteller; i++){
       //  maak_de_puzzel(1250-(xi *3.5), 350-(xi/3), symmetrie(), xi, canvas2,bl,w);
       //  maak_stukje(100, 40, "B", 7 , "X", 70, canvas2);
        for (j=0; j<yteller; j++){
            if (vvran <= 0.7){
            w = random_kleur();
            bl = random_kleur();
          }

          var x=i * xi * 4 + xmarge;
          var y=j*yi*4 +ymarge ;
         maak_de_puzzel(x, y, symmetrie(), xi, canvas,bl,w);
       }
     }
   }

 function maak_veel_kleur(){
  console.log("maakveelkleeru");
   var canvas = document.getElementById("myCanvas");
   const context = canvas.getContext('2d');
   var xi = Math.floor(Math.abs(e.clientX)/(17*1584/window.innerWidth));
   if ((xi == 0)||(xi >= 87)){return};
   context.clearRect(0, 0, canvas.width, canvas.height);
  var yi= xi *1.7320508/2;
  var xteller = Math.floor(window.innerWidth/(xi * 10));
  var yteller = Math.floor(window.innerHeight/(yi * 10));
  var totaal = xteller * yteller;
  var xmarge =(window.innerWidth -((xteller-.2)*xi*10))/2;
  var ymarge =(window.innerHeight -((yteller-.2)*yi*10))/2;

   for (i=0; i<xteller; i++){
      for (j=0; j<yteller; j++){
        var  w = random_kleur();
        var bl = random_kleur();
        var x=i * xi * 10 + xmarge;
        var y=j*yi*10 +ymarge +4*yi;
       maak_de_puzzel(x, y, symmetrie(), xi, canvas,bl,w);
     }
   }

 }
}

function palet1(e,x,y){
  console.log("palet1");

  var ti = (x-margex)/grootte_x;
  var i = Math.trunc(ti);
  var tj = (y-margey)/grootte_y;
  var j = Math.trunc(tj);
  ti = ti - i;
  tj = tj - j;
  if((ti>0.8)||(tj>0.8)){

//   mux1 = -1;
    tekst_aan = true;
    wit = dewit;
    zwart = dezwart;
  //  testje(e);
    return;
  } else{
    wit = creer_w(i,j,palet_x,palet_y);
    dewit = wit;
    zwart = creer_bl(i,j,palet_x,palet_y);
    dezwart = zwart;
  }
}

function kleuren_palet(e){
  console.log("kleurenpalet");
  var canvas = document.getElementById("myCanvas");
  const context = canvas.getContext('2d');

//   context.fillStyle = "#FF0000";//"darkgrey";
//   context.fillRect(0,0,canvas.width,canvas.height);
  var xi = 10*window.innerWidth/1584;
  if ((xi == 0)||(xi >= 87)){return};
  context.clearRect(0, 0, canvas.width, canvas.height);
 var yi= xi *1.7320508/2;
 var xteller = Math.floor(window.innerWidth/(xi * 10));
 var yteller = Math.floor(window.innerHeight/(yi * 10));
 var totaal = xteller * yteller;
 var xmarge =(window.innerWidth -((xteller-.2)*xi*10))/2;
 var ymarge =(window.innerHeight -((yteller-.2)*yi*10))/2;
 var x = e.clientX;
 var y = e.clientY;
 margex = xmarge;
 margey = ymarge;
 grootte_x = xi*10;
 grootte_y = yi*10;
 var  w = wit;//random_kleur();
 var bl = zwart;//random_kleur();
 console.log(grootte_x+" "+grootte_y);
 for (i=0; i<xteller; i++){
       for (j=0; j<yteller; j++){
         w = creer_w(i,j,e.clientX,e.clientY);
         bl = creer_bl(i,j,e.clientX,e.clientY);

       var x=i * xi * 10 + xmarge;
       var y=j*yi*10 +ymarge +4*yi;
      maak_de_puzzel(x, y, symmetrie(), xi, canvas,bl,w);
    }
  }


}

//---------------------------------------------------------------
//---------------------------------------------------------------
//  De getallen tussen deze dubbele dubbele lijnen
//  na h1, h2, h3, h4, h5, h6 zijn vrij aan te passen en
//  daarmee de kleurencombinaties van de colorpicker
//  (De %360 en %101 kunnen niet 'echt' veranderd worden)


function creer_w(i,j,x,y){
  var h1 = ((x)*201 + i*41 + j*23)%360;
  var h2 = (x*3)%101+"%";
  var h3 = (x*4+y*64+i*7 +j*4)%101+"%";

  return `hsl(${h1},${h2},${h3})`;
}

function creer_bl(i,j,x,y){
  var h4 = ((x)*116 + 180+ i*99 + j*37)%360;
  var h5 = (y*253)%101+"%";
  var h6 = ((window.innerWidth*1.15)-y)%101 +"%";
  return `hsl(${h4},${h5},${h6})`;
}

//----------------------------------------------------------------
//----------------------------------------------------------------

window.onload = function(){

  document.addEventListener("mousemove", function(e) {
  //  console.log(window.innerWidth+"  "+window.innerHeight);
    if (blijf_zichtbaar){return}
    if (palet === 1){
      kleuren_palet(e);
      return;
    }
    if (palet === 2){
      return;
    }
    if (mux1 === -1){
    testje(e)} else {
      if ((e.clientX< mux1)||(e.clientX > mux2)){
        mux1 = -1;
      } else{
        if(( e.clientY < muy1)||(e.clientY > muy2)){
          stel_kleur_achter(e)
        }
       }}
  });

}

function stel_kleur_achter(e){
  var canvas = document.getElementById("myCanvas");
  if(e.clientY<=100){
//   if((e.clientY>=muy1)&&(e.clientY<=muy2)){
    canvas.style.backgroundColor = mukleur;

    return;
  }
  var canvas = document.getElementById("myCanvas");
  if (e.clientY < 200){
    var kleur = Math.floor((100-(e.clientY-100))*1.2)-10+"%";
    canvas.style.backgroundColor = `hsl(0,0%,${kleur})`;

  } else{
    var kleur = Math.floor(((e.clientY-200)/(canvas.height-200))*361);
    canvas.style.backgroundColor = `hsl(${kleur},50%,50%)`;
  }
}

function random_kleur(){
  var h1 = Math.floor(Math.random()*360);
  var h2 = Math.floor(Math.random()*101)+"%";
  var h3 = Math.floor(Math.random()*101)+"%";
  return `hsl(${h1},${h2},${h3})`;
}

var ccc=document.getElementById("myCanvas");
ccc.style.backgroundColor = `rgb(80,80,80)`;
/*
var canvas = document.createElement("CANVAS");
document.body.appendChild(canvas);
canvas.id ="myCanvas";
canvas.width = "1584px";
canvas.height = "748px";
canvas.style.backgroundColor = `rgb(80,80,80)`;
canvas.style.position = "fixed";
*/
var zwart = "#000000";
var dezwart = zwart;
var wit = "#FFFFFF";
var dewit = wit;
var mux1 = -1;
var mux2 = -1;
var muy1, muy2, mukleur;
var tekst_aan = true;
var palet = 0;
var palet_x = 0;
var palet_y = 0;
var h1,h2,h3,h4,h5,h6;
var margex,margey,grootte_x,grootte_y;
var deachtergrond = `rgb(80,80,80)`;
var blijf_zichtbaar = false;

</script>
</body>
</html>
