<?php
 
/* VALUES */
$id=$_POST['id'];
$descripcion=$_POST['title'];
$horainicio=$_POST['start'];
$horafinal=$_POST['end'];
 
// connexion à la base de données
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=agendamedica2', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
$sql = "UPDATE cita SET descripcion=?, horainicio=?, horafinal=? WHERE idc=?";
$q = $bdd->prepare($sql);
$q->execute(array($descripcion,$horainicio,$horafinal,$id));
 
?>