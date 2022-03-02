<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title id="title"></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
<script>
/*const p = "http://152.70.55.33/";*/
const p = "http://localhost/";
var m = false;
function l() {
 if(r == null)
 {
 let _a = "";
 for(let i =1; i < parseInt(window.innerWidth/100)+1; i++)
 _a += (100/parseInt(window.innerWidth/100))+"% ";
 document.getElementsByTagName("section")[0].style.gridTemplateColumns = _a;
 }
 else
 {
 if(window.innerHeight < window.innerWidth)
 {
 document.getElementById("a").innerHTML = " POBIERZ PLIK";
 document.getElementById("b").innerHTML = "KOPIUJ LINK";
 }
 else 
 {
 document.getElementById("a").innerHTML = "<img src='./res/download.png' class='p'>";
 document.getElementById("b").innerHTML = "<img src='./res/copy.png' class='p'>";
 }
 }
 document.getElementsByTagName("section")[0].style.height = document.getElementsByTagName('html')[0].offsetHeight - document.getElementsByTagName('header')[0].offsetHeight + "px";
 }
 function o(_a, _b) { 
 return _a.filter((_c) =>{ 
 return _c != _b; 
 });
 }
 function w(_b) {
 _b.style.display = 'block';
 let _a = 0.2, _c = setInterval(() => {
 if (_a >= 1){
 clearInterval(_c);
 }
 _b.style.opacity = _a;
 _b.style.filter = 'alpha(opacity=' + _a * 100 + ")";
 _a += _a * 0.1;
 }, 10);
 }
 function v(_a) {
 let _b = null, _c = [];
 location.search.substr(1).split("&").forEach(function (_d) {
 _c = _d.split("=");
 if (_c[0] === _a) _b = decodeURIComponent(_c[1]);
 });
 return _b;
 }
 function u() {
 if (!m)
 {
 navigator.clipboard.writeText(window.location);
 w(document.getElementById("f"));
 document.getElementById("f").animate([
 { opacity: "0.0" },
 { opacity: "1.0" }
 ], {
 duration: 500,
 iterations: 1
 });

 setTimeout(() => {
 document.getElementById("f").animate([
 { opacity: "1.0" },
 { opacity: "0.0" }
 ], {
 duration: 1000,
 iterations: 1
 });

 document.getElementById("f").animate([
 { transform: 'translateY(0px)' },
 { transform: 'translateY(-100px)' }
 ], {
 duration: 1000,
 iterations: 1
 });
 setTimeout(() => {
 document.getElementById("f").style.transform = "translateY(0px)";
 document.getElementById("f").style.opacity = "0.0";
 }, 990);
 }, 1000);
 }
 }
 function n() {
 m = true;
 let _a = document.getElementById("d").parentElement, _b = document.createElement("div");
 _a.childNodes[1].remove();
 _b.id = "a";
 _b.innerText = "POBIERZ PLIK";
 _b.style.backgroundColor = "#464a52";
 document.getElementById("b").style.backgroundColor = "#464a52";
 _b.style.color = "#d6d6d6";
 document.getElementById("b").style.color = "#d6d6d6";
 _b.style.textDecoration = "line-through";
 document.getElementById("b").style.textDecoration = "line-through";
 _b.style.cursor = "not-allowed";
 document.getElementById("b").style.cursor = "not-allowed";
 _a.appendChild(_b)
 }
 const r = v("filename");
 const t = encodeURI(p + "/public/" + r);
 let s = "";
 var a= ["index.html"];
 var b = ["docx","doc", "docm"];
 var c = ["xlsx", "xls", "xlsm"];
 var d = ["pptx","ppt", "pptm", "pps", "ppsx"];
 var e = ["png", "apng", "jpg", "jpeg", "gif", "webp", "bmp"];
 var f = ["ico", "svg"];
 var g = ["ogg", "webm", "mp4"];
 var h = ["mp3", "wav"];
 var i = ["txt","md", "rtf", "csv"];
 var j = ["exe", "dll", "msi", "run", "inf"];
 var k = ["exe", "dll", "msi", "run", "inf", "bin", "iso", "img"];
 document.getElementById("title").innerText = r;
 if(r == "null") { }
 else if (a.includes(r))
 s = "nonexistant";
 else if (b.concat(c.concat(d)).includes(r.split(".").pop().toLowerCase()))
 s = "office";
 else if (e.concat(f).includes(r.split(".").pop().toLowerCase()))
 s = "image";
 else if (g.includes(r.split(".").pop().toLowerCase()))
 s = "video";
 else if (h.includes(r.split(".").pop().toLowerCase()))
 s = "audio";
 else if (k.includes(r.split(".").pop().toLowerCase()))
 s = "not_viewable";
 else if (r.split(".").pop().toLowerCase() == "pdf")
 s = "pdf";
 else
 s = "raw"
 function q(){
 if(r == null)
 {
 document.getElementById("e").innerHTML = "<h1 id='r'>Wybierz plik:</h1>";
 document.getElementById("e").style.justifyContent = "center";
 document.getElementsByTagName("section")[0].style.overflow = "auto";
 document.getElementsByTagName("section")[0].style.display = "grid"
 document.getElementsByTagName("section")[0].style.gridAutoRows = "25%";
 document.getElementsByTagName("section")[0].style.padding= "1%";
 o( o(JSON.parse(document.getElementById("files").value),"."), "..").forEach(_d => 
 {
 let _a = document.createElement("a");
 _a.href = p+"?filename="+_d;
 let _b = document.createElement("div");
 _b.classList.add("g");
 let _c = document.createElement("img");
 _c.classList.add("n");
 _c.src = "./res/base.png";
 if(b.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/word.png";
 else if(c.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/excel.png";
 else if(d.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/powerpoint.png";
 else if(e.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/image.png";
 else if(g.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/video.png";
 else if(h.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/music.png";
 else if(i.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/text.png";
 else if(f.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/svg.png";
 else if(j.includes(_d.split(".").pop().toLowerCase()))
 _c.src = "./res/exec.png";
 else if("pdf" == _d.split(".").pop().toLowerCase())
 _c.src = "./res/pdf.png";
 let _e = document.createElement("span");
 _e.classList.add("o");
 _e.innerText = _d;
 _b.appendChild(_c);
 _b.appendChild(_e);
 _a.appendChild(_b);
 document.getElementsByTagName("section")[0].appendChild(_a);
 });
 }
 else 
 {
 if (s == "office")
 { 
 let _a = document.createElement("iframe"), _b = document.createElement("p");
 _a.frameBorder = "no";
 _a.id = "m";
 _a.src = "https://view.officeapps.live.com/op/embed.aspx?src=" + t;
 _b.innerText = "Ta przeglądarka nie obsługuje podglądu, możesz dalej pobać plik.";
 _a.appendChild(_b);
 document.getElementsByTagName("section")[0].appendChild(_a);
 }
 else if (s == "image")
 {
 let _a = document.createElement("img");
 _a.src = t;
 _a.alt = r;
 _a.id = "i";
 document.getElementsByTagName("section")[0].appendChild(_a);
 } 
 else if (s == "video")
 {
 let _a = document.createElement("video"), _b = document.createElement("source");
 _b.src = t;
 _a.controls = true;
 _a.id = "j";
 _a.innerText = "Twoja przegladarka nie obsługuje odtwarzania tego filmu, możesz go dalej pobrać";
 _a.appendChild(_b);
 document.getElementsByTagName("section")[0].appendChild(_a);
 }
 else if (s == "audio")
 {
 let _a = document.createElement("audio"), _b = document.createElement("source");
 _b.src = t;
 _a.controls = true;
 _a.id = "k";
 _a.innerText = "Twoja przegladarka nie obsługuje odtwarzania pliku audio, możesz go dalej pobrać";
 _a.appendChild(_b);
 document.getElementsByTagName("section")[0].appendChild(_a);
 }
 else if (s == "not_viewable")
 {
 let _a = document.createElement("span");
 _a.id = "l";
 _a.style.color = "#151515";
 _a.style.fontSize = "x-large"
 _a.innerText = "Nie można wyświetlić podglądu dla pliku: " + r + ", możesz go dalej pobrać"
 document.getElementsByTagName("section")[0].appendChild(_a);
 }
 else if (s == "raw")
 {
 let _a = document.createElement("xmp");
 fetch(t)
 .then(response => {
 if(response.ok)
 _a.innerText = response.text()
 else 
 n();
 })
 .catch(error => {
 console.log("error", error);
 });
 document.getElementsByTagName("html")[0].style.overflow = "auto";
 document.getElementsByTagName("section")[0].style.overflow = "auto";
 _a.id = "l";
 document.getElementsByTagName("section")[0].appendChild(_a);
 }
 else if (s == "pdf")
 {
 document.getElementsByTagName("section")[0].innerHTML = "<object id='m' data='"+t+"' type='application/pdf'> <embed src='"+t+"'' type='application/pdf'/> </object>";
 }
 else 
 {
 let _a = document.createElement("span");
 _a.id = "l";
 _a.style.color = "#d21212";
 _a.style.fontSize = "x-large"
 _a.innerText = "Plik ''" + r + "'' nie istnieje, lub nie jest dostępny."
 document.getElementsByTagName("section")[0].appendChild(_a);
 n();
 }
 document.getElementById("d").href = "/public/" + r;
 document.getElementById("d").download = r;
 document.getElementById("b").addEventListener("click", u);
 document.addEventListener('contextmenu', (e) => {
 if (document.elementsFromPoint(e.pageX, e.pageY)[1].nodeName == "SECTION")
 u();
 e.preventDefault();
 }, false);
 }
 window.onresize = l;
 l();
 }
 </script>
 <style>
 :root {
 --a: rgb(100,149,237);
 --b: rgb(45, 82, 151);
 --c: rgb(27, 51, 95);
 }
 #m {
 width:100%;
 height:100%;
 }
 body, html, section {
 height: 100%;
 margin:0px;
 overflow: hidden;
 }
 #i, #k, #j, #l {
 max-width: 100%;
 max-height: 70%;
 margin: 0;
 position: absolute;
 top: 50%;
 left: 50%;
 margin-right: -50%;
 transform: translate(-50%, -50%);
 }
 #l {
 padding: 3%;
 margin: 3%;
 margin-top: 8%;
 }
 #e {
 background-color: var(--a);
 padding: 10px;
 display: flex;
 flex-wrap: nowrap;
 flex-direction: row;
 justify-content: space-between;
 }

 .c {
 padding-right: 30px;
 }
 #a, #b {
 font-size: larger;
 font-family: 'Lato', sans-serif;
 background-color: var(--b);
 width:max-content;
 color:white;
 font-weight:bolder;
 margin:0px;
 padding: 10%;
 border-radius: 20px;
 cursor: pointer;
 }
 #a:hover, #b:hover {
 background-color: var(--c);
 }
 a {
 text-decoration:none;
 }
 #f {
 position:fixed;
 top:1%;
 left:70%;
 background-color: var(--c);
 opacity: 0;
 color: white;
 padding: 2%;
 border-radius: 10px;
 font-size: larger;
 font-family: 'Lato', sans-serif;
 font-weight: bolder;
 }
 .p {
 max-height: 64px;
 max-width: auto;
 }
 .n{
 max-width:80%;
 height:auto;
 }
 .o{
 font-size: large;
 font-family: 'Lato', sans-serif;
 font-weight:bolder;
 text-align:center;
 width:100%;
 color:black;
 word-wrap: break-word;
 }
 .g {
 margin:6%;
 display:flex;
 flex-direction:column;
 align-items:center;
 padding-top:7%;
 }
 .g:hover {
 box-shadow: 0 0 5px 3px var(--a);
 }
 #r {
 font-size: xx-large;
 font-family: 'Lato', sans-serif;
 width:max-content;
 color:white;
 font-weight:bolder;
 margin:0px;
 padding: 1%;
 }
 </style>
</head>
<body onload="q()">
 <header>
 <div id="f">
 Link skopiowany :)
 </div>
 <div id="e">
 <div class="c">
 <a id="d" title="Pobierz plik na urządzenie" download="">
 <div id="a">
 </div>
 </a>
 </div>
 <div class="c">
 <div id="b" title="Skopiuj link do schowka">
 </div>
 </div>
 </div>
 </header>
 <section>
 </section>
 <?php
 echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
 ?>
</body>
</html>