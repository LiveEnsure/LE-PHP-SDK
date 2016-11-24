<?php
$data = parse_ini_file("../config/settings.ini", true);

    if($data['API_KEY'] == '' ){
       header('location: ../demo/index.php');
     }
?>
<!DOCTYPE html>
<input type='hidden' name='csrfmiddlewaretoken' value='148PCwNZo3QuWRG8aLHI2IdtxOZA7SGbpywsveKvwCxY3dXmW3edBSDlVII14LZ2' />
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <title>LiveEnsure&reg; SDK</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</head>