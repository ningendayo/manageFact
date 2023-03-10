<?php

$servername = "innovus.me";
$username = "partner";
$password = "inner_partner";
$dbname = "manageFact";

//PROCEDURAL
$conn = mysqli_connect($servername, $username, $password, $dbname);

//POO
$conn2 = new mysqli($servername, $username, $password, $dbname);