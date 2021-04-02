<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_persona']) || empty($_POST['nombre_responsable']) || empty($_POST['rfc']) || empty($_POST['tipo']) || empty($_POST['calle']) || empty($_POST['numero']) || empty($_POST['id_colonia']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_persona= $_POST['id_persona'];
			$nombre_responsable= $_POST['nombre_responsable'];
			$nombre_comercial= $_POST['nombre_comercial'];	
			$rfc= $_POST['rfc'];
			$tipo= $_POST['tipo'];
			$calle= $_POST['calle'];
			$numero= $_POST['numero'];
			$id_colonia= $_POST['id_colonia'];


			$query= mysqli_query($conection, "select * from personas where id_persona = '$id_persona'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El RFC de persona ya existe</p>';
			}else{
					if(empty($_POST['id_persona'])){
						$sql_update= mysqli_query($conection,"UPDATE personas
															  SET nombre_responsable='$nombre_responsable', nombre_comercial='$nombre_comercial', rfc='$rfc', tipo='$tipo', calle='$calle', numero='$numero', id_colonia='$id_colonia'
															  WHERE id_persona='$id_persona'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE personas
															  SET nombre_responsable='$nombre_responsable', nombre_comercial='$nombre_comercial', rfc='$rfc', tipo='$tipo', calle='$calle', numero='$numero', id_colonia='$id_colonia'
															  WHERE id_persona='$id_persona'");
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
		$query= mysqli_query($conection,"SELECT p.id_persona, p.nombre_responsable, p.nombre_comercial, p.rfc, p.tipo, p.calle, p.numero, p.id_colonia, a.nombre FROM personas p inner join asentamientos a on p.id_colonia=a.id_asent WHERE p.id_persona=$id_persona order by id_persona");
			
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
				$calle= $data['calle'];
				$numero= $data['numero'];
				$id_colonia= $data['id_colonia'];
				$nombre_colonia= $data['nombre'];
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Personas Físicas/Morales</title>
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
        <select name="tipo" id="tipo" placeholder="Fisca/Moral" value="<?php echo $tipo; ?>">
        	<option value="<?php echo $tipo; ?>" selected><?php echo $tipo; ?></option>
		    <option>Física</option>
		    <option>Moral</option>	
		    <option>Otro</option>		     
		</select>
		<label for="calle">Calle*</label>
        <input type="text"  name="calle" id="calle" placeholder="Calle" value="<?php echo $calle; ?>">
		<label for="numero">Número*</label>
        <input type="text"  name="numero" id="numero" placeholder="Número" value="<?php echo $numero; ?>">
        <label for="id_colonia">Colonia*</label>
        <?php include "conexion.php";
		$query_colonia= mysqli_query($conection, "select * from asentamientos order by nombre1");
			mysqli_close($conection);
		$result_colonia= mysqli_num_rows($query_colonia);
		?>
        <select name="id_colonia" id="id_colonia"> 
        <option value="<?php echo $id_colonia; ?>" selected><?php echo $nombre_colonia; ?></option>
			<?php
                if ($result_colonia > 0)
                {
            
                   while($id_colonia= mysqli_fetch_array($query_colonia)) {
			?>
            <option value="<?php echo $id_colonia['id_asent']; ?>"><?php echo $id_colonia['nombre1'] ?></option>
            <?php
					}
                }
            
            ?>
            </select> 
        <input type="submit" value="Actualizar persona" class="btn_save">
                 
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