<?php
session_start();
$con=new mysqli("localhost","root", "","festa");

if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
	exit;
}
else {
	if (!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
		if ($_SESSION['login']="correto"){


	?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="ISO-8859-1">
	<title>Festas</title>
	</head>
	<body>
		<a href="festa_create.php">Create</a>
		<h1>Lista de Festas</h1>
		<?php
		$stm=$con->prepare('select * from festa');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="festa_show.php?festa='.$resultado['id_festa'].'">';
			
			echo $resultado["titulo"];
			echo "</a> ";
			echo '<a href="festa_edit.php?filme='.$resultado['id_festa'].'"> edit</a>';
			echo '<a href="festa_delete.php?filme='.$resultado['id_festa'].'"> delete</a>';
			echo "<br>";
		}
		$stm->close();
		?>
	<br>
	</body>
	</html>

<?php
}//se login==correto
else {
	echo 'Para entrar nesta pagina necessita de efetuar <a href="login.php">login</a>';
	header('refresh: 2; url=login.php');
}

}//end if - if($con->connect_errno!=0)
?>