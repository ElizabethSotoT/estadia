<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_persona']==1){
			header("location: lista_persona.php");
			mysqli_close($conection);
			exit;
		}	
		$id_persona=$_POST['id_persona'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM personas where id_persona=$id_persona");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_persona.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_persona.php");
		mysqli_close($conection);
	}else{

		$id_persona=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT id_persona, nombre_responsable, nombre_comercial, rfc, tipo
										 FROM personas WHERE id_persona=$id_persona");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_persona=$data['id_persona'];
				$nombre_responsable=$data['nombre_responsable'];
				$nombre_comercial=$data['nombre_comercial'];
				$rfc=$data['rfc'];
				$tipo=$data['tipo'];
				}
		}else{
			header("location: lista_persona.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar persona</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar siguiente persona?</h2>
                    <p><strong>Nombre del responsable:</strong><span><?php echo $nombre_responsable; ?></span></p>
                    <p><strong>Nombre comercial:</strong><span><?php echo $nombre_comercial; ?></span></p>
                    <p><strong>RFC:</strong><span><?php echo $rfc; ?></span></p>
                    <p><strong>Tipo:</strong><span><?php echo $tipo; ?></span></p>
                	<form method="post" action="">
                    	<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
                    	<a href="lista_persona.php" class="btn_cancel">Cancelar</a>
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