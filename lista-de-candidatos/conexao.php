<?php

//Criar as constantes com as credencias de acesso ao banco de dados
$host = "localhost";
$user = "";
$pass = "";
$dbname = "";
$port = 3306;

//Criar a conexão com banco de dados usando o PDO e a porta do banco de dados
//Utilizar o Try/Catch para verificar a conexão.
$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);
