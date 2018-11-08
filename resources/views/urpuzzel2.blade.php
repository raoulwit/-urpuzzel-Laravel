<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    canvas {
      position: absolute;
      left : 0;
      top: 0;
    }
    button {
      position: absolute;
      display: none;
      font-size: 16pt;
      z-index: 130;
      width: 70px;
      height: 56px;
      left: 300px;
      top: 9px;
      border-radius: 10px;
    }

    input {
      position: absolute;
      font-size: 12pt;
      z-index: 120;
      width: 270px;
      height: 50px;
      border-radius: 10px;
      text-align: center;
    }

  </style>
<body id="body">

  <canvas id="canvas0" width="1584" height="748"></canvas>
  <canvas id="canvas1" width="1584" height="748"></canvas>
  <canvas id="canvas1" width="1584" height="748"></canvas>
  <canvas id="canvas2" width="1584" height="748"></canvas>
  <canvas id="canvas3" width="1584" height="748"></canvas>
  <canvas id="canvas4" width="1584" height="748"></canvas>
  <canvas id="canvas5" width="1584" height="748"></canvas>
  <canvas id="canvas6" width="1584" height="748"></canvas>
  <canvas id="canvas7" width="1584" height="748"></canvas>
  <canvas id="canvas8" width="1584" height="748"></canvas>

<button id="btn" onclick="solveNamePuzzel">  </button>
<input type="text" id="text" />
<script>
function random_color() {
  var h1 = Math.floor(Math.random()*360);
  var h2 = Math.floor(Math.random()*101)+"%";
  var h3 = Math.floor(Math.random()*101)+"%";
  return `hsl(${h1},${h2},${h3})`;
}

function innerBerg(x, y, size, color, canvas) {
  var c2 = canvas.getContext("2d");
  var color = color;
  c2.fillStyle = color;
  c2.beginPath();
  c2.moveTo(x, y);
  c2.lineTo(x + size , y - (size * Math.sqrt(3)));
  c2.lineTo(x + (size * 2) , y);
  c2.lineTo(x , y);
  c2.closePath();
  c2.fill();
}

function innerDal(x, y, size, color, canvas) {
  var c2 = canvas.getContext("2d");
  var color = color;
  c2.fillStyle = color;
  c2.beginPath();
  c2.moveTo(x , y);
  c2.lineTo(x + size , y + (size * Math.sqrt(3)));
  c2.lineTo(x + (size * 2) , y);
  c2.lineTo(x , y);
  c2.closePath();
  c2.fill();
}

function makeBerg(x, y, size, colors12, colorRow, canvas) {
  var sq = size*Math.sqrt(3)/3;
  innerBerg(x-size*2,y+sq*2,size,colors12[colorRow[0]],canvas);
  innerBerg(x,y+sq*2,size,colors12[colorRow[1]],canvas);
  innerBerg(x-size,y-sq,size,colors12[colorRow[2]],canvas);
  innerDal(x-size,y-sq,size,colors12[colorRow[3]],canvas);
}

function makeDal(x, y, size, colors12, colorRow, canvas) {
  var sq = size*Math.sqrt(3)/3;
  innerDal(x-size*2,y-sq*2,size,colors12[colorRow[0]],canvas);
  innerDal(x,y-sq*2,size,colors12[colorRow[1]],canvas);
  innerDal(x-size,y+sq,size,colors12[colorRow[2]],canvas);
  innerBerg(x-size,y+sq,size,colors12[colorRow[3]],canvas);
}

function makeChar(low, high){
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
          pak = makeChar(65, 76);    }
        else { pak = makeChar(65, 70); }
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
        do { pak = makeChar(80, 87); }  while (al2.indexOf(pak) != -1);
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
        draaiing = makeChar(88, 90);
        resultaat = resultaat + tussen[0] + tussen2[0] + draaiing + tussen[1] + tussen2[1] + draaiing;
     }
    return resultaat;
}

