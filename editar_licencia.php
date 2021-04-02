<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{

		//id_licencia`, `cuota_anual`, `forma_pago`, `fecha_pago`, `fecha_inicio`, `fecha_final`, `id_persona`, `id_anuncio` 
		//licencia_anuncios

		$alert='';
		if(empty($_POST['cuota_anual']) || empty($_POST['forma_pago']) || empty($_POST['fecha_pago']) || empty($_POST['fecha_inicio'])  || empty($_POST['fecha_final'])  || empty($_POST['id_persona'])  || empty($_POST['id_anuncio']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_licencia= $_POST['id_licencia'];
			$cuota_anual= $_POST['cuota_anual'];
			$forma_pago= $_POST['forma_pago'];
			$fecha_pago= $_POST['fecha_pago'];	
			$fecha_inicio= $_POST['fecha_inicio'];
			$fecha_final= $_POST['fecha_final'];
			$id_persona= $_POST['id_persona'];
			$id_anuncio= $_POST['id_anuncio'];
			
			$query= mysqli_query($conection, "select * from licencia_anuncios where id_licencia = '$id_licencia'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">Licencia ya existe</p>';	
			}else{
					if(empty($_POST['id_licencia'])){
						$sql_update= mysqli_query($conection,"UPDATE licencia_anuncios SET cuota_anual='$cuota_anual', forma_pago='$forma_pago', fecha_pago='$fecha_pago', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio' WHERE id_licencia='$id_licencia'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE licencia_anuncios SET cuota_anual='$cuota_anual', forma_pago='$forma_pago',fecha_pago='$fecha_pago', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio' WHERE id_licencia='$id_licencia'");
					}

					

				if($sql_update){
					$alert='<p class="msg_save">Licencia actualizada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la licenca</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_licencia.php');
			mysqli_close($conection);
	}
		$id_licencia= $_GET['id'];
		$query= mysqli_query($conection,"select l.id_licencia, p.nombre_responsable, p.nombre_comercial, a.ubicacion, l.cuota_anual, l.forma_pago, l.fecha_pago, l.fecha_inicio, l.fecha_final, l.id_persona, l.id_anuncio from anuncios a inner join licencia_anuncios l on a.id_anuncio = l.id_anuncio inner join personas p on l.id_persona = p.id_persona WHERE id_licencia=$id_licencia");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_licencia.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_licencia= $data['id_licencia'];
				$nombre_responsable= $data['nombre_responsable'];
				$nombre_comercial= $data['nombre_comercial'];
				$ubicacion= $data['ubicacion'];
				$cuota_anual= $data['cuota_anual'];
				$forma_pago= $data['forma_pago'];
				$fecha_pago= $data['fecha_pago'];	
				$fecha_inicio= $data['fecha_inicio'];
				$fecha_final= $data['fecha_final'];
				$id_persona= $data['id_persona'];
				$id_anuncio= $data['id_anuncio'];
			}	
		}
	
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Licencia de anuncio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar Licencia de anuncio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_licencia" value="<?php echo $id_licencia; ?>">
    	<label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
        $query_persona= mysqli_query($conection, "select * from personas order by id_persona asc");
            mysqli_close($conection);
        $result_persona= mysqli_num_rows($query_persona);

        ?>
        <select name="id_persona" id="id_persona">
        	<option value="<?php echo $id_persona; ?>" selected><?php echo "$nombre_responsable - $nombre_comercial"; ?></option> 
            <?php
                if ($result_persona > 0)
                {
            
                   while($id_persona= mysqli_fetch_array($query_persona)) {
            ?>
            <option value="<?php echo $id_persona['id_persona']; ?>"><?php echo $id_persona['nombre_responsable'], " - ", $id_persona['nombre_comercial']?></option>
            <?php
                    }
                }
            
        ?>
        </select>
        <label for="id_anuncio">Ubicación de anuncio</label>
        <?php include "conexion.php";
        $query_anuncio= mysqli_query($conection, "select * from anuncios order by ubicacion");
            mysqli_close($conection);
        $result_anuncio= mysqli_num_rows($query_anuncio);
        ?>
        <select name="id_anuncio" id="id_anuncio"> 
        	<option value="<?php echo $id_persona; ?>" selected><?php echo $ubicacion; ?></option> 
            <?php
                if ($result_anuncio > 0)
                {
                   while($id_anuncio= mysqli_fetch_array($query_anuncio)) {
            ?>
            <option value="<?php echo $id_anuncio['id_anuncio']; ?>"><?php echo $id_anuncio['ubicacion'] ?></option>
            <?php
                    }
                }
            
        ?>
          </select>  
    	<label for="cuota_anual">Cuota anual</label>
        <input type="text" name="cuota_anual" id="cuota_anual" placeholder="Couta anual*" value="<?php echo $cuota_anual; ?>">
    	<label for="forma_pago">Forma de pago</label>
        <input type="text" name="forma_pago" id="forma_pago" placeholder="Forma de pago" value="<?php echo $forma_pago; ?>">
    	<label for="fecha_pago">Fecha de pago</label>
        <input type="date" name="fecha_pago" id="fecha_pago" placeholder="Calle del anuncio(entre)" value="<?php echo $fecha_pago; ?>">
        <label for="fecha_inicio">Fecha de inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de inicio" value="<?php echo $fecha_inicio; ?>">
        <label for="fecha_final">Fecha de final</label>
        <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha de final" value="<?php echo $fecha_final; ?>">
        
        <input type="submit" value="Actualizar licencia" class="btn_save">
                
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