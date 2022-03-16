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
    var copyAndDownloadDisabled = false;
    function rescaleAccordingToWindowSize() {
        if(filename == null)
        {
            if(window.innerHeight < window.innerWidth)
            {
                document.getElementById("upload-btn").innerHTML = " ZALOGUJ";
            }
            else 
            {
                document.getElementById("upload-btn").innerHTML = "<imgsrc='./mydrive-icons/icons/download.png'  class='icon v_fliped'>";
            }
            let columns = "";
            for(let i =1; i < parseInt(window.innerWidth/100)+1; i++)
            {
                columns += (100/parseInt(window.innerWidth/100))+"% ";
            }
            document.getElementsByTagName("section")[0].style.gridTemplateColumns = columns;
        }
        else
        {
            if(window.innerHeight < window.innerWidth)
            {
                document.getElementById("download-btn").innerHTML = " POBIERZ PLIK";
                document.getElementById("copy-btn").innerHTML = "KOPIUJ LINK";
            }
            else 
            {
                document.getElementById("download-btn").innerHTML = "<img src='./mydrive-icons/icons/download.png'  class='icon'>";
                document.getElementById("copy-btn").innerHTML = "<img src='./mydrive-icons/icons/copy.png'  class='icon'>";
            }
        }
    }
    function arrayRemove(arr, value) { 
            return arr.filter(function(ele){ 
                return ele != value; 
            });
    }
    function unfade(element) {
        let op = 0.2;  
        element.style.display = 'block';
        var timer = setInterval(function () {
            if (op >= 1){
                clearInterval(timer);
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op += op * 0.1;
        }, 10);
    }
    function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
    }

    function showCopiedNotify() {
            if (!copyAndDownloadDisabled)
            {
                navigator.clipboard.writeText(window.location);
                document.getElementById("notify").style.zIndex = 2;
                unfade(document.getElementById("notify"));
                document.getElementById("notify").animate([
                // keyframes
                { opacity: "0.0" },
                { opacity: "1.0" }
                ], {
                // timing options
                duration: 500,
                iterations: 1
                });

                setTimeout(() => {
                    document.getElementById("notify").animate([
                    // keyframes
                    { opacity: "1.0" },
                    { opacity: "0.0" }
                    ], {
                    // timing options
                    duration: 1000,
                    iterations: 1
                    });

                    document.getElementById("notify").animate([
                    // keyframes
                    { transform: 'translateY(0px)' },
                    { transform: 'translateY(-100px)' }
                    ], {
                    // timing options
                    duration: 1000,
                    iterations: 1
                    });
                    setTimeout(() => {
                        document.getElementById("notify").style.transform = "translateY(0px)";
                        document.getElementById("notify").style.opacity = "0.0";
                        document.getElementById("notify").style.zIndex = -1;
                    }, 990);
                }, 1000);
            }
        }
    function disableDownloadAndCopyButtons() {
            copyAndDownloadDisabled = true;
            /*
            <div id="downlaod-btn">
                POBIERZ PLIK
            </div>

            remove download link and restore the button itself
            */
            let _parent_div_buffor = document.getElementById("download-link").parentElement
            _parent_div_buffor.childNodes[1].remove()
            let _buffor_dir = document.createElement("div");
            _buffor_dir.id = "download-btn";
            _buffor_dir.innerText = "POBIERZ PLIK"
            _parent_div_buffor.appendChild(_buffor_dir)


            document.getElementById("download-btn").style.backgroundColor = "#464a52";
            document.getElementById("copy-btn").style.backgroundColor = "#464a52";

            document.getElementById("download-btn").style.color = "#d6d6d6";
            document.getElementById("copy-btn").style.color = "#d6d6d6";

            document.getElementById("download-btn").style.textDecoration = "line-through";
            document.getElementById("copy-btn").style.textDecoration = "line-through";

            document.getElementById("download-btn").style.cursor = "not-allowed";
            document.getElementById("copy-btn").style.cursor = "not-allowed";
        }
        function upload()
        { 
            /*
            document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + "<input id='fileupload' type='file'>";            
            document.getElementsByTagName("body")[0].innerHTML += "<div id='login'>        <h4>Hasło:</h4>        <input type='password' id='password'>        <input type='button' id='login-btn' value='Zaloguj i prześlij pliki'>    </div>";
            document.getElementsByTagName("body")[0].innerHTML += "<div id='backdrop'> </div>";
            */
            document.getElementById("backdrop").style.display = "block";
            document.getElementById("login").style.display = "flex";
            document.getElementsByTagName("header")[0].style.filter = "blur(5px)";
            document.getElementsByTagName("section")[0].style.filter = "blur(5px)";
            document.getElementById("backdrop").onclick = () =>
            {
                document.getElementsByTagName("header")[0].style.filter = "blur(0px)";
                document.getElementsByTagName("section")[0].style.filter = "blur(0px)";
                document.getElementById("backdrop").style.display = "none";
                document.getElementById("login").style.display = "none";
            };
            document.getElementById("login-btn").onclick = () =>
            {
                document.getElementById('fileupload').onchange =  async () => 
                {
                    let formData = new FormData();          
                    console.log(document.getElementById('fileupload'  ).files[0]); 
                    formData.append("uploadedFile", document.getElementById('fileupload').files[0]);
                    
                    formData.append("passpherese", document.getElementById("password").value);
                    
                    await fetch('./upload.php', {
                        method: "POST", 
                        body: formData
                    })
                    .then((response) => {
                        response.text().then((response) => {
                            console.log(response);
                        });
                        if (response.status == 200)
                        {
                            document.getElementById("notify").innerText = "Plik przesłany";
                        }
                        else if (response.status == 300)
                        {
                            document.getElementById("notify").innerText = "Niepoprawne hasło!";
                        }
                        else if (response.status == 100)
                        {
                            document.getElementById("notify").innerText = "Tego pliku nie wolno przesyłac!";
                        }
                        else 
                        {
                            document.getElementById("notify").innerText = "Wystąpił problem!";
                        }
                     });
                    document.getElementsByTagName("header")[0].style.filter = "blur(0px)";
                    document.getElementsByTagName("section")[0].style.filter = "blur(0px)";
                    showCopiedNotify();
                    document.getElementById("backdrop").style.display = "none";
                    document.getElementById("login").style.display = "none";
                }
                document.getElementById('fileupload').click();
            }
        }
    
    </script>
    <script>
    //const server_adress = "http://152.70.55.33/";
    const server_adress = "http://localhost/";
    const filename = findGetParameter("filename");
    const full_file_path = encodeURI(server_adress + "/public/" + filename);
    let filetype = "";// office or image or video or audio or raw_text


    var table_files_to_ignore= ["index.html"]; 

    /*PDF), PowerPoint (POTM, POTX, PPSM, PPSX, PPT, PPTM, PPTX), Rich Text (RTF), Word (DOC, DOCM, DOCX, DOTM, DOTX*/
    var table_filetypes_office = ["docx","doc", "docm", "xlsx", "xls", "xlsm", "pptx","ppt", "pptm", "pps", "ppsx", "rtf"];
    var table_filetypes_image = ["png", "apng",  "jpg", "jpeg", "gif", "svg", "webp", "bmp", "ico"];
    var table_filetypes_video = ["ogg", "webm", "mp4"];
    var table_filetypes_audio = ["mp3", "wav"];
    var table_filetypes_not_viewable = ["exe", "dll", "msi", "run", "inf", "bin", "iso", "img"];
    window.onresize = rescaleAccordingToWindowSize;
    document.getElementById("title").innerText = filename;


    if(filename == null)
    {
    }
    else if (table_files_to_ignore.includes(filename))
    {
        filetype = "nonexistant";
    }
    else if (table_filetypes_office.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "office";
    }
    else if (table_filetypes_image.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "image";
    }
    else if (table_filetypes_video.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "video";
    }
    else if (table_filetypes_audio.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "audio";
    }
    else if (table_filetypes_not_viewable.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "not_viewable";
    }
    else if (filename.split(".").pop().toLowerCase() == "pdf")
    {
        filetype = "pdf";
    }
    else // RAW FILE 
    {
        filetype = "raw"
    }
    function load(){ // folder view
        if(filename == null)
        {
            document.getElementById("header").innerHTML = "<h1></h1> <h1 id='text'>Wybierz plik:</h1> <div class='div-inline'><div id='upload-btn' title='Skopiuj link do schowka'>PRZEŚLIJ PLIK</div></div> ";
            document.getElementById("header").style.justifyContent = "space-around";
            document.getElementsByTagName("section")[0].style.overflow = "auto";
            document.getElementsByTagName("section")[0].style.display = "grid"
            document.getElementsByTagName("section")[0].style.gridAutoRows = "25%";
            document.getElementsByTagName("section")[0].style.padding = "1%";
            document.getElementsByTagName("section")[0].style.marginTop = "100px";
            document.getElementsByTagName("section")[0].style.height = document.getElementsByTagName('html')[0].offsetHeight - document.getElementsByTagName('header')[0].offsetHeight - (document.getElementsByTagName('section')[0].offsetHeight * 0.03) + "px";
            document.getElementById("upload-btn").addEventListener("click", upload);
            
            //console.log(JSON.parse(document.getElementById("files").value));
            arrayRemove( arrayRemove(JSON.parse(document.getElementById("files").value),"."), "..").forEach(element => {
                let a_link = document.createElement("a");
                a_link.href = server_adress+"?filename="+element;
                let div_element = document.createElement("div");
                div_element.classList.add("element");

                var table_filetypes_office_docs = ["docx","doc", "docm"];
                var table_filetypes_office_sheets = ["xlsx", "xls", "xlsm"];
                var table_filetypes_office_slides = ["pptx","ppt", "pptm", "pps", "ppsx"];
                var table_filetypes_image = ["png", "apng",  "jpg", "jpeg", "gif", "webp", "bmp"];
                var table_filetypes_video = ["ogg", "webm", "mp4"];
                var table_filetypes_audio = ["mp3", "wav"];
                var table_filetypes_text = ["txt","md", "rtf", "csv"];
                var table_filetypes_icons = ["ico", "svg"];
                var table_filetypes_execuatbles = ["exe", "dll", "msi", "run", "inf"];
                


                let img_fileicon = document.createElement("img");
                img_fileicon.classList.add("fileicon");
                img_fileicon.src = "./mydrive-icons/icons/base.png";
                if(table_filetypes_office_docs.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/word.png";
                }
                else if(table_filetypes_office_sheets.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/excel.png";
                }
                else if(table_filetypes_office_slides.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/powerpoint.png";
                }
                else if(table_filetypes_image.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/image.png";
                }
                else if(table_filetypes_video.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/video.png";
                }
                else if(table_filetypes_audio.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/music.png";
                }
                else if(table_filetypes_text.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/text.png";
                }
                else if(table_filetypes_icons.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/svg.png";
                }
                else if(table_filetypes_execuatbles.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/exec.png";
                }
                else if("pdf" == element.split(".").pop().toLowerCase())
                {
                    img_fileicon.src = "./mydrive-icons/icons/pdf.png";
                } 
                if(!element)
                {
                    console.log(element);

                    img_fileicon.src = "./mydrive-icons/icons/directory.png";
                }

                let span_filename = document.createElement("span");
                span_filename.classList.add("filename");
                span_filename.innerText = element;

                div_element.appendChild(img_fileicon);

                div_element.appendChild(span_filename);

                a_link.appendChild(div_element);
                console.log(element);
                document.getElementsByTagName("section")[0].appendChild(a_link);
            });
        }
        else {
        if (filetype == "office")
        { 
            // Tworzy ramkę, z odniesieniem do ms office online i wyswietla je jako iframe
            let iframe_podglad = document.createElement("iframe");
            iframe_podglad.frameBorder = "no";
            iframe_podglad.id = "podglad_office";
            iframe_podglad.src = "https://view.officeapps.live.com/op/embed.aspx?src=" + full_file_path;
            let paragraph_error_message = document.createElement("p")
            paragraph_error_message.innerText = "Ta przeglądarka nie obsługuje podglądu, możesz dalej pobać plik.";
            iframe_podglad.appendChild(paragraph_error_message);
            document.getElementsByTagName("section")[0].appendChild(iframe_podglad);
        }
        else if (filetype == "image")
        {
            // Tworzy obrazek i wyswietla go
            let image_podglad = document.createElement("img");
            image_podglad.src = full_file_path;
            image_podglad.alt = filename;
            image_podglad.id = "podglad_img";
            document.getElementsByTagName("section")[0].appendChild(image_podglad);
        } 
        else if (filetype == "video")
        {
            // Tworzy ramke wideo i wyswietla ją
            /*
            <video width="320" height="240" controls>
            <source src="movie.mp4" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
            </video>
            */
            let video_podglad = document.createElement("video");
            let video_source = document.createElement("source");
            video_source.src = full_file_path;
            video_podglad.controls = true;
            video_podglad.id = "podglad_video";
            video_podglad.innerText = "Twoja przegladarka nie obsługuje odtwarzania tego filmu, możesz go dalej pobrać";
            video_podglad.appendChild(video_source);
            document.getElementsByTagName("section")[0].appendChild(video_podglad);
        }
        else if (filetype == "audio")
        {
            // Tworzy kontrolkę audio i wyswietla ją
            /*
            <audio controls>
            <source src="horse.ogg" type="audio/ogg">
            <source src="horse.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
            */
            let audio_podglad = document.createElement("audio");
            let audio_source = document.createElement("source");
            audio_source.src = full_file_path;
            audio_podglad.controls = true;
            audio_podglad.id = "podglad_audio";
            audio_podglad.innerText = "Twoja przegladarka nie obsługuje odtwarzania pliku audio, możesz go dalej pobrać";
            audio_podglad.appendChild(audio_source);
            document.getElementsByTagName("section")[0].appendChild(audio_podglad);
        }
        else if (filetype == "not_viewable")
        {
            // error message nie ma pliku
            let info_text = document.createElement("span");
            info_text.id = "podglad_raw";
            info_text.style.color = "#151515";
            info_text.style.fontSize = "x-large"
            info_text.innerText = "Nie można wyświetlić podglądu dla pliku: " + filename + ", możesz go dalej pobrać"
            document.getElementsByTagName("section")[0].appendChild(info_text);
        }
        else if (filetype == "raw")
        { // Tworzymiejsce na surowe dane i wyswietla je
            let raw_podglad = document.createElement("xmp");
            fetch(full_file_path)
            .then(response => {
                if(response.ok)
                {
                    response.text().then((raw_data)=>{
                        raw_podglad.innerText = raw_data
                    })
                }
                else 
                {    
                    disableDownloadAndCopyButtons();
                }
            })
            .catch(error => {
                console.log("error", error);
            });
            document.getElementsByTagName("html")[0].style.overflow = "auto";
            document.getElementsByTagName("section")[0].style.overflow = "auto";
            raw_podglad.id = "podglad_raw";
            document.getElementsByTagName("section")[0].appendChild(raw_podglad);
        }
        else if (filetype == "pdf")
        {
            document.getElementsByTagName("section")[0].innerHTML = "<object id='podglad_office' data='"+full_file_path+"' type='application/pdf'>  <embed src='"+full_file_path+"'' type='application/pdf'/> </object>";
            document.getElementById('podglad_office').style.height = document.getElementsByTagName('html')[0].offsetHeight - document.getElementsByTagName('header')[0].offsetHeight + "px";
        }
        else 
        {
            // error message nie ma pliku
            let error_text = document.createElement("span");
            error_text.id = "podglad_raw";
            error_text.style.color = "#d21212";
            error_text.style.fontSize = "x-large"
            error_text.innerText = "Plik ''" + filename + "'' nie istnieje, lub nie jest dostępny."
            document.getElementsByTagName("section")[0].appendChild(error_text);
            disableDownloadAndCopyButtons();
        }
        document.getElementById("download-link").href = "/public/" + filename;
        document.getElementById("download-link").download =  filename;
        document.getElementById("copy-btn").addEventListener("click", showCopiedNotify);
        if (document.addEventListener) 
        {
            document.addEventListener('contextmenu', (e) => {
                if (document.elementsFromPoint(e.pageX, e.pageY)[1].nodeName == "SECTION")
                {
                    showCopiedNotify();
                }
                e.preventDefault();
            }, false);
        } else 
        {
        document.attachEvent('oncontextmenu', () => {
            showCopiedNotify();
            window.event.returnValue = false;
        });
        }
    }
    rescaleAccordingToWindowSize();
}


    console.log("Plik = ", filename);
    console.log("Typ wyświetlania = ", filetype);
    console.log("Rozszerzenie = ", filename.split(".").pop().toLowerCase());
   </script>
   <style>

    :root {
        --main-color: cornflowerblue;
        --button-color: rgb(45, 82, 151);
        --accent-color: rgb(27, 51, 95);
    }
    #podglad_office {
        width:100%;
        height:100%;
    }
    body, html, section {
        height: 100%;
        margin:0px;
        overflow: hidden;
    }
    #podglad_img, #podglad_audio, #podglad_video, #podglad_raw {
        max-width: 100%;
        max-height: 70%;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
    }
    #podglad_raw {
        padding: 3%;
        margin: 3%;
        margin-top: 8%;
    }
    #header {
        background-color: var(--main-color);
        padding: 10px;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        width: 100%;
    }

    .div-inline {
        padding-right: 30px;
    }
    #download-btn, #copy-btn, #upload-btn {
        font-size: larger;
        font-family: 'Lato', sans-serif;
        background-color: var(--button-color);
        width:max-content;
        color:white;
        font-weight:bolder;
        margin:0px;
        padding: 10%;
        border-radius: 20px;
        cursor: pointer;
        margin-right: 15px;
    }
    #download-btn:hover, #copy-btn:hover, #upload-btn:hover {
        background-color: var(--accent-color);
    }
    a {
        text-decoration:none;
    }
    #notify {
        position:fixed;
        top:1%;
        left:70%;
        background-color: var(--accent-color);
        opacity: 0;
        color: white;
        padding: 2%;
        border-radius: 10px;
        font-size: larger;
        font-family: 'Lato', sans-serif;
        font-weight: bolder;
        z-index:-1;
    }
    .icon {
        max-height:  64px;
        max-width: auto;
    }
    .v_fliped{
        transform: rotateY(180);
    }
    .fileicon{
        max-width:80%;
        height:auto;
    }
    .filename{
        font-size: large;
        font-family: 'Lato', sans-serif;
        font-weight:bolder;
        text-align:center;
        width:100%;
        color:black;
        word-wrap: break-word;
    }
    .element {
        margin:6%;
        display:flex;
        flex-direction:column;
        align-items:center;
        padding-top:7%;
    }
    .element:hover {
        box-shadow: 0 0 5px 3px var(--main-color);
    }
    #text {
        font-size: xx-large;
        font-family: 'Lato', sans-serif;
        width:max-content;
        color:white;
        font-weight:bolder;
        margin:0px;
        padding: 1%;
    }
    #login {
        position: fixed;
        top: 50%;
        left: 50%;
        display: none;
        align-items: center;
        flex-direction: column;
        background-color: var(--main-color);
        border-radius: 20px;
        border-width: 3px;
        border-style: solid;
        border-color: var(--accent-color);
        width: fit-content;
        padding: 5%;
        transform: translate(-50%,  -50%);
        z-index: 10;
    }
    #login-btn,#password {
        
        font-size: larger;
        font-family: 'Lato', sans-serif;
        background-color: var(--button-color);
        color:white;
        font-weight:bolder;
        margin:5%;
        padding: 5%;
        border-radius: 20px;
        border-width: 3px;
        border-style: solid;
        border-color: var(--accent-color);
        cursor: pointer;
        width:100%;
        
    }
    #login-btn:hover {
        background-color: var(--accent-color);
    }
    h4{
        font-size: larger;
        font-family: 'Lato', sans-serif;
        color:white;
        font-weight:bolder;
        margin:5%;
        margin-bottom: 0%;
        cursor: default;
        width:100%;
    }
    #backdrop {
        z-index: 3;
        position: fixed;
        width: 100%;
        height: 100%;
        top:0px;
        display: none;
    }
    #password {
        background-color: var(--main-color);
        cursor: text;
        color:var(--accent-color);
    }
    #password:focus {
        outline: 0px;
    }
   </style>
</head>
<body onload="load()">
    <header>
        <div id="notify">
            Link skopiowany :)
        </div>
        <div id="header">
            <div class="div-inline">
                <a id="download-link" href="placeholder" title="Pobierz plik na urządzenie" download="">
                    <div id="download-btn">
                    </div>
                </a>
            </div>
            <div class="div-inline">
                <div id="copy-btn" title="Skopiuj link do schowka">
                </div>
            </div>
        </div>
    </header>
    <section>
    </section>
    <?php
    echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
    echo "<input type='hidden' id='dirs' value='".json_encode(array_values(glob("public" . "/*" , GLOB_ONLYDIR)))."'>";
    //print_r(glob('public' . '/*' , GLOB_ONLYDIR));
    ?>
    <input id='fileupload' type='file'>
    
    <div id='login'>        
        <h4>Hasło:</h4>
        <input type='password' id='password'>  
        <input type='button' id='login-btn' value='Zaloguj i prześlij pliki'>
    </div>
    <div id='backdrop'>
     </div>
</body>
</html>

