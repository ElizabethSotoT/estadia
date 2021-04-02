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
			$fecha_inicio= $_POST['fecha_inicio'];
			$fecha_final= $_POST['fecha_final'];	
			$id_persona= $_POST['id_persona'];
			$id_anuncio= $_POST['id_anuncio'];
			
						
				$query_insert= mysqli_query($conection,"INSERT INTO 
				cotizaciones_anuncio (fecha_inicio, fecha_final, id_persona, id_anuncio)
				values ('$fecha_inicio', '$fecha_final', '$id_persona', '$id_anuncio')");
				if($query_insert){
					$alert='<p class="msg_save">Cotización registrada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar cotización</p>';
                                        echo "_Fecha_inicio:$fecha_inicio _Fecha_final:$fecha_final _Id_persona:$id_persona _Id_anuncio:$id_anuncio";
					}	
			}
			header('location:lista_cotizacion.php');
			mysqli_close($conection);	
			
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de cotización</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro de cotización</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">

        <label for="fecha_inicio" >Fecha de inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de inicio">
        <label for="fecha_final" >Fecha de final</label>
        <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha de final">
        <label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
        $query_persona= mysqli_query($conection, "select * from personas order by id_persona asc");
            mysqli_close($conection);
        $result_persona= mysqli_num_rows($query_persona);

        ?>
        <select name="id_persona" id="id_persona"> 
        	<option value="0">Seleccionar persona</option>
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
        <input type="hidden">
        <input type="hidden">  
        <input type="hidden">
        <label for="id_anuncio">Ubicación de anuncio</label>
        <?php include "conexion.php";
        $query_anuncio= mysqli_query($conection, "select * from anuncios order by id_anuncio asc");
            mysqli_close($conection);
        $result_anuncio= mysqli_num_rows($query_anuncio);
        ?>
        <select name="id_anuncio" id="id_anuncio"> 
        	<option value="0">Seleccionar anuncio</option>
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
        
        <input type="submit" value="Crear predio" class="btn_save">
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