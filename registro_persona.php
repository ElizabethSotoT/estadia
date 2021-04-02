<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre_responsable']) || empty($_POST['rfc']) || empty($_POST['tipo']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			$nombre_responsable= $_POST['nombre_responsable'];
			$nombre_comercial= $_POST['nombre_comercial'];	
			$rfc= $_POST['rfc'];
			$tipo= $_POST['tipo'];
			$calle= $_POST['calle'];
			$numero= $_POST['numero'];
			$rol= $_POST['rol'];

			$query= mysqli_query($conection, "select * from personas where rfc = '$rfc'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El RFC de persona ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"insert into 
				personas (nombre_responsable, nombre_comercial, rfc, tipo, calle, numero, id_colonia)
				values ('$nombre_responsable', '$nombre_comercial', '$rfc', '$tipo', '$calle', '$numero', '$rol')");
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
        <input type="text"  name="nombre_comercial" id="nombre_comercial" placeholder="Nombre comercial">
        <label for="rfc">RFC*</label>
        <input type="text" style="text-transform:uppercase" name="rfc" id="rfc" placeholder="RFC"> 
        <label for="tipo">Elige un tipo de persona*: </label> 
        <select name="tipo" id="tipo" placeholder="Fisca/Moral">
			<option value="0">Seleccione una opción</option>
		    <option>Física</option>
		    <option>Moral</option>	
		    <option>Otro</option>		     
		</select>
		<label for="calle">Calle*</label>
        <input type="text"  name="calle" id="calle" placeholder="Calle"> 
		<label for="numero">Número*</label>
        <input type="text"  name="numero" id="numero" placeholder="Número"> 
		<label for="rol">Colonia*</label>
        <?php include "conexion.php";
		$query_rol= mysqli_query($conection, "select * from asentamientos order by nombre1 asc");
			mysqli_close($conection);
		$result_rol= mysqli_num_rows($query_rol);

		?>
        <select name="rol" id="rol"> 
		<option value="0">Seleccione una opción</option>
			<?php
                if ($result_rol > 0)
                {
					
                   while($rol= mysqli_fetch_array($query_rol)) {
			?>
			
            <option value="<?php echo $rol['id_asent']; ?>"><?php echo $rol['nombre'] ?></option>
            <?php
					}
                }
            
            ?>
		
        
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