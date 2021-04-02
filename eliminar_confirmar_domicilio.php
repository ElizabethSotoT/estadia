<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_domicilio']==1){
			header("location: lista_domicilio.php");
			mysqli_close($conection);
			exit;
		}	
		$id_domicilio=$_POST['id_domicilio'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM domicilios_personas WHERE id_domicilio=$id_domicilio");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_domicilio.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_domicilio.php");
		mysqli_close($conection);
	}else{

		$id_domicilio=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT id_domicilio, calle1, numero_exterior, numero_interior, tipo, codigo_postal, ciudad, estado, predio_superficie, clave_catastral, calle_norte, calle_sur, calle_este, calle_oeste FROM domicilios_personas WHERE id_domicilio=$id_domicilio");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_domicilio=$data['id_domicilio'];
				$calle1=$data['calle1'];
				$numero_exterior=$data['numero_exterior'];
				$ciudad=$data['ciudad'];
				$predio_superficie=$data['predio_superficie'];
				$clave_catastral=$data['clave_catastral'];
				}
		}else{
			header("location: lista_domicilio.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar domicilio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente domicilio?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_domicilio; ?></span></p>
                    <p><strong>Calle:</strong><span><?php echo $calle1; ?></span></p>
                    <p><strong>No.Exterior:</strong><span><?php echo $numero_exterior; ?></span></p>
                    <p><strong>Ciudad:</strong><span><?php echo $ciudad; ?></span></p>
                    <p><strong>Clave catastral:</strong><span><?php echo$clave_catastral; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="id_domicilio" value="<?php echo $id_domicilio; ?>">
                    	<a href="lista_domicilio.php" class="btn_cancel">Cancelar</a>
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