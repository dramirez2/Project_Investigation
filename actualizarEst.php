<?php
$host = "localhost";
$usuario = "username";
$password = "password";
$database = "database";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);

session_start();
if(strlen($_SESSION['pass']) > 20 or strlen($_SESSION['user']) > 20)
{
header("location: http://ada.uprrp.edu/~username/ccom4027/project/login.html");
}
else
{
$query_users = mysql_query('select username from Passwords where pass = "'.$_SESSION['pass'].'"');
$query_pass = mysql_query('select pass from Passwords where username = "'.$_SESSION['user'].'"'); // using client input as variable for a query: asking to be hacked.

if (/*mysql_num_rows($query_pass) > 0 or*/ mysql_num_rows($query_users) > 0) // More than 1 row returned which means there is data
{
//header("location: http://ada.uprrp.edu/~username/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again

}else{ // No rows were returned therefore there were no matches

header("location: http://ada.uprrp.edu/~username/ccom4027/project/login.html"); //jump to PORTADA: investiga.php
}
}
$numdel = $_POST['NumEstu'];
$buttondel = $_POST['deleteEst'];
if ($buttondel == "DELETE"){

mysql_query('delete from Estudiantes where est_id='.$numdel.';');
header('location: http://ada.uprrp.edu/~username/ccom4027/project/investiga.php');
exit;
}
$name = $_POST['EstName'];
$num = $_POST['EstNum'];
$email = $_POST['EstE'];
$tele  = $_POST['EstT'];
$year  = $_POST['EstA'];
$ccom = $_POST['EstCC'];
$oldnum=$_POST['ONum'];
switch($ccom){
	case "Si":
    case "S" :
	case "si":
	case "s" :
			$clasif = 1;
			break;
    default : $clasif = 0;	
}
if ($name !=null){
mysql_query('update Estudiantes set nombre="'.$name.'" where est_id ="'.$oldnum.'";');
}

if ($email !=null){
mysql_query('update Estudiantes set email="'.$email.'" where est_id ="'.$oldnum.'";');
}
if ($tele !=null){
mysql_query('update Estudiantes set cell_num="'.$tele.'" where est_id ="'.$oldnum.'";');
}
if ($year !=null){
mysql_query('update Estudiantes set year="'.$year.'" where est_id ="'.$oldnum.'";');
}
if ($ccom !=null){
mysql_query('update Estudiantes set clasificado_ccom="'.$clasif.'" where est_id ="'.$oldnum.'";');
}
if ($num !=null){
mysql_query('update Estudiantes set est_id="'.$num.'" where est_id ="'.$oldnum.'";');
$oldnum = $num;
}
//$estu_update = 'update Estudiantes set nombre="'.$name.'",email="'.$email.'",cell_num="'.$tele.'",year='.$year.',clasificado_ccom='.$clasif.',est_id="'.$num.'" where est_id="'.$oldnum.'";';
//$estu_up_res = mysql_query($estu_update);
//echo 'update Estudiantes set nombre="'.$name.'",email="'.$email.'",cell_num="'.$tele.'",year='.$year.',clasificado_ccom='.$clasif.',est_id="'.$num.'" where est_id="'.$oldnum.'";';
header('location: http://ada.uprrp.edu/~username/ccom4027/project/DesplegarEst.php?NumStu='.$oldnum);

?>