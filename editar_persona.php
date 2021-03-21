<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre_responsable']) || empty($_POST['rfc']) || empty($_POST['tipo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_persona= $_POST['id_persona'];
			$nombre_responsable= $_POST['nombre_responsable'];
			$nombre_comercial= $_POST['nombre_comercial'];	
			$rfc= $_POST['rfc'];
			$tipo= $_POST['tipo'];


			$query= mysqli_query($conection, "select * from personas where rfc = '$rfc'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El RFC de persona ya existe</p>';
			}else{
					if(empty($_POST['rfc'])){
						$sql_update= mysqli_query($conection,"UPDATE personas
															  SET nombre_responsable='$nombre_responsable', nombre_comercial='$nombre_comercial', rfc='$rfc', tipo='$tipo'
															  WHERE rfc='$rfc'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE personas
															  SET nombre_responsable='$nombre_responsable', nombre_comercial='$nombre_comercial', rfc='$rfc', tipo='$tipo'
															  WHERE rfc='$rfc'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Persona actualizada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar persona</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_persona.php');
			mysqli_close($conection);
	}
		$id_persona= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_persona, nombre_responsable, nombre_comercial, rfc, tipo
										 FROM personas WHERE id_persona=$id_persona");
			
		mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_persona.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_persona= $data['id_persona'];
				$nombre_responsable= $data['nombre_responsable'];
				$nombre_comercial= $data['nombre_comercial'];	
				$rfc= $data['rfc'];
				$tipo= $data['tipo'];
				
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Personas Física/Moral</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar persona</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">   
    	<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">	
        <label for="nombre_responsable">Nombre responsable</label>
        <input type="text" name="nombre_responsable" id="nombre_responsable" placeholder="Nombre del responsable" value="<?php echo $nombre_responsable; ?>">	
        <label for="nombre_comercial">Nombre comercial</label>
        <input type="text" name="nombre_comercial" id="nombre_comercial" placeholder="Nombre comercial" value="<?php echo $nombre_comercial; ?>">	
        <label for="rfc">RFC</label>
        <input type="text"  name="rfc" id="rfc" placeholder="RFC" value="<?php echo $rfc; ?>">	
        <label for="tipo">Elige un tipo de persona*: </label> 
        <select name="tipo" id="tipo" placeholder="Fisca/Moral">
		    <option>Física</option>
		    <option>Moral</option>	
		    <option>Otro</option>		     
		</select>
        <input type="submit" value="Actualizar persona" class="btn_save">
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