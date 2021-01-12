<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['idnumero']==1){
			header("location: lista_numero.php");
			mysqli_close($conection);
			exit;
		}	

		$idnumero=$_POST['idnumero'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM numero_oficial where id_numero=$idnumero");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_numero.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	//Consulta para traer datos a mostrar ventana previa
	if(empty($_REQUEST['id']))
	{
		header("location: lista_numero.php");
		mysqli_close($conection);
	}else{
		$idnumero=$_REQUEST['id'];
		$query= mysqli_query($conection,"select n.id_numero, n.id_predio, n.folio, p.propietario from numero_oficial n inner join predios p on n.id_predio= p.id_predio");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$folio=$data['folio'];
				$idPredio=$data['id_predio'];
				$propietario=$data['propietario'];
				}
		}else{
			header("location: lista_numero.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar número</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente número?</h2>
                    <p>Id:<span><?php echo $idnumero; ?></span></p>
                    <p>Folio:<span><?php echo $folio; ?></span></p>
                    <p>Predio:<span><?php echo $idPredio; ?></span></p>
                    <p>Propietario:<span><?php echo $propietario; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="idnumero" value="<?php echo $idnumero; ?>">
                    	<a href="lista_numero.php" class="btn_cancel">Cancelar</a>
                        <input type="submit" value="Aceptar" class="btn_ok">
                    </form>
                </div>

			</div>
		 
		<?php include "includes/aside.php"; ?>
		</div>
	</section>
		<?php include "includes/footer.php"; ?>
</body>
</html>