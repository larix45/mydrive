<!DOCTYPE html>
<html lang="en">
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
        function load()
        {
            /*
            <a href="asd.png">
                <div class="element">
                    <img class="fileicon" src="./mydrive-icons/512px/_blank.png"></img>
                    <span class="filename">Plik.txt</span>
                </div>
            </a>
            */
            console.log(JSON.parse(document.getElementById("files").value));
            arrayRemove( arrayRemove(JSON.parse(document.getElementById("files").value),"."), "..").forEach(element => {
                let a_link = document.createElement("a");
                a_link.href = server_adress+"?filename="+element;
                let div_element = document.createElement("div");
                div_element.classList.add("element");
                


                var table_filetypes = ["docx","doc", "docm", "xlsx", "xls", "xlsm", "pptx","ppt", "pptm", "pps",
                     "ppsx", "pdf","rtf", "png", "apng",  "jpg", "jpeg", "gif", "svg", "webp", "bmp", "ico", "ogg", "webm",
                      "mp4", "mp3", "wav"];
                


                let img_fileicon = document.createElement("img");
                img_fileicon.classList.add("fileicon");
                img_fileicon.src = "./mydrive-icons/512px/_blank.png";
                if(table_filetypes.includes(element.split(".").pop()))
                {
                    img_fileicon.src = "./mydrive-icons/512px/"+element.split(".").pop()+".png";
                }

                let span_filename = document.createElement("span");
                span_filename.classList.add("filename");
                span_filename.innerText = element;

                
                /**
                 * TODO:
                 * fileicons depending on file extension
                 **/
                div_element.appendChild(img_fileicon);

                div_element.appendChild(span_filename);

                a_link.appendChild(div_element);
                console.log(element);
                document.getElementsByTagName("section")[0].appendChild(a_link);
            });
            
        }
    </script>
    <style>
       /*
        @media (max-width: 1199px) { ... }

        @media (max-width: 991px) { ... }

        @media (max-width: 575px) { ... }*/
    body, html, section {
        margin:0px; 
        height: 100%;
    }
    section {
        display: grid;
	    grid-template-columns: 12.5% 12.5% 12.5% 12.5% 12.5% 12.5% 12.5% 12.5%;
	    grid-auto-rows: 25%;
        margin:1%;
    }
    #header {
        background-color: cornflowerblue;
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
        box-shadow: 0 0 5px 3px cornflowerblue;
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

