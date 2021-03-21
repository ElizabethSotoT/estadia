<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['id_anuncio']==1){
			header("location: lista_anuncio.php");
			mysqli_close($conection);
			exit;
		}	
		$id_anuncio=$_POST['id_anuncio'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE FROM anuncios where id_anuncio=$id_anuncio");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_anuncio.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_anuncio.php");
		mysqli_close($conection);
	}else{

		$id_anuncio=$_REQUEST['id'];
		$query= mysqli_query($conection,"select id_anuncio, clave_catastral, ubicacion, tipo_anuncio from 
											anuncios where id_anuncio=$id_anuncio");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_anuncio=$data['id_anuncio'];
				$clave_catastral=$data['clave_catastral'];
				$calle1=$data['ubicacion'];
				$tipo_anuncio=$data['tipo_anuncio'];
				
				}
		}else{
			header("location: lista_anuncio.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar anuncio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente anuncio?</h2>
                    <p>ID:<span><?php echo $id_anuncio; ?></span></p>
                    <p>Clave catastral:<span><?php echo $clave_catastral; ?></span></p>
                    <p>Ubicación:<span><?php echo $ubicacion; ?></span></p>
                    <p>Tipo:<span><?php echo $tipo_anuncio; ?></span></p>
                   
                	<form method="post" action="">
                    	<input type="hidden" name="id_anuncio" value="<?php echo $id_anuncio; ?>">
                    	<a href="lista_anuncio.php" class="btn_cancel">Cancelar</a>
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