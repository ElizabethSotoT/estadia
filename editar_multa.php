<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{

		$alert='';
		if(empty($_POST['id_multa']) || empty($_POST['fecha']) || empty($_POST['id_requerimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_multa= $_POST['id_multa'];
			$fecha= $_POST['fecha'];
			$id_requerimiento= $_POST['id_requerimiento'];
			
			$query= mysqli_query($conection, "select * from multas_anuncios where id_multa = '$id_multa'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">Multa ya existe</p>';	
			}else{
					if(empty($_POST['id_multa'])){
						$sql_update= mysqli_query($conection,"UPDATE multas_anuncios
															set id_multa='$id_multa', fecha='$fecha', id_requerimiento='$id_requerimiento' where id_multa='$id_multa'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE multas_anuncios
															set id_multa='$id_multa', fecha='$fecha', id_requerimiento='$id_requerimiento' where id_multa='$id_multa'");
					}					

				if($sql_update){
					$alert='<p class="msg_save">Multa actualizada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la multa</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_multa.php');
			mysqli_close($conection);
	}
		$id_multa= $_GET['id'];
		$query= mysqli_query($conection,"select id_multa, fecha, id_requerimiento FROM multa_anuncios WHERE id_multa=$id_multa");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_multa.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_multa= $data['id_multa'];
				$fecha= $data['fecha'];
				$id_requerimiento= $data['id_requerimiento'];
			}	
		}
	
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar multa</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar multa</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_multa" value="<?php echo $id_multa; ?>">
    	<label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" placeholder="Fecha" value="<?php echo $fecha; ?>">
    	<label for="id_requerimiento">Requerimiento</label>
        <input type="text" name="id_requerimiento" id="id_requerimiento" placeholder="Requerimiento" value="<?php echo $id_requerimiento; ?>">
        <input type="submit" value="Actualizar multa" class="btn_save">
        </select>         
    </form>
    
    </div>
			</div>
            	<?php include "includes/aside.php"; ?>
            </div>	 
		</div>
	</section>
		<?php include "includes/footer.php"; ?>
</body>
</html>