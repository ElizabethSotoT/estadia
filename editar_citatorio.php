<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['razon']) || empty($_POST['fecha_creado']) || empty($_POST['fecha_citatorio']) || empty($_POST['id_persona']) || empty($_POST['id_requerimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			$id_citatorio= $_POST['id_citatorio'];
			$razon= $_POST['razon'];
			$fecha_creado= $_POST['fecha_creado'];	
			$fecha_citatorio= $_POST['fecha_citatorio'];
			$id_persona= $_POST['id_persona'];
			$id_requerimiento= $_POST['id_requerimiento'];
			
			$query1= mysqli_query($conection, "select * from citatorios_anuncios where id_citatorio = '$id_citatorio'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El citatorio ya existe</p>';	
			}else{
					if(empty($_POST['id_citatorio'])){
						$sql_update= mysqli_query($conection,"UPDATE citatorios_anuncios
															set razon='$razon', fecha_creado='$fecha_creado', fecha_citatorio='$fecha_citatorio', id_persona='$id_persona', id_requerimiento='$id_requerimiento' where id_citatorio='$id_citatorio'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE citatorios_anuncios
															set razon='$razon', fecha_creado='$fecha_creado', fecha_citatorio='$fecha_citatorio', id_persona='$id_persona', id_requerimiento='$id_requerimiento' where id_citatorio='$id_citatorio'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Citatorio actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el citatorio</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_citatorio.php');
			mysqli_close($conection);
	}
		$id_citatorio= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_citatorio, razon, fecha_creado, fecha_citatorio, id_persona, id_requerimiento  from citatorios_anuncios WHERE id_citatorio=$id_citatorio");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_citatorio.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_citatorio= $data['id_citatorio'];
				$razon= $data['razon'];
				$fecha_creado= $data['fecha_creado'];	
				$fecha_citatorio= $data['fecha_citatorio'];
				$id_persona= $data['id_persona'];
				$id_requerimiento= $data['id_requerimiento'];
				
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar citatorio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar citatorio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_citatorio" value="<?php echo $id_citatorio; ?>">
        <label for="razon">Razon</label>
        <input type="text" name="razon" id="razon" placeholder="Razon de citatorio" value="<?php echo $razon; ?>">
        <label for="fecha_creado">Fecha</label>
        <input type="date" name="fecha_creado" id="fecha_creado" placeholder="Fecha de proceso" value="<?php echo $fecha_creado; ?>">
        <label for="fecha_citatorio">Fecha de citatorio</label>
        <input type="date" name="fecha_citatorio" id="fecha_citatorio" placeholder="Fecha de citatorio" value="<?php echo $fecha_citatorio; ?>">
        <label for="id_persona">Persona</label>
        <input type="text" name="id_persona" id="id_persona" placeholder="Persona física/moral" value="<?php echo $id_persona; ?>">
        <label for="id_requerimiento">Requerimiento</label>
        <input type="text" name="id_requerimiento" id="id_requerimiento" placeholder="Requerimiento" value="<?php echo $id_requerimiento; ?>">
        <input type="submit" value="Actualizar citatorio" class="btn_save">
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