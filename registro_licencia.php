<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['cuota_anual'])  || empty($_POST['forma_pago']) || empty($_POST['fecha_pago']) || empty($_POST['fecha_inicio'])|| empty($_POST['fecha_final']) | empty($_POST['id_persona'])|| empty($_POST['id_anuncio']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$cuota_anual= $_POST['cuota_anual'];
			$forma_pago= $_POST['forma_pago'];	
			$fecha_pago= $_POST['fecha_pago'];
			$fecha_inicio= $_POST['fecha_inicio'];
			$fecha_final= $_POST['fecha_final'];
			$id_persona= $_POST['id_persona'];
			$id_anuncio= $_POST['id_anuncio'];
			
			//echo " ";
			$query= mysqli_query($conection, "select * from licencia_anuncios where fecha_pago = '$fecha_pago' and id_anuncio = '$id_anuncio'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">Licencia ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"insert into 
				licencia_anuncios (cuota_anual, forma_pago, fecha_pago, fecha_inicio, fecha_final, id_persona, id_anuncio)
				values ('$cuota_anual', '$forma_pago', '$fecha_pago', '$fecha_inicio', '$fecha_final', '$id_persona', '$id_anuncio')");
				if($query_insert){
					$alert='<p class="msg_save">Licencia registrada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar licencia</p>';
                     }	
			}
			header('location:lista_licencia.php');
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de licencia</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">
	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro licencia</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
		$query_persona= mysqli_query($conection, "select * from personas order by id_persona asc");
			mysqli_close($conection);
		$result_persona= mysqli_num_rows($query_persona);

		?>
        <select name="id_persona" id="id_persona"> 
			<?php
                if ($result_persona > 0)
                {
            
                   while($id_persona= mysqli_fetch_array($query_persona)) {
			?>
            <option value="<?php echo $id_persona['id_persona']; ?>"><?php echo $id_persona['nombre_responsable'] ?></option>
            <?php
					}
                }
            
        ?>
        <p>Esto es para que se muestren correctamente los list</p>
    	<input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <label for="id_anuncio">Ubicación de anuncio</label>
        <?php include "conexion.php";
		$query_anuncio= mysqli_query($conection, "select * from anuncios order by id_anuncio asc");
			mysqli_close($conection);
		$result_anuncio= mysqli_num_rows($query_anuncio);
		?>
        <select name="id_anuncio" id="id_anuncio"> 
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
        <input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <label for="cuota_anual">Cuota anual</label>
        <input type="text" name="cuota anual" id="cuota_anual" placeholder="Cuota anual">
        <label for="forma_pago">Forma pago</label>
        <input type="text" name="forma_pago" id="forma_pago" placeholder="Forma pago"> 
        <label for="fecha_pago">Fecha pago de licencia</label>
        <input type="date" name="fecha_pago" id="fecha_pago" placeholder="Fecha pago">
        <label for="fecha_inicio">Fecha inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha inicio"> 
        <label for="fecha_final">Fecha final</label>
        <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha final">       
           
        <input type="submit" value="Crear licencia" class="btn_save">
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