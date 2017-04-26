<?php

//if(!Auth::is_valid()){
 //		$this->redirect("principal/login");
 //	}else{
		
// 	}
 			
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$id=$_POST['id'];
$idmedi=$_POST['idmedi'];



$idmedico=$idmedi;
$estado='A';
$idpaciente=$id;
?>
<script language="JavaScript" type="text/javascript">
		//		var title = prompt('Añadir euna Citas: var start');
</script>
 <?php
// connexion à la base de données
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=agendamedica2', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
$sql = "INSERT INTO cita (descripcion, fecha, horainicio,horafinal,estado, idmedico,idpaciente) VALUES (:descripcion, :fecha,:horainicio,:horafinal,:estado,:idmedico,:idpaciente)";
$q = $bdd->prepare($sql);
$q->execute(array(

	':descripcion'=>$title, 
	':fecha'=>$start, 
	':horainicio'=>$start,
	':horafinal'=>$end,
	':estado'=>$estado,
	':idmedico'=>$idmedico,
	':idpaciente'=>$idpaciente


	));
?>