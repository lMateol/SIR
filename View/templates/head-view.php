<?php session_start();
    error_reporting(0);
    $varsesion=$_SESSION['usuario'];
    if ($varsesion== null || $varsesion=='') {
        echo 'Usted no tiene autorización';
        die()};?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rodillos Mastder</title>
  <!--  <link rel="icon" href="img/rodillo.png"> -->
    <link rel="stylesheet" href="iconmoon/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu-view.css">
    <link rel="stylesheet" type="text/css" href="css/layout.min.css">
    <link rel="stylesheet" type="text/css" href="css/home-view.css">
    <link rel="stylesheet" type="text/css" href="css/general-view.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="ajax/menu-view.css">
    <link href="http://localhost:8080/fonts.googleapis.com/css?family=Josefin+Sans|Montez" rel="stylesheet">
</head>