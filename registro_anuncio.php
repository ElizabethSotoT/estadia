<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['clave_catastral']) || empty($_POST['calle1']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			$clave_catastral= $_POST['clave_catastral'];
			$calle1_2= $_POST['calle1'];
			$calle2_2= $_POST['calle2'];	
			$lote_2= $_POST['manzana'];
			$zona= $_POST['zona'];
			$tipo_anuncio= $_POST['tipo_anuncio'];
			$medida1= $_POST['medida1'];
			$medida2= $_POST['medida2'];
			$salarios_minimo= $_POST['salarios_minimo'];
			$cantidad= $_POST['cantidad'];
			$ubicacion = $calle1_2." ".$calle2_2." L".$lote_2;
			
			$query= mysqli_query($conection, "select * from anuncios where clave_catastral = '$clave_catastral'");
			//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">Este anuncio ya esta registrado</p>';	
			}
			else{		
				$query_insert= mysqli_query($conection,"insert into 
				anuncios (clave_catastral, ubicacion, zona, tipo_anuncio, medida1, medida2, salarios_minimo, cantidad) values ('$clave_catastral', '$ubicacion', '$zona', '$tipo_anuncio', '$medida1', '$medida2', '$salarios_minimo', '$cantidad')");
				if($query_insert){
					$alert='<p class="msg_save">Anuncio registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar anuncio</p>';
                                        echo "_Clave_catastral:$clave_catastral _Ubicacion:$ubicacion _Zona:$zona _Tipo_anuncio:$tipo_anuncio";
					}	
			}
			header('location:lista_anuncio.php');
			mysqli_close($conection);	
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Anuncio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro Anuncio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="clave_catastral">Clave catastral*</label>
        <input type="text" style="text-transform:uppercase" name="clave_catastral" id="clave_catastral" placeholder="Clave catastral">
    	<label for="calle1">Calle*</label>
        <input type="text" name="calle1" id="calle1" placeholder="Calle del anuncio">
        <label for="calle2">Calle</label>
        <input type="text" name="calle2" id="calle2" placeholder="Segunda referencia de calle del anuncio">
        <label for="manzana">Lote*</label>
        <input type="text" name="manzana" id="manzana" placeholder="No. de manzana">
        <label for="zona">Zona*</label>   
        <select type="text" name="zona" id="zona">
        	<option value="0">Seleccione una opción</option>
		    <option>Urbana</option>
		    <option>Rural</option>	
		    <option>Otro</option>		     
		</select>  
        <label for="tipo_anuncio">Tipo*</label>        
        <select type="text" name="tipo_anuncio" id="tipo_anuncio">
        	<option value="0">Seleccione tipo de anuncio</option>
        	<option>Espectacular</option>
        	<option>Balcón</option>
		    <option>Luminoso</option>
		    <option>Muro</option>
		    <option>Pantalla fija</option>	
		    <option>Pantalla movil</option>
		    <option>Otro</option>		     
		</select> 
        <label for="medida1">Medida*</label>
        <input step="any" type="number" min="1" name="medida1" id="medida1" placeholder="Medida No.1">
        <label for="medida2">Medida*</label>
        <input step="any" type="number" min="1" name="medida2" id="medida2" placeholder="Medida No.2">
        <label for="salarios_minimo">Salarios minimos*</label>
        <input type="number" min="1" name="salarios_minimo" id="salarios_minimo" placeholder="Salarios minimos">
        <label for="cantidad">Cantidad</label>
        <input type="number" min="1" name="cantidad" id="cantidad" placeholder="Cantidad">        
        
        <input type="submit" value="Crear anuncio" class="btn_save">
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