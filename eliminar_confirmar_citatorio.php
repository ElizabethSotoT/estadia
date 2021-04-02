<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_citatorio']==1){
			header("location: lista_citatorio.php");
			mysqli_close($conection);
			exit;
		}	
		$id_citatorio=$_POST['id_citatorio'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM citatorios_anuncios where id_citatorio=$id_citatorio");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_citatorio.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_citatorio.php");
		mysqli_close($conection);
	}else{

		$id_citatorio=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT c.id_citatorio, c.razon, c.fecha_creado, c.fecha_citatorio, c.id_persona, p.nombre_responsable, p.nombre_comercial, c.id_requerimiento, r.id_requerimiento, r.descripcion FROM personas p INNER JOIN citatorios_anuncios c on p.id_persona=c.id_persona INNER JOIN requerimientos_anuncios r on r.id_requerimiento=c.id_requerimiento WHERE c.id_citatorio=$id_citatorio");

		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_citatorio=$data['id_citatorio'];
				$fecha_creado=$data['fecha_creado'];
				$fecha_citatorio=$data['fecha_citatorio'];
				$nombre_responsable=$data['nombre_responsable'];
				$id_requerimiento=$data['id_requerimiento'];
				$descripcion=$data['descripcion'];
				}
		}else{
			header("location: lista_citatorio.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar citatorio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente citatorio?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_citatorio; ?></span></p>
                    <p><strong>Fecha:</strong><span><?php echo $fecha_creado; ?></span></p>
                    <p><strong>Fecha citatorio:</strong><span><?php echo $fecha_citatorio; ?></span></p>
                    <p><strong>Persona:</strong><span><?php echo $nombre_responsable; ?></span></p>
                    <p><strong>Requerimiento:</strong><span><?php echo $id_requerimiento; ?></span></p>
					<p><strong>Requerimiento:</strong><span><?php echo $descripcion; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="id_citatorio" value="<?php echo $id_citatorio; ?>">
                    	<a href="lista_citatorio.php" class="btn_cancel">Cancelar</a>
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