function initPuzzel(size) {
  legArTeller = 1;
  legXTeller = 7;
  doorTeller = 1;

  var xx = window.innerWidth / 2;
  var yy = window.innerHeight / 2;
  var sq = size*Math.sqrt(3)/1.5;

  beginXY[1] = [-size, -size];
  beginXY[2] = [xx, -size];
  beginXY[3] = [xx * 2 + size, -size];
  beginXY[4] = [xx * 2 + size, yy * 2 + size];
  beginXY[5] = [xx, yy  * 2 + size];
  beginXY[6] = [-size, yy * 2 + size];
  beginXY[7] = [-size, yy];
  beginXY[8] = [xx * 2 + size, yy];

  eindXY[1] = [xx - size * 2 , yy - sq ];
  eindXY[2] = [xx , yy - sq * 2];
  eindXY[3] = [xx + size * 2, yy - sq ];
  eindXY[4] = [xx + size * 2, yy + sq ];
  eindXY[5] = [xx , yy + sq * 2];
  eindXY[6] = [xx - size * 2 , yy + sq ];


  // eindXY 7 en 8 worden elders in het programma gevuld
}


function giveTranslation(place, size){
    var sq = size * Math.sqrt(3)/3
    switch(place){
        case "A": return [-size * 2, -sq*2];
        case "B": return [0, -sq * 4];
        case "C": return [size * 2, -sq*2];
        case "D": return [size * 2, sq*2];
        case "E": return [0, sq * 4];
        case "F": return [-size * 2, sq*2];

        case "G": return [-size , -sq];
        case "H": return [0, -sq*2];
        case "I": return [size , -sq];
        case "J": return [size, sq];
        case "K": return [0 , sq*2];
        case "L": return [-size , sq];
   }
}

function giveColorRow(piece, turn){

    switch(piece){
        case "1": return [1,1,1,1]; break;
        case "2": return [0,0,0,0]; break;
        case "3": return [1,1,1,0]; break;
        case "4": return [0,0,0,1];
        case "5": switch(turn){
                case "X": return [1,1,0,1]; break;
                case "Y": return [1,0,1,1]; break;
                case "Z": return [0,1,1,1]; break;
        }
        case "6": switch(turn){
                case "X": return [0,0,1,0]; break;
                case "Y": return [0,1,0,0]; break;
                case "Z": return [1,0,0,0]; break;
        }
        case "7": switch(turn){
                case "X": return [0,1,1,0]; break;
                case "Y": return [1,0,1,0]; break;
                case "Z": return [1,1,0,0]; break;
        }
        case "8": switch(turn){
                case "X": return [1,0,0,1]; break;
                case "Y": return [0,1,0,1]; break;
                case "Z": return [0,0,1,1]; break;
        }
    }
}

function takeSize(e) {
  var size = Math.floor(Math.abs(e.clientX/ww2)*wh2/8);
  if (size * 4.5 > ww2) {
  size = Math.floor(ww2/4.5);
  }
  if (size * 4.5 > wh2) {
  size = Math.floor(wh2/4.5);
  }
  theSize = size;
  return size;
}

function makePiece(x, y, place, piece, turn, size, canvas, kleur1, kleur2){
    var colorRow = giveColorRow(piece, turn);
    var trans = giveTranslation(place,size);
    switch(place){
        case "A":
        case "C":
        case "E":
        case "H":
        case "J":
        case "L": makeBerg(x + trans[0], y + trans[1],
          size, [kleur1, kleur2], colorRow, canvas);
                  break;

        case "B":
        case "D":
        case "F":
        case "G":
        case "I":
        case "K": makeDal(x + trans[0], y + trans[1],
          size, [kleur1, kleur2], colorRow, canvas);
          break;
     }
}

function setEind78(legXTeller, place, size) {
  var xx = window.innerWidth / 2;
  var yy = window.innerHeight / 2;
  var sq = size*Math.sqrt(3)/3;

  switch(place){
      case "G": eindXY[legXTeller] = [xx - size, yy-sq]; break;
      case "H": eindXY[legXTeller] = [xx, yy-sq*2]; break;
      case "I": eindXY[legXTeller] = [xx + size, yy-sq]; break;
      case "J": eindXY[legXTeller] = [xx + size, yy+sq]; break;
      case "K": eindXY[legXTeller] = [xx, yy+sq*2]; break;
      case "L": eindXY[legXTeller] = [xx - size, yy+sq]; break;
      }
}


