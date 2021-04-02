<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		if($_POST['idpago']==1){
			header("location: lista_pago.php");
			mysqli_close($conection);
			exit;
		}	
		$idpago=$_POST['idpago'];
		//$query_delete=mysqli_query($conection,"delete from usuarios where id_usuario=$idusuario");
		
		$query_delete=mysqli_query($conection,"DELETE ordenes_pago where id_pago=$idpago");
			mysqli_close($conection);
		if($query_delete)
		{
			header("location: lista_pago.php");
		}else{
			echo "Error al eliminar";
		}
	}	

	if(empty($_REQUEST['id']))
	{
		header("location: lista_pago.php");
		mysqli_close($conection);
	}else{

		$idpago=$_REQUEST['id'];
		$query= mysqli_query($conection,"SELECT id_pago, concepto, importe, fecha from ordenes_pago WHERE id_pago=$idpago");
		mysqli_close($conection);
		$result= mysqli_num_rows($query);
		if($result>0){
			while ($data=mysqli_fetch_array($query)){
				$id_pago=$data['id_pago'];
				$importe=$data['importe'];
				$fecha=$data['fecha'];				
				}
		}else{
			header("location: lista_pago.php");
		}
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar pago</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
            	<div class="data_delete">
                    <h2>¿Está seguro de eliminar el siguiente pago?</h2>
                    <p><strong>ID:</strong><span><?php echo $id_pago; ?></span></p>
                    <p><strong>Importe:</strong><span><?php echo $importe; ?></span></p>
                    <p><strong>Fecha:</strong><span><?php echo $fecha; ?></span></p>                   
                	<form method="post" action="">
                    	<input type="hidden" name="idpago" value="<?php echo $idpago; ?>">
                    	<a href="lista_pago.php" class="btn_cancel">Cancelar</a>
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