<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybór pliku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
    <script>
        //const server_adress = "http://152.70.55.33/";
        const server_adress = "http://localhost/";
        function arrayRemove(arr, value) { 
            return arr.filter(function(ele){ 
                return ele != value; 
            });
        }
        function rescaleAccordingToWindowSize() {
            //console.log(parseInt(window.innerWidth/100));
            let columns = "";
            for(let i =1; i < parseInt(window.innerWidth/100)+1; i++)
            {
                columns += (100/parseInt(window.innerWidth/100))+"% ";
            }
            console.log(columns);
            document.getElementsByTagName("section")[0].style.gridTemplateColumns = columns;
        }

        window.onresize = rescaleAccordingToWindowSize;
        function load()
        {
            rescaleAccordingToWindowSize();
            console.log(JSON.parse(document.getElementById("files").value));
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
                var table_filetypes_code = ["cpp"]; //TODO
                


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
                else if(table_filetypes_code.includes(element.split(".").pop().toLowerCase()))
                {
                    img_fileicon.src = "./mydrive-icons/icons/base.png";
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
    </script>
    <style>
    :root {
        --main-color: cornflowerblue;
    }
    body, html, section {
        margin:0px; 
        height: 100%;
    }
    section {
        display: grid;
	    grid-auto-rows: 25%;
        margin:1%;
    }
    #header {
        background-color: var(--main-color);
        padding: 10px;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        justify-content: center;
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
    a   {
        text-decoration:none;
    }
    </style>
</head>
<body onload="load()">
    <header>
        <div id="header">
            <h1 id="text">Wybierz plik:</h1>
        </div>
    </header>
    <section>
    </section>
    
    <?php
    echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
    ?>
</body>
</html>

