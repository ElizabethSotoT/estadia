<?php
session_start();
	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_requerimiento']==1){
			header("location:lista_requerimiento.php");
			mysqli_close($conection);
			exit;
		}	
		$id_requerimiento=$_POST['id_requerimiento'];
		$query_delete=mysqli_query($conection,"DELETE FROM requerimientos_anuncios where id_requerimiento=$id_requerimiento");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_requerimiento.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_requerimiento.php");
		mysqli_close($conection);
	}else{

		$id_requerimiento=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT id_requerimiento, id_persona, fecha, descripcion FROM requerimientos_anuncios where id_requerimiento=$id_requerimiento");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_requerimiento=$data['id_requerimiento'];
				$id_persona=$data['id_persona'];
				$fecha=$data['fecha'];
				$descripcion=$data['descripcion'];
				}
		}else{
			header("location: lista_requerimiento.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar requerimiento</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente requerimiento?</h2>
                    <p>ID:<span><?php echo $id_requerimiento; ?></span></p>
                    <p>Persona:<span><?php echo $id_persona; ?></span></p>
                    <p>Fecha:<span><?php echo $fecha; ?></span></p>                    
                	<form method="post" action="">
                    	<input type="hidden" name="id_requerimiento" value="<?php echo $id_requerimiento; ?>">
                    	<a href="lista_requerimiento.php" class="btn_cancel">Cancelar</a>
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