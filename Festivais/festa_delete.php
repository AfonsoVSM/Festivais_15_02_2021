<?php
if ($_SERVER['REQUEST_METHOD']=='GET'){
	if(isset($_GET['festa']) && is_numeric($_GET['festa'])){
		$idFilme = $_GET['festa'];
		$con = new mysqli ("localhost","root","","festa");

		if ($con->connect_errno!=0){
			echo "Ocorreu um erro o acesso á base de dados. <br>" .$con->connect_error;
			exit;
		}
		else{
			$sql = "delete from festa where id_festa=?";
			$stm = $con->prepare($sql);
			if ($stm!=false){
				$stm->bind_param("i",$id_festa);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Livro eliminado com sucesso")A reencaminhar página';
				header ('refresh:5; url=index.php');
			}
			else{
				echo '<br>';
				echo ($con->error);
				echo '<br>';
				echo "Aguarde um momento.A reencaminhar página";
				echo '<br>';
				header ("refresh:5;url=index.php");

			}
		}
	}
	else{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header ("refresh:5;url=index.php");
	}
}
else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
	header ("refresh:5; url=index.php");
}
?>