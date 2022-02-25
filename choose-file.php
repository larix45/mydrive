<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function load()
        {
            console.log(JSON.parse(document.getElementById("files").value)[0]);
        }
    </script>
</head>
<body load="load()">
    <?php
    echo "<input type='hidden' id='files' value='".json_encode(array_values(scandir("./public")))."'>";
    ?>
</body>
</html>

