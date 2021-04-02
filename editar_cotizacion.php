<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['fecha_inicio'])|| empty($_POST['fecha_final']) || empty($_POST['id_persona']) || empty($_POST['id_anuncio']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_cotizacion= $_POST['id_cotizacion'];
			$fecha_inicio= $_POST['fecha_inicio'];
			$fecha_final= $_POST['fecha_final'];	
			$id_persona= $_POST['id_persona'];
			$id_anuncio= $_POST['id_anuncio'];


			if(empty($_POST['id_cotizacion'])){
						$sql_update= mysqli_query($conection,"UPDATE cotizaciones_anuncio
															SET fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio'
															WHERE id_cotizacion='$id_cotizacion'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE cotizaciones_anuncio
															SET fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio'
															WHERE id_cotizacion='$id_cotizacion'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Cotización actualizada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la cotización</p>';
					}	
				
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_cotizacion.php');
			mysqli_close($conection);
	}
		$id_cotizacion= $_GET['id'];
		$query= mysqli_query($conection,"select c.id_cotizacion, c.fecha_inicio, c.fecha_final, c.id_persona, c.id_anuncio, p.nombre_responsable, p.nombre_comercial, a.ubicacion FROM personas p INNER JOIN cotizaciones_anuncio c on p.id_persona = c.id_persona INNER JOIN anuncios a on a.id_anuncio=c.id_anuncio WHERE c.id_cotizacion=$id_cotizacion");

			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_cotizacion.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_cotizacion= $data['id_cotizacion'];
				$fecha_inicio= $data['fecha_inicio'];
				$fecha_final= $data['fecha_final'];	
				$id_persona= $data['id_persona'];
				$id_anuncio= $data['id_anuncio'];
				$nombre_responsable= $data['nombre_responsable'];
				$nombre_comercial= $data['nombre_comercial'];
				$ubicacion= $data['ubicacion'];
				
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar cotización</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar cotización</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_cotizacion" value="<?php echo $id_cotizacion; ?>">
    	<label for="fecha_inicio" >Fecha de inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de inicio" value="<?php echo $fecha_inicio; ?>">
        <label for="fecha_final" >Fecha de final</label>
        <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha de final" value="<?php echo $fecha_final; ?>">
        <label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
        $query_persona= mysqli_query($conection, "select * from personas order by id_persona");
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
            <option value="<?php echo $id_persona['id_persona']; ?>"><?php echo $id_persona['nombre_responsable'], " - ", $id_persona['nombre_comercial'] ?></option>
            <?php
                    }
                }
            
        ?>
        
        </select>
       
        <label for="id_anuncio">Ubicación de anuncio</label>
        <?php include "conexion.php";
        $query_anuncio= mysqli_query($conection, "select * from anuncios order by id_anuncio");
            mysqli_close($conection);
        $result_anuncio= mysqli_num_rows($query_anuncio);
        ?>
        <select name="id_anuncio" id="id_anuncio"> 
        	<option value="<?php echo $id_anuncio; ?>" selected><?php echo $id_anuncio, " - ", $ubicacion ?></option>
            <?php
                if ($result_anuncio > 0)
                {
                   while($id_anuncio= mysqli_fetch_array($query_anuncio)) {
            ?>
            <option value="<?php echo $id_anuncio['id_anuncio']; ?>"><?php echo $id_anuncio['id_anuncio'], " - ", $id_anuncio['ubicacion'] ?></option>
            <?php

            
                    }
                }
            
        ?>
        <input type="submit" value="Actualizar predio" class="btn_save">
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