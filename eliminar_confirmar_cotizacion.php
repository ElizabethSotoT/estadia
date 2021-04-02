<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_cotizacion']==1){
			header("location: lista_cotizacion.php");
			mysqli_close($conection);
			exit;
		}	
		$id_cotizacion=$_POST['id_cotizacion'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM cotizaciones_anuncio WHERE id_cotizacion=$id_cotizacion");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_cotizacion.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_cotizacion.php");
		mysqli_close($conection);
	}else{

		$id_cotizacion=$_REQUEST['id'];
		$query= mysqli_query($conection,"select c.id_cotizacion, c.fecha, c.fecha_inicio, c.fecha_final, p.nombre_responsable, p.nombre_comercial, p.rfc, c.id_persona, c.id_anuncio, a.ubicacion, a.tipo_anuncio, a.medida1, a.medida2, a.cantidad FROM personas p INNER JOIN cotizaciones_anuncio c on p.id_persona = c.id_persona INNER JOIN anuncios a on a.id_anuncio=c.id_anuncio where id_cotizacion=$id_cotizacion");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_cotizacion=$data['id_cotizacion'];
				$fecha=$data['fecha'];
				$fecha_inicio=$data['fecha_inicio'];
				$fecha_final=$data['fecha_final'];
				$nombre_responsable=$data['nombre_responsable'];
				$ubicacion=$data['ubicacion'];
				$tipo_anuncio=$data['tipo_anuncio'];
				}
		}else{
			header("location: lista_cotizacion.php");
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
                    <h2>¿Está seguro de eliminar la siguiente cotización?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_cotizacion; ?></span></p>
                    <p><strong>Fecha:</strong><span><?php echo $fecha; ?></span></p>
                    <p><strong>Fecha de inicio:</strong><span><?php echo $fecha_inicio; ?></span></p>
                    <p><strong>Fecha final:</strong><span><?php echo $fecha_final; ?></span></p>
                    <p><strong>Nombre del responsable:</strong><span><?php echo $nombre_responsable; ?></span></p>
                    <p><strong>Ubicación:</strong><span><?php echo $ubicacion; ?></span></p>
                    <p><strong>Tipo de anuncio:</strong><span><?php echo $tipo_anuncio; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="id_cotizacion" value="<?php echo $id_cotizacion; ?>">
                    	<a href="lista_cotizacion.php" class="btn_cancel">Cancelar</a>
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