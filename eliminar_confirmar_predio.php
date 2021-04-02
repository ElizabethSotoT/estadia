<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['idpredio']==1){
			header("location: lista_predio.php");
			mysqli_close($conection);
			exit;
		}	
		$idpredio=$_POST['idpredio'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"UPDATE predios SET estatus = 0 where id_predio=$idpredio");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_predio.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_predio.php");
		mysqli_close($conection);
	}else{

		$idpredio=$_REQUEST['id'];
		$query= mysqli_query($conection,"select clave, manzana, lote, propietario from 
											predios where id_predio=$idpredio");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$clave=$data['clave'];
				$manzana=$data['manzana'];
				$lote=$data['lote'];
				$propietario=$data['propietario'];
				}
		}else{
			header("location: lista_predio.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar predio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente predio?</h2>
                    <p><strong>Clave:</strong><span><?php echo $clave; ?></span></p>
                    <p><strong>Manzana:</strong><span><?php echo $manzana; ?></span></p>
                    <p><strong>Lote:</strong><span><?php echo $lote; ?></span></p>
                    <p><strong>Propietario:</strong><span><?php echo $propietario; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="idpredio" value="<?php echo $idpredio; ?>">
                    	<a href="lista_predio.php" class="btn_cancel">Cancelar</a>
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