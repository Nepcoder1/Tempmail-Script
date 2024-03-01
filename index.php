<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Mass TempMail Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('http://telegra.ph/file/e7032a387a608932e09c5.jpg'); /* Add your background image URL here */
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .banner {
            background-color: #007bff; 
            color: white;
            padding: 5px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            max-width: 100%;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input, button {
            padding: 5px;
            display: block;
            margin: 0 auto;
        }

        .btn-copy {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 3px 6px;
            cursor: pointer;
            display: inline-block;
            margin-left: 5px;
        }

        footer {
            text-align: center;
            background-color: black;
            color: white;
            padding: 10px;
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 10px;
            }

            table {
                font-size: 12px;
            }

            .btn-copy {
                padding: 2px 4px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="banner">
    	     <Center>
        <h1>Mass TempMail Generator</h1>
    </div>

    <table border="1">
        <tr>
            <th>Login:</th>
            <td><input type="text" id="inputMail" class="custom-search-input" placeholder="Enter your mail"></td>
            <td colspan="3"><button id="checkButton" class="custom-search-botton btn-copy">Check</button></td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>

        <?php
        $count = $_GET['id'];
        $default = 0;

        if (!empty($count)) {
            $default = 0 + $count;
        }

        if (!empty($count)) {

            $url = "https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=$count";
            $json = file_get_contents($url);
            $data = json_decode($json, true);

        } else if ($count == NULL) {
            $count = 1;
            $url = "https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=$count";
            $json = file_get_contents($url);
            $data = json_decode($json, true);

        }

        for ($i = 0; $i < $count; $i++) {
            echo '<tr>';
            echo '<th>Email:</th>';
            echo '<td id="email-' . $i . '">' . $data[$i] . '</td>';
            echo '<td><button class="btn-copy" data-clipboard-target="#email-' . $i . '">Copy</button></td>';
            echo '<td><a href="./view.php?id=' . $data[$i] . '" target="_blank"><button class="btn-copy">Check Mail</button></a></td>';
            echo '</tr>';
        }
        ?>

        <tr>
            <th>Mass:</th>
            <td><input type="text" id="inMail" class="custom-search-input" placeholder="Example: 10"></td>
            <td colspan="3"><button id="genMail" class="custom-search-botton btn-copy">Generate</button></td>
        </tr>
    </table>
</div>

<footer>
    <div style="text-align: center;">
        <a href="https://t.me/DEVSNP" target="_blank">
            <button style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                Made by Nepcoder💌
            </button>
        </a>
    </div>
</footer>


<audio id="myAudio">
    <source src="./sound/copy.mp3" type="audio/mpeg">
</audio>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script>
    var audio = document.getElementById("myAudio");

    document.getElementById('checkButton').onclick = function() {
        window.location = "./view.php?id=" + document.getElementById('inputMail').value;
        return false;
    }

    document.getElementById('genMail').onclick = function() {
        window.location = "./?id=" + document.getElementById('inMail').value;
        return false;
    }

    var clipboard = new ClipboardJS(".btn-copy");
    clipboard.on("success", function(e) {
        audio.play();
        e.clearSelection();
    });
</script>

</body>
</html>
