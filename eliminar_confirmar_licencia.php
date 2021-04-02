<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_licencia']==1){
			header("location: lista_licencia.php");
			mysqli_close($conection);
			exit;
		}	
		$id_licencia=$_POST['id_licencia'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM licencia_anuncios where id_licencia=$id_licencia");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_licencia.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_licencia.php");
		mysqli_close($conection);
	}else{

		$id_licencia=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT l.id_licencia, p.nombre_responsable, p.nombre_comercial ,p.rfc, l.fecha_pago, l.fecha_inicio, l.fecha_final from personas p inner join licencia_anuncios l on p.id_persona = l.id_persona where l.id_licencia=$id_licencia");
										
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_licencia=$data['id_licencia'];
				$nombre_responsable=$data['nombre_responsable'];
				$nombre_comercial=$data['nombre_comercial'];
				$rfc=$data['rfc'];
				$fecha_inicio=$data['fecha_inicio'];
				$fecha_final=$data['fecha_final'];				
				}
		}else{
			header("location: lista_licencia.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar licencia</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar la siguiente licencia?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_licencia; ?></span></p>
					<p><strong>Nombre del responsable:</strong><span><?php echo $nombre_responsable; ?></span></p>
					<p><strong>Nombre comercial:</strong><span><?php echo $nombre_comercial; ?></span></p>
					<p><strong>ID:</strong><span><?php echo $id_licencia; ?></span></p>
                    <p><strong>Fecha inicio:</strong><span><?php echo $fecha_inicio; ?></span></p>
                    <p><strong>Fecha final:</strong><span><?php echo $fecha_final; ?></span></p>
                   
                	<form method="post" action="">
                    	<input type="hidden" name="id_licencia" value="<?php echo $id_licencia; ?>">
                    	<a href="lista_licencia.php" class="btn_cancel">Cancelar</a>
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