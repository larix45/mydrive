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
    //const server_adress = "http://152.70.55.33/";
    const server_adress = "http://localhost/";

    var copyAndDownloadDisabled = false;
    function rescaleAccordingToWindowSize() {
        if(filename == null)
        {
            if(window.innerHeight < window.innerWidth)
            {
                upload_btn.innerHTML = " ZALOGUJ";
            }
            else 
            {
                upload_btn.innerHTML = "<img src='./res/download.png'  class='icon v_fliped'>";
            }
            let columns = "";
            for(let i =1; i < parseInt(window.innerWidth/100)+1; i++)
            {
                columns += (100/parseInt(window.innerWidth/100))+"% ";
            }
            section.style.gridTemplateColumns = columns;
        }
        else
        {
            if(window.innerHeight < window.innerWidth)
            {
                download_btn.innerHTML = "POBIERZ PLIK";
                copy_btn.innerHTML = "KOPIUJ LINK";
            }
            else 
            {
                download_btn.innerHTML = "<img src='./res/download.png'  class='icon'>";
                copy_btn.innerHTML = "<img src='./res/copy.png'  class='icon'>";
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
        let timer = setInterval(function () {
            if (op >= 1){
                clearInterval(timer);
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op += op * 0.1;
        }, 10);
    }
    function findGetParameter(parameterName) {
            let result = null,
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
                notify.style.zIndex = 2;
                unfade(notify);
                notify.animate([
                { opacity: "0.0" },
                { opacity: "1.0" }
                ], {
                duration: 500,
                iterations: 1
                });

                setTimeout(() => {
                    notify.animate([
                    { opacity: "1.0" },
                    { opacity: "0.0" }
                    ], {
                    duration: 1000,
                    iterations: 1
                    });

                    notify.animate([
                    { transform: 'translateY(0px)' },
                    { transform: 'translateY(-100px)' }
                    ], {
                    duration: 1000,
                    iterations: 1
                    });
                    setTimeout(() => {
                        notify.style.transform = "translateY(0px)";
                        notify.style.opacity = "0.0";
                        notify.style.zIndex = -1;
                    }, 990);
                }, 1000);
            }
        }
    function disableDownloadAndCopyButtons() {
            copyAndDownloadDisabled = true;
            let _parent_div_buffor = download_link.parentElement
            _parent_div_buffor.childNodes[1].remove()
            let _buffor_dir = document.createElement("div");
            _buffor_dir.id = "download_btn";
            _buffor_dir.innerText = "POBIERZ PLIK";
            _parent_div_buffor.appendChild(_buffor_dir);


            download_btn.style.backgroundColor = "#464a52";
            copy_btn.style.backgroundColor = "#464a52";

            download_btn.style.color = "#d6d6d6";
            copy_btn.style.color = "#d6d6d6";

            download_btn.style.textDecoration = "line-through";
            copy_btn.style.textDecoration = "line-through";

            download_btn.style.cursor = "not-allowed";
            copy_btn.style.cursor = "not-allowed";
        }
        function upload()
        { 
            backdrop.style.display = "block";
            login.style.display = "flex";
            outer_header.style.filter = "blur(5px)";
            section.style.filter = "blur(5px)";
            backdrop.onclick = () =>
            {
                outer_header.style.filter = "blur(0px)";
                section.style.filter = "blur(0px)";
                backdrop.style.display = "none";
                login.style.display = "none";
            };
            login_btn.onclick = () =>
            {
                fileupload.onchange =  async () => 
                {
                    let formData = new FormData();
                    formData.append("uploadedFile", fileupload.files[0]);
                    
                    formData.append("passpherese", password.value);

                    await fetch('./upload.php', {
                        method: "POST", 
                        body: formData
                    })
                    .then((response) => {
                        if (response.status == 200)
                        {
                            notify.innerText = "Plik przesłany";
                        }
                        else if (response.status == 300)
                        {
                            notify.innerText = "Niepoprawne hasło!";
                        }
                        else if (response.status == 100)
                        {
                            notify.innerText = "Tego pliku nie wolno przesyłac!";
                        }
                        else 
                        {
                            notify.innerText = "Wystąpił problem!";
                        }
                     });
                    outer_header.style.filter = "blur(0px)";
                    section.style.filter = "blur(0px)";
                    showCopiedNotify();
                    backdrop.style.display = "none";
                    login.style.display = "none";
                }
                fileupload.click();
            }
        }
    
    </script>
    <script>
    const filename = findGetParameter("filename");
    const full_file_path = encodeURI(server_adress + "/public/" + filename);
    let filetype = "";


    var table_files_to_ignore= ["index.html"]; 
    var table_filetypes_office_docs = ["docx","doc", "docm", "rtf"];
    var table_filetypes_office_sheets = ["xlsx", "xls", "xlsm"];
    var table_filetypes_office_slides = ["pptx","ppt", "pptm", "pps", "ppsx"];
    var table_filetypes_image = ["png", "apng",  "jpg", "jpeg", "gif", "webp", "bmp"];
    var table_filetypes_video = ["ogg", "webm", "mp4"];
    var table_filetypes_audio = ["mp3", "wav"];
    var table_filetypes_text = ["txt","md", "rtf", "csv"];
    var table_filetypes_icons = ["ico", "svg"];
    var table_filetypes_execuatbles = ["exe", "dll", "msi", "run", "inf"];
    window.onresize = rescaleAccordingToWindowSize;
    title.innerText = filename;


    if(filename == null)
    {
        title.innerText = "Wybierz plik";
    }
    else if (table_files_to_ignore.includes(filename))
    {
        filetype = "nonexistant";
    }
    else if (table_filetypes_office_docs.concat(table_filetypes_office_sheets.concat(table_filetypes_office_slides)).includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "office";
    }
    else if (table_filetypes_image.concat(table_filetypes_icons).includes(filename.split(".").pop().toLowerCase()))
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
    else if (table_filetypes_execuatbles.includes(filename.split(".").pop().toLowerCase()))
    {
        filetype = "not_viewable";
    }
    else if (filename.split(".").pop().toLowerCase() == "pdf")
    {
        filetype = "pdf";
    }
    else  
    {
        filetype = "raw"
    }
    function load(){ 
        if(filename == null)
        {
            header.innerHTML = "<h1></h1> <h1 id='text'>Wybierz plik:</h1> <div class='div_inline'><div id='upload_btn' title='Skopiuj link do schowka'>PRZEŚLIJ PLIK</div></div> ";
            header.style.justifyContent = "space-around";
            section.style.overflow = "auto";
            section.style.display = "grid"
            section.style.gridAutoRows = "25%";
            section.style.padding = "1%";
            section.style.marginTop = "100px";
            section.style.height = document.getElementsByTagName('html')[0].offsetHeight - outer_header.offsetHeight - (document.getElementsByTagName('section')[0].offsetHeight * 0.03) + "px";
            upload_btn.addEventListener("click", upload);
            arrayRemove( arrayRemove(JSON.parse(files.value),"."), "..").forEach(element => {
                let a_link = document.createElement("a");
                a_link.href = server_adress+"?filename="+element;
                let div_element = document.createElement("div");
                div_element.classList.add("element");   
                


                let img_fileicon = document.createElement("img");
                img_fileicon.classList.add("fileicon");
                img_fileicon.src = "./res/base.png";
                if(table_filetypes_office_docs.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/word.png";
                }
                else if(table_filetypes_office_sheets.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/excel.png";
                }
                else if(table_filetypes_office_slides.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/powerpoint.png";
                }
                else if(table_filetypes_image.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/image.png";
                }
                else if(table_filetypes_video.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/video.png";
                }
                else if(table_filetypes_audio.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/music.png";
                }
                else if(table_filetypes_text.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/text.png";
                }
                else if(table_filetypes_icons.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/svg.png";
                }
                else if(table_filetypes_execuatbles.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./res/exec.png";
                }
                else if("pdf" == element.split(".").pop().toLowerCase())
                {
                    img_fileicon.src = "./res/pdf.png";
                } 
                if(!element)
                {

                    img_fileicon.src = "./res/directory.png";
                }

                let span_filename = document.createElement("span");
                span_filename.classList.add("filename");
                span_filename.innerText = element;

                div_element.appendChild(img_fileicon);

                div_element.appendChild(span_filename);

                a_link.appendChild(div_element);
                section.appendChild(a_link);
            });
        }
        else {
        if (filetype == "office")
        { 
            let iframe_podglad = document.createElement("iframe");
            iframe_podglad.frameBorder = "no";
            iframe_podglad.id = "podglad_office";
            iframe_podglad.src = "https://view.officeapps.live.com/op/embed.aspx?src=" + full_file_path;
            let paragraph_error_message = document.createElement("p")
            paragraph_error_message.innerText = "Ta przeglądarka nie obsługuje podglądu, możesz dalej pobać plik.";
            iframe_podglad.appendChild(paragraph_error_message);
            section.appendChild(iframe_podglad);
        }
        else if (filetype == "image")
        {
            let image_podglad = document.createElement("img");
            image_podglad.src = full_file_path;
            image_podglad.alt = filename;
            image_podglad.id = "podglad_img";
            section.appendChild(image_podglad);
        } 
        else if (filetype == "video")
        {
            let video_podglad = document.createElement("video");
            let video_source = document.createElement("source");
            video_source.src = full_file_path;
            video_podglad.controls = true;
            video_podglad.id = "podglad_video";
            video_podglad.innerText = "Twoja przegladarka nie obsługuje odtwarzania tego filmu, możesz go dalej pobrać";
            video_podglad.appendChild(video_source);
            section.appendChild(video_podglad);
        }
        else if (filetype == "audio")
        {
            let audio_podglad = document.createElement("audio");
            let audio_source = document.createElement("source");
            audio_source.src = full_file_path;
            audio_podglad.controls = true;
            audio_podglad.id = "podglad_audio";
            audio_podglad.innerText = "Twoja przegladarka nie obsługuje odtwarzania pliku audio, możesz go dalej pobrać";
            audio_podglad.appendChild(audio_source);
            section.appendChild(audio_podglad);
        }
        else if (filetype == "not_viewable")
        {
            let info_text = document.createElement("span");
            info_text.id = "podglad_raw";
            info_text.style.color = "#151515";
            info_text.style.fontSize = "x-large"
            info_text.innerText = "Nie można wyświetlić podglądu dla pliku: " + filename + ", możesz go dalej pobrać"
            section.appendChild(info_text);
        }
        else if (filetype == "raw")
        {
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
                alert("Błąd: "+ error);
            });
            document.getElementsByTagName("html")[0].style.overflow = "auto";
            section.style.overflow = "auto";
            raw_podglad.id = "podglad_raw";
            section.appendChild(raw_podglad);
        }
        else if (filetype == "pdf")
        {
            section.innerHTML = "<object id='podglad_office' data='"+full_file_path+"' type='application/pdf'>  <embed src='"+full_file_path+"'' type='application/pdf'/> </object>";
            podglad_office.style.height = document.getElementsByTagName('html')[0].offsetHeight - outer_header.offsetHeight + "px";
        }
        else 
        {
            let error_text = document.createElement("span");
            error_text.id = "podglad_raw";
            error_text.style.color = "#d21212";
            error_text.style.fontSize = "x-large"
            error_text.innerText = "Plik ''" + filename + "'' nie istnieje, lub nie jest dostępny."
            section.appendChild(error_text);
            disableDownloadAndCopyButtons();
        }
        download_link.href = "/public/" + filename;
        download_link.download =  filename;
        copy_btn.addEventListener("click", showCopiedNotify);
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

    .div_inline {
        padding-right: 30px;
    }
    #download_btn, #copy_btn, #upload_btn {
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
    #download_btn:hover, #copy_btn:hover, #upload_btn:hover {
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
        transform: scaleY(-1);
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
    #login_btn,#password {
        
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
    #login_btn:hover {
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
    <header id="outer_header">
        <div id="notify">
            Link skopiowany :)
        </div>
        <div id="header">
            <div class="div_inline">
                <a id="download_link" href="placeholder" title="Pobierz plik na urządzenie" download="">
                    <div id="download_btn">
                    </div>
                </a>
            </div>
            <div class="div_inline">
                <div id="copy_btn" title="Skopiuj link do schowka">
                </div>
            </div>
        </div>
    </header>
    <section id="section">
    </section>
    <?php
    echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
    echo "<input type='hidden' id='dirs' value='".json_encode(array_values(glob("public" . "/*" , GLOB_ONLYDIR)))."'>";
    ?>
    <input id="fileupload" type="file" hidden>
    
    <div id="login">        
        <h4>Hasło:</h4>
        <input type="password" id="password">  
        <input type="button" id="login_btn" value="Zaloguj i prześlij pliki">
    </div>
    <div id="backdrop">
     </div>
</body>
</html>

