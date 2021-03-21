<?php
session_start();

 //id_citatorio, razon, fecha_creado, fecha_citatorio, id_persona, id_requerimiento

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['razon']) || empty($_POST['fecha_citatorio']) || empty($_POST['id_persona'])|| empty($_POST['id_requerimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			date_default_timezone_set('America/Mexico_City');
			$razon= $_POST['razon'];
			$fecha_creado=date("Y-m-d H-i-s");
			$fecha_citatorio= $_POST['fecha_citatorio'];
			$id_persona= $_POST['id_persona'];
			$id_requerimiento= $_POST['id_requerimiento'];
			
			$query= mysqli_query($conection, "select * from citatorios_anuncios where id_requerimiento = '$id_requerimiento'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El citatorio ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"INSERT INTO 
				citatorios_anuncios (razon, fecha_creado, fecha_citatorio, id_persona, id_requerimiento)
				values ('$razon', '$fecha_creado', '$fecha_citatorio', '$id_persona', '$id_requerimiento')");

				if($query_insert){
					$alert='<p class="msg_save">Citatorio registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar el citatorio</p>';
                                        echo "_Razon:$razon _Fecha_creado:$fecha_creado _Fecha_citatorio:$fecha_citatorio _Id_persona:$id_persona _Id_requerimiento:$id_requerimiento";
					}	
			}
			
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de citatorio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro citatorio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="razon">Razon</label>
        <input type="text" name="razon" id="razon" placeholder="Razon">
        <label for="fecha_citatorio">Fecha citatorio</label>
        <input type="datetime-local" name="fecha_citatorio" id="fecha_citatorio" placeholder="Fecha citatorio">
        <label for="id_persona">Persona</label>
        <input type="text" name="id_persona" id="id_persona" placeholder="Persona">
        <label for="id_requerimiento">Requerimiento</label>
        <input type="text" name="id_requerimiento" id="id_requerimiento" placeholder="Requerimiento">                
        <input type="submit" value="Crear citatorio" class="btn_save">
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