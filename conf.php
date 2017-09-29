<?php

$servername = 'localhost';
$username = 'username';
$password = 'password';
$database = 'database';

function EchoJSON($q , $r){

try 
{
	$pdo = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);

}
catch (PDOException $e) 
{
    echo $e->getMessage();
    exit();
}

$statement=$pdo->prepare($q);
$statement->execute();
$results[$r]=$statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results,JSON_UNESCAPED_UNICODE);
}


function GetJSON($q){
try 
{
	$pdo = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);

}
catch (PDOException $e) 
{
    return $e->getMessage();
    exit();
}

$statement=$pdo->prepare($q);
$statement->execute();
return $statement->fetchAll(PDO::FETCH_ASSOC);

}


function GetCount($q){
try 
{
	$pdo = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);

}
catch (PDOException $e) 
{
    return 0;
    exit();
}

$statement=$pdo->prepare($q);
$statement->execute();
return $statement->rowCount();
}


function Query($q){
try 
{
	$pdo = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);
}
catch (PDOException $e) 
{
    echo $e->getMessage();
    return false;
    exit();
}

$statement=$pdo->prepare($q);
$status = $statement->execute();

if ($status) {
   return true;
} else {
    $errors = $statement->errorInfo();
    echo($errors[2]);
    return false;
}
}


function clean($string) {
   $string = str_replace(' ', '-', $string);
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
   return preg_replace('/-+/', '-', $string);
}

function Shamsi(){
require_once 'jdf.php';
return jdate('Y/m/d');
}

function Clock(){
$ti = new DateTime();
return $ti->format('H:i');
}

Function Now(){
    $s=Shamsi();
    $c=Clock();
    return $s .'-'.$c;
}

function RandomPass($length = 10) {
    $vmsString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($vmsString),0,$length);
}

function SaleBad (){
    require_once 'jdf.php';
    $date = date('Y-m-d', strtotime('+1 years'));
    $date =  strtotime($date);
    return jdate("Y/m/d",$date); 
}

function Get($VarName){
    return $_GET[$VarName];
}

function Post($VarName){
    return $_POST[$VarName];
}

function Insert($table, $array) {
  $query = "INSERT INTO ".$table;
  $fis = array(); 
  $vas = array();
  foreach($array as $field=>$val) {
    $fis[] = "`$field`"; 
    $vas[] = "'".$val."'";
  }
  $query .= " (".implode(", ", $fis).") VALUES (".implode(", ", $vas).")";
  $pdo = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);

$statement=$pdo->prepare($query);
$status = $statement->execute();

if ($status) {
   return true;
} else {
    $errors = $statement->errorInfo();
    echo($errors[2]);
    return false;
}
}

function JSON() {
    return json_decode($_POST['JSON'],true);
}
?>