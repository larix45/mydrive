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
        function load()
        {
            console.log(JSON.parse(document.getElementById("files").value));
        }
    </script>
    <style>
    body, html, section {
        margin:0px; 
        height: 100%;
    }
    section {
        display: grid;
	    grid-template-columns: 12.5% 12.5% 12.5% 12.5% 12.5%  12.5% 12.5% 12.5%;
	    grid-auto-rows: 33%;
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
    .element {
        background-color: #123123;
        margin:6%;
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
    </style>
</head>
<body onload="load()">
    <header>
        <div id="header">
            <h1 id="text">Wybierz plik:</h1>
        </div>
    </header>
    <section>
        <div class="element">
            1
        </div>
        <div class="element">
            2
        </div>
        <div class="element">
            3
        </div>
        <div class="element">
            4
        </div>
        <div class="element">
            5
        </div>
        <div class="element">
            6
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>  
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
        <div class="element">
            7
        </div>
    </section>

    <?php
    echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
    ?>
</body>
</html>