function makePuzzel(x, y, codepuzzel, size, canvas, kleur1, kleur2){
    document.getElementById("text").value = codepuzzel;
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
        var turn = codepuzzel[count+2];
        } else { turn = "X"; }
        makePiece(x, y, place, piece , turn, size, canvas, kleur1, kleur2 );
        count +=3;
    }
    if (tekst_aan){
      var ctx = canvas.getContext("2d");
      ctx.font = Math.floor(size/2) + "px Arial";
      ctx.fillStyle = "#111111";
      ctx.fillText(codepuzzel,x - size * 3.6 ,y + size * 4);
    }
}

function setBeginDraai(place) {
  switch(place){
      case "B":
      case "D":
      case "F":
      case "G":
      case "I":
      case "K":

      case "A": //return Math.PI*2/3; break;
      case "C":
      case "E":
      case "H":
      case "J":
      case "L": return 0;  break;
   }
}

function initSolvePuzzel(codepuzzel, size){

    var count = 0;
    var code_length = codepuzzel.length;
    var piece;
    while (count < code_length){
        place = codepuzzel[count];
        if (count + 1 < code_length ){
          piece = codepuzzel[count+1]; }
        else { break; }

       if (count + 2 < code_length ){
        var turn = codepuzzel[count+2];
        } else { turn = "X"; }
        //-----
        var welkCanvas = place.charCodeAt(0)-64;
      //  alert(welkCanvas);
        switch(place){
            case "A":
            case "B":
            case "C":
            case "D":
            case "E":
            case "F":
            document.getElementById("canvas"+welkCanvas).style.zIndex = doorTeller*10;
            legPiece[welkCanvas] = giveColorRow(piece, turn);
            beginDraai[welkCanvas] = setBeginDraai(place);
            dalBerg[welkCanvas] = welkCanvas % 2;

            legArTeller++;
                      break;

            default:
              document.getElementById("canvas"+legXTeller).style.zIndex = doorTeller*10;
              legPiece[legXTeller] = giveColorRow(piece, turn);
              beginDraai[legXTeller] = setBeginDraai(place);
              setEind78(legXTeller, place, size);
              dalBerg[legXTeller] = (welkCanvas +1) % 2;
              legXTeller++;
              break;
          }
          doorTeller++;
        //-----
        count +=3;
    }

}

function herstel_basis() {
  clearInterval(theInterval);
  controlClick = true;
  for(j=1; j<=8; j++) {
    canvas[j].style.opacity = 1;
    canvasAr[j].style.display = "initial";
  }
  initPuzzel(size);
}



function testSetInterval() {
//  c2Ar[0].clearRect(-300,-300,2200,1300);
//  var s = symmetrie();
//  makePuzzel(ww2, wh2, s, theSize , canvasAr[0], bl, w);
  for(j=1; j<=8; j++) {
    canvasAr[j].style.opacity = yMuis/wh2/1.7;
    c2Ar[j].clearRect(-300,-300,2200,1300);
    c2Ar[j].setTransform(1,0,0,1,beginXY[j][0]+ xyFactor * stapXY[j][0], beginXY[j][1]+ xyFactor * stapXY[j][1]);
    c2Ar[j].rotate(beginDraai[j]+xyFactor*Math.PI*2/breakCounter);
    if (dalBerg[j] == 1) {
      makeBerg(0,0,theSize,[bl,w],legPiece[j],canvasAr[j]); } else {
        makeDal(0,0,theSize,[bl,w],legPiece[j],canvasAr[j]);
      }
    }
  var plusFactor = Math.floor(xMuis/ww2*5);
  if (xyFactor + plusFactor > breakCounter) {
    setTimeout(herstel_basis,2500);
    xyFactor = breakCounter } else {
      xyFactor += plusFactor
    }
  if (xyFactor > breakCounter ) {
    clearInterval(theInterval);
  }
}

