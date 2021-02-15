<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	$Id="";
	$Festival="";

	if(isset($_POST['Id'])){
		$Id=$_POST['Id'];
	}
	else{
		echo '<script>alert("É obrigatorio o preenchimento do id.");</script>';
	}
	if(isset($_POST['Festival'])){
		$Festival = $_POST['Festival'];
}
$con=new mysqli("localhost","root","","festa");

if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
	exit;
}
else{
	
	$sql='insert into festa(Id,Festival)values(?,?,?,?,?)';
		$stm=$con->prepare( $sql);
		if($stm!=false){

			$stm->bind_param('sssis',$Id,$Festival);
			$stm->execute();
			$stm->close();

			echo '<script>alert ("Livro adicionado com sucesso");</script>';

			echo 'Aguarde um momento.A reencaminhar página';
			header("refresh:5;url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index.php");
		}
		}//end if-if($con->connect_errno!=0)
}//if($_SERVER´['REQUEST_METHOD']=="POST")
else{ //else if($_SERVER['REQUEST_METHOD']=="POST")
  ?>

  	<!DOCTYPE html>
  	<html>
  	<head>
  		<meta charset="ISO_8859-1">
  		<title>Adicionar filmes</title>
  	</head>
  	<body>
  	<h1>Adicionar festivais</h1>
  	<form action="festa_create.php" method="post">
  	<label>Id</label><input type="text" name="Id" required><br>
  	<label>Festival</label><input type="text" name="Festival"><br>
  	<input type="submit" name="enviar"><br>
  	</form>
  	</body>
  	</html>

<?php
 }//end if-if($_SERVER['REQUEST_METHOD']=="POST")
?>