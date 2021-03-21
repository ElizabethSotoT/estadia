<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_persona']) || empty($_POST['fecha']) || empty($_POST['descripcion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_requerimiento= $_POST['id_requerimiento'];
			$id_persona= $_POST['id_persona'];
			$fecha= $_POST['fecha'];
			$descripcion= $_POST['descripcion'];


			$query= mysqli_query($conection, "select * from requerimientos_anuncios where id_requerimiento = '$id_requerimiento'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">Requerimiento ya existe</p>';	
			}else{
					if(empty($_POST['id_requerimiento'])){
						$sql_update= mysqli_query($conection,"UPDATE requerimientos_anuncios
															set id_persona='$id_persona', fecha='$fecha', descripcion='$descripcion' 
															where id_requerimiento='$id_requerimiento'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE requerimientos_anuncios
															set id_persona='$id_persona', fecha='$fecha', descripcion='$descripcion'
															where id_requerimiento='$id_requerimiento'");
					}

					

				if($sql_update){
					$alert='<p class="msg_save">Requerimiento actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el requerimiento</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_requerimiento.php');
			mysqli_close($conection);
	}
		$id_requerimiento= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_requerimiento, id_persona, fecha, descripcion from requerimientos_anuncios WHERE id_requerimiento=$id_requerimiento");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_requerimiento.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_requerimiento= $data['id_requerimiento'];
				$id_persona= $data['id_persona'];
				$fecha= $data['fecha'];
				$descripcion= $data['descripcion'];	
				
			}	
		}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar requerimiento</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar requerimiento</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_requerimiento" value="<?php echo $id_requerimiento; ?>">
    	<label for="id_persona">Nombre del responsable</label>
       	<input type="text" name="id_persona" id="id_persona" placeholder="Fecha" value="<?php echo $id_persona; ?>">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" placeholder="Fecha" value="<?php echo $fecha; ?>">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>">
           
        <input type="submit" value="Actualizar requerimiento" class="btn_save">
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

