<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['clave_catastral']) || empty($_POST['calle1']) || empty($_POST['manzana']) || empty($_POST['zona'])  || empty($_POST['tipo_anuncio'])  || empty($_POST['medida1'])  || empty($_POST['medida2']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_anuncio= $_POST['id_anuncio'];
			$clave_catastral= $_POST['clave_catastral'];
			$calle1= $_POST['calle1'];
			$calle2= $_POST['calle2'];	
			$manzana= $_POST['manzana'];
			$zona= $_POST['zona'];
			$tipo_anuncio= $_POST['tipo_anuncio'];
			$medida1= $_POST['medida1'];
			$medida2= $_POST['medida2'];
			$salarios_minimo= $_POST['salarios_minimo'];
			$cantidad= $_POST['cantidad'];

			$query= mysqli_query($conection, "select * from anuncios where clave_catastral = '$clave_catastral'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">La clave de anuncio ya existe</p>';	
			}else{
					if(empty($_POST['clave'])){
						$sql_update= mysqli_query($conection,"update anuncios
															set clave_catastral='$clave_catastral', calle1='$calle1',calle2='$calle2', manzana='$manzana', zona='$zona', tipo_anuncio='$tipo_anuncio', medida1='$medida1', medida2='$medida2', salarios_minimo='$salarios_minimo', cantidad='$cantidad'
															where id_anuncio='$id_anuncio'");
					
					}else{
						$sql_update= mysqli_query($conection,"update anuncios
															set clave_catastral='$clave_catastral', calle1='$calle1',calle2='$calle2', manzana='$manzana', zona='$zona', tipo_anuncio='$tipo_anuncio', medida1='$medida1', medida2='$medida2', salarios_minimo='$salarios_minimo', cantidad='$cantidad'
															where id_anuncio='$id_anuncio'");
					}

					

				if($sql_update){
					$alert='<p class="msg_save">Anuncio actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el anuncio</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_anuncio.php');
			mysqli_close($conection);
	}
		$id_anuncio= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_anuncio, clave_catastral, calle1, calle2, manzana, zona, tipo_anuncio, medida1, medida2, salarios_minimo, cantidad from anuncios WHERE id_anuncio=$id_anuncio");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_anuncio.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_anuncio= $data['id_anuncio'];
				$clave_catastral= $data['clave_catastral'];
				$calle1= $data['calle1'];
				$calle2= $data['calle2'];	
				$manzana= $data['manzana'];
				$zona= $data['zona'];
				$tipo_anuncio= $data['tipo_anuncio'];
				$medida1= $data['medida1'];
				$medida2= $data['medida2'];
				$salarios_minimo= $data['salarios_minimo'];
				$cantidad= $data['cantidad'];
			}	
		}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Anuncio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar anuncio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_anuncio" value="<?php echo $id_anuncio; ?>">
    	<label for="clave_catastral">Clave Catastral</label>
        <input type="text" name="clave_catastral" id="clave_catastral" placeholder="Clave Catastral*" value="<?php echo $clave_catastral; ?>">
    	<label for="calle1">Calle</label>
        <input type="text" name="calle1" id="calle1" placeholder="Calle del anuncio*" value="<?php echo $calle1; ?>">
    	<label for="calle1">Calle</label>
        <input type="text" name="calle2" id="calle2" placeholder="Calle del anuncio(entre)" value="<?php echo $calle2; ?>">
        <label for="manzana">Manzana</label>
        <input type="text" name="manzana" id="manzana" placeholder="No. de manzana" value="<?php echo $manzana; ?>">
        <label for="zona">Zona*</label>   
        <select type="text" name="zona" id="zona" value="<?php echo $zona; ?>">>
		    <option>Urbana</option>
		    <option>Rural</option>	
		    <option>Otro</option>		     
		</select>  
        <label for="tipo_anuncio">Tipo*</label>        
        <select type="text" name="tipo_anuncio" id="tipo_anuncio" value="<?php echo $tipo; ?>">
        	<option>Espectacular</option>
        	<option>Balcón</option>
		    <option>Luminoso</option>
		    <option>Muro</option>
		    <option>Pantalla fija</option>	
		    <option>Pantalla movil</option>
		    <option>Otro</option>		     
		</select> 
        <label for="medida1">Medida*</label>
        <input type="number" name="medida1" id="medida1" placeholder="Medida No.1" value="<?php echo $medida1; ?>">
        <label for="medida2">Medida*</label>
        <input type="number" name="medida2" id="medida2" placeholder="Medida No.2" value="<?php echo $medida2; ?>">
        <label for="salarios_minimo">Salarios minimos*</label>
        <input type="number" name="salarios_minimo" id="salarios_minimo" placeholder="Salarios minimos" value="<?php echo $salarios_minimo; ?>">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php echo $cantidad; ?>">
           
        <input type="submit" value="Actualizar anuncio" class="btn_save">
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