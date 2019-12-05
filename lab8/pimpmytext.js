function timer(){
  setInterval(Bigger, 500);
}

function Bigger(){
  if($("text_area").style.fontSize === ""){
    $("text_area").style.fontSize = "12pt";
  } else{
    $("text_area").style.fontSize = parseInt($("text_area").style.fontSize)+2+"pt";
  }
}
function pops_up(){
  alert("Bling!");
  if($("Bling").checked == true){
    $("text_area").style.fontWeight  = "bold";
    $("text_area").style.color  = "green";
    $("text_area").style.textDecoration  = "underline";
    var body = document.getElementsByTagName("body");
    body[0].style.backgroundImage = "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)";
  } else{
    $("text_area").style.fontWeight  = "normal";
    $("text_area").style.color  = "black";
    $("text_area").style.textDecoration  = "none";
  }
}
function upper(){
  $("text_area").value = $("text_area").value.toUpperCase();
  var dummy = $("text_area").value.split(".");
  $("text_area").value = dummy.join("-izzle.");
}
function ig(){
  var back="";
  while(1){
    if($("text_area").value[0]!="a" && $("text_area").value[0]!="e" && $("text_area").value[0]!="i" && $("text_area").value[0]!="o" && $("text_area").value[0]!="u"){
      back += $("text_area").value[0];
      $("text_area").value = $("text_area").value.substr(1);
    } else{
        $("text_area").value = $("text_area").value + back + "ay";
        break;
    }
  }
}
function mk(){
  if($("text_area").value.length >= 5){
    $("text_area").value = "Malkovitch";
  }
}
window.onload = function(){
  $("bntBig").onclick = timer;
  $("Bling").onchange = pops_up;
  $("snoop").onclick = upper;
  $("igpay").onclick = ig;
  $("malkovitch").onclick = mk;
}
