<html>
<?php
session_start();
include_once("config.php");

$fName=$_POST["firstName"];
$lName=$_POST["lastName"];
$email=$_POST["email"];
$sAdress=$_POST["streetAdress"];
$apt=$_POST["apt"];
$city=$_POST["city"];
$district=$_POST["district"];
$pCode=$_POST["postalCode"];
$phone=$_POST["phone"];
$comanda=$_POST["textC"];

$subject='<b>Nume :</b> '.$lName.' '.$fName. ' <br> <b>Email :</b> '.$email.' <br> <b>Street Adress:</b> '.$sAdress.'<br><b>Apt:</b> '.$apt.'<br><b>City:</b> '.$city.'<br><b>District:</b> '.$district.'<br><b>Postal Code:</b> '.$pCode.'<br><b>Phone:</b> '.$phone.'<br><b>Comanda:</b> '.$comanda;

echo $subject.'<br><br><br>';

$email="gabriel.tarpian93@gmail.com";
$content=$comanda;


if(@mail($email,$subject,$content,"From:magicfootball@gmail.com"))
	echo "Email sent!";
else echo "Email not sent!";
?>
</html>