<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_multa']==1){
			header("location: lista_multa.php");
			mysqli_close($conection);
			exit;
		}	
		$id_multa=$_POST['id_multa'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM multas_anuncios where id_multa=$id_multa");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_multa.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_multa.php");
		mysqli_close($conection);
	}else{

		$id_multa=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT m.id_multa, m.fecha, m.id_requerimiento, r.descripcion from multas_anuncios m inner join requerimientos_anuncios r on r.id_requerimiento=m.id_requerimiento where m.id_multa=$id_multa");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_multa=$data['id_multa'];
				$fecha=$data['fecha'];
				$id_requerimiento=$data['id_requerimiento'];
				$descripcion=$data['descripcion'];
				}
		}else{
			header("location: lista_multa.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar multa</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar la siguiente multa?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_multa; ?></span></p>
                    <p><strong>Fecha:</strong><span><?php echo $fecha; ?></span></p>
                    <p><strong>Requerimiento:</strong><span><?php echo $id_requerimiento; ?></span></p>
					<p><strong>Descripcion:</strong><span><?php echo $descripcion; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="id_multa" value="<?php echo $id_multa; ?>">
                    	<a href="lista_multa.php" class="btn_cancel">Cancelar</a>
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