function test_het_gewoon(size) {
  for(i=1; i<=8; i++) {

    stapXY[i] = [(eindXY[i][0]-beginXY[i][0])/breakCounter , (eindXY[i][1]-beginXY[i][1])/breakCounter]
    canvasAr[i].style.opacity = yMuis/wh2;
  }
  xyFactor = 0;
  theSize = size;
  //requestAnimationFrame(doRequestAnimationFrame);
  theInterval = setInterval(function(){ testSetInterval(); }, 0);
}


function solvePuzzel(puzzel, size) {
  breakCounter = 850;
  var i = 5;
  var j = 6;
  document.getElementById("text").value = puzzel;

  initPuzzel(size);
  initSolvePuzzel(puzzel, size);
  controleer_omdraai();

  test_het_gewoon(size);
}

function controleer_omdraai() {
  if (eindXY[7][0]>ww2) {
    var h = eindXY[7];
    eindXY[7] = eindXY[8];
    eindXY[8] = h;
    h = canvasAr[7].style.zIndex;
    canvasAr[7].style.zIndex = canvasAr[8].style.zIndex;
    canvasAr[8].style.zIndex = h;
    h = legPiece[7];
    legPiece[7] = legPiece[8];
    legPiece[8] = h;
    h = beginDraai[7];
    beginDraai[7] = beginDraai[8];
    beginDraai[8] = h;
    h = dalBerg[7];
    dalBerg[7] = dalBerg[8];
    dalBerg[8] = h;
  }
}

function clickDone() {
  solvePuzzel(thePuzzel, theSize);
}

//--------------------------------------------------------------------------
function mainFunction(e) {
  document.getElementById("btn").style.backgroundColor = random_color();
  document.getElementById("btn").style.color = random_color();
  for (i=0; i<=8; i++){
    canvasAr[i].getContext("2d").clearRect(-300, -300, 2200, 1500);
  }
  thePuzzel = symmetrie(); //"A7XB7XC7XD8XE8XF8X";
  //if (ee == 0) {alert(puzzle); ee = 1;}

  makePuzzel(ww2, wh2, thePuzzel, takeSize(e) , canvasAr[0], bl, w);
}
//--------------------------------------------------------------------------


function doResize() {
  for (i=0; i<=8; i++) {
    document.getElementById("canvas"+i).width = window.innerWidth;
    document.getElementById("canvas"+i).height = window.innerHeight;
  }
  ww2 = window.innerWidth/2;
  wh2 = window.innerHeight/2;
}

window.onload = function() {

  doResize();
  for (i=0; i<=8; i++) {
    canvasAr[i] = document.getElementById("canvas"+i);
    c2Ar[i]=canvasAr[i].getContext("2d");
  }
  //canvasAr[2].getContext("2d").translate(400,400);
  canvasAr[0].style.backgroundColor = `rgb(80,80,80)`;
  document.addEventListener("mousemove", function(e) {
  //  console.log(window.innerWidth+"  "+window.innerHeight);
    xMuis = e.clientX;
    yMuis = e.clientY;
    if (controlClick) { mainFunction(e); }
  });

}

document.getElementsByTagName("BODY")[0].onresize = function() {
  doResize();
}

document.querySelector("html").onclick= function(e) {
  if (controlClick) { clickDone();}
  controlClick = false;
}

function solveNamePuzzel() {
  solvePuzzel(document.getElementById("text").value, theSize)
}

document.getElementById("text").addEventListener("click", solveNamePuzzel);


var bl = "#000000";
var w = "#FFFFFF";
var ee = 0;
var tekst_aan = true;
var ww2,wh2;
var thePuzzel;
var theSize;

var canvasAr = [];
var c2Ar = [];
var legPiece = [];
var beginDraai = [];
var beginXY = [];
var stapXY = [];
var eindXY = [];
var dalBerg = [];
var legArTeller;
var legXTeller;
var doorTeller;
var xyFactor;
var breakCounter;
var controlClick = true;
var delayCounter;
var theInterval;
var xMuis;
var yMuis;

</script>
</body>
</html>
