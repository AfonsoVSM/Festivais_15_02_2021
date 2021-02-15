<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['festa'])&& is_numeric($_GET['festa'])){
		$idFilme=$_GET['festa'];
		$con = new mysqli ("localhost","root","","festa");

		if($con->connect_errno!=0){
			echo "<h1>Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error."</h1>";
			exit();
		}
		$sql="Select * from festa where id_festa=?";
		$stm=$con->prepare($sql);
		if($stm!=false){
		$stm->bind_param("i",$id_festa);
		$stm-> execute();

		$res=$stm->get_result();
		$livro=$res->fetch_assoc();
		$stm->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO_8859-1">
	<title>Editar Festivais</title>
</head>
<body>
<h1>Editar Festivais</h1>
<form action="filmes_update.php"method="post">
<label>Id</label><input type="text" name="Id" required value="<?php echo $livro['Id'];?>"><br>
<label>Festivais</label><input type="text" name="Festivais" required value="<?php echo $livro['Festivais'];?>"><br>
<input type="hidden" name="id_festa" required value="<?php echo $livro['id_festa'];?>">
<input type="submit" name="enviar"><br>
</form>
</body>
<?php
}
else{
	echo ('<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>');
	header("refresh:5,url=index.php");
}
}
