<?php

// really simple wh*telist
if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "192.168.31.112" || $_SERVER['REMOTE_ADDR'] == "192.168.31.82" || $_SERVER['REMOTE_ADDR'] == "192.168.31.83" || $_SERVER['REMOTE_ADDR'] == "192.168.31.189" || $_SERVER['REMOTE_ADDR'] == "192.168.31.116") {
    $APACHEDIR = "/Users/yeji/Sites/";
    $CLIENTPREAPACHESTRING = "~yeji/";
    $SAMSARA = "source/";
    $MOKSHA = "db/";
    $FILESDIR = $APACHEDIR . $SAMSARA;
    $DBDIR = $APACHEDIR . $MOKSHA;
    $files = glob($FILESDIR . "*.*");
    $numerek = array_rand($files);
    $randomfilepath = $files[$numerek];

if (isset($_POST['filename']) && isset($_POST['dest']) && isset($_POST['origin'])) {
    if (!file_exists($DBDIR . $_POST['dest'])) {
        mkdir($DBDIR . $_POST['dest'], 0777, true);
    }
    if (!file_exists($DBDIR . $_POST['dest'] . "/" . $_POST['filename'])) {
        rename($_POST['origin'], $DBDIR . $_POST['dest'] . "/" . $_POST['filename']);
    } else {
        echo "The file already exists, retrying<hr>";
        $randomfilepath = $_POST['origin'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            max-width: 100%;
            height: auto;
            clear:both;
            display:block;
        }
        #ramka {
            width: 30%;
            margin: 50px 0 50px 50px;
            box-shadow: 0 0 1em gray;
            text-align: center;
            padding: 10px;        
        }
        #cat {
            width: 80%;
            margin: 50px 0 50px 50px;
            box-shadow: 0 0 1em gray;
            text-align: center;
            padding: 10px;        
        }
        .catbutton {
            border: none;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            float: left;
            transition-duration: 0.4s;
        }
        .bluebg {
            background-color: #4CAF50;
        }
        .redbg {
            background-color: rgb(222, 28, 28);
        }
        .catbutton:hover {
            background-color: #82c785;
        }
        .redbg:hover {
            background-color: rgb(255, 143, 143);
        }
    </style>
</head>
<body>
    <div id="ramka">
        <form method="POST">
            <?php
            echo '<a href="/~yeji/sort.php">home</a> <input type="text" name="filename" placeholder="filename" value="' . basename($randomfilepath) . '">';
            echo '<input type="hidden" name="origin" value="' . $randomfilepath . '">';
            ?>
            <input type="text" name="dest" placeholder="destination">
            <input type="submit" value="submit">
        </form>
    </div>
    <div><ul>
        <?php
        $dirs1 = array_filter(glob($DBDIR . '*' , GLOB_ONLYDIR), 'is_dir');
        foreach ($dirs1 as $path) {
            
            echo '<form method="POST">';
            echo '<input type="hidden" name="filename" placeholder="filename" value="' . basename($randomfilepath) . '">';
            echo '<input type="hidden" name="origin" value="' . $randomfilepath . '">';
            echo '<input type="hidden" name="dest" value="' . str_replace($DBDIR, "", $path) . '">';
            echo '<button type="submit" class="catbutton redbg">' . str_replace($DBDIR, "", $path) . '</button></form>';
            echo "\n";
            $dirs2 = array_filter(glob($path . '/*' , GLOB_ONLYDIR), 'is_dir');
            foreach ($dirs2 as $path) {
            
                echo '<form method="POST">';
                echo '<input type="hidden" name="filename" placeholder="filename" value="' . basename($randomfilepath) . '">';
                echo '<input type="hidden" name="origin" value="' . $randomfilepath . '">';
                echo '<input type="hidden" name="dest" value="' . str_replace("$DBDIR", "", $path) . '">';
                echo '<button type="submit" class="catbutton bluebg">' . str_replace("$DBDIR", "", $path) . '</button></form>';
                echo "\n";
            }
        }
        ?>
    </ul></div>
    <?php
    echo '<hr><img src="http://' . $_SERVER['SERVER_ADDR'] . '/' . $CLIENTPREAPACHESTRING . $SAMSARA . basename($randomfilepath) . '">';}
    ?>
</body>
</html>

