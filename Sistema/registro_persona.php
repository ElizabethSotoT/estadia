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

			$nombre_responsable= $_POST['nombre_responsable'];
			$nombre_comercial= $_POST['nombre_comercial'];	
			$rfc= $_POST['rfc'];
			$tipo= $_POST['tipo'];

			$query= mysqli_query($conection, "select * from personas where rfc = '$rfc'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El RFC de persona ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"insert into 
				personas (nombre_responsable, nombre_comercial, rfc, tipo)
				values ('$nombre_responsable', '$nombre_comercial', '$rfc', '$tipo')");
				if($query_insert){
					$alert='<p class="msg_save">Persona registrada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar a persona</p>';
                                        echo "nombre_responsable:$nombre_responsable _nombre_comercial:$nombre_comercial _rfc:$rfc";
					}	
			}
			header('location:lista_persona.php');
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Personas Física/Moral</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro de Personas</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
        <label for="nombre_responsable">Nombre responsable*</label>
        <input type="text" name="nombre_responsable" id="nombre_responsable" placeholder="Nombre del responsable">
        <label for="nombre_comercial">Nombre comercial</label>
        <input type="text" name="nombre_comercial" id="nombre_comercial" placeholder="Nombre comercial">
        <label for="rfc">RFC*</label>
        <input type="text"  name="rfc" id="rfc" placeholder="RFC"> 
        <label for="tipo">Elige un tipo de persona*: </label> 
        <select name="tipo" id="tipo" placeholder="Fisca/Moral">
		    <option>Física</option>
		    <option>Moral</option>	
		    <option>Otro</option>		     
		</select>
		
        
        <input type="submit" value="Crear persona" class="btn_save">
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