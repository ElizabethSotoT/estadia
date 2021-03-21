<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['calle1'])|| empty($_POST['numero_exterior']) || empty($_POST['codigo_postal'])|| empty($_POST['ciudad']) || empty($_POST['predio_superficie']) || empty($_POST['clave_catastral']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{			
			$id_domicilio= $_POST['id_domicilio'];
			$calle1= $_POST['calle1'];
			$numero_exterior= $_POST['numero_exterior'];	
			$numero_interior= $_POST['numero_interior'];
			$tipo= $_POST['tipo'];
			$codigo_postal= $_POST['codigo_postal'];
			$ciudad= $_POST['ciudad'];
			$estado= $_POST['estado'];
			$predio_superficie= $_POST['predio_superficie'];
			$clave_catastral= $_POST['clave_catastral'];
			$calle_norte= $_POST['calle_norte'];
			$calle_sur= $_POST['calle_sur'];
			$calle_este= $_POST['calle_este'];
			$calle_oeste= $_POST['calle_oeste'];
			
			$query= mysqli_query($conection, "SELECT * from domicilios_personas where clave_catastral = '$clave_catastral'");
			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El domicilio con esta "Clave Catastral" ya existe</p>';	
			}else{
					if(empty($_POST['clave_catastral'])){
						$sql_update= mysqli_query($conection,"UPDATE domicilios_personas
															set id_domicilio='$id_domicilio', calle1='$calle1', numero_exterior='$numero_exterior', numero_interior='$numero_interior', tipo='$tipo', codigo_postal='$codigo_postal', ciudad='$ciudad', estado='$estado', predio_superficie='$predio_superficie', clave_catastral='$clave_catastral',calle_norte='$calle_norte', calle_sur='$calle_sur', calle_este='$calle_este', calle_oeste='$calle_oeste'
															where clave_catastral='$clave_catastral'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE domicilios_personas
															set id_domicilio='$id_domicilio', calle1='$calle1', numero_exterior='$numero_exterior', numero_interior='$numero_interior', tipo='$tipo', codigo_postal='$codigo_postal', ciudad='$ciudad', estado='$estado', predio_superficie='$predio_superficie', clave_catastral='$clave_catastral',calle_norte='$calle_norte', calle_sur='$calle_sur', calle_este='$calle_este', calle_oeste='$calle_oeste'
															where clave_catastral='$clave_catastral'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Domicilio actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar domicilio</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_domicilio.php');
			mysqli_close($conection);
	}
		$id_domicilio= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_domicilio, calle1, numero_exterior, numero_interior, tipo, codigo_postal, ciudad, estado, predio_superficie, clave_catastral, calle_norte, calle_sur, calle_este, calle_oeste from domicilios_personas
													 WHERE id_domicilio=$id_domicilio");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_domicilio.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_domicilio= $data['id_domicilio'];
				$calle1= $data['calle1'];
				$numero_exterior= $data['numero_exterior'];	
				$numero_interior= $data['numero_interior'];
				$tipo= $data['tipo'];
				$codigo_postal= $data['codigo_postal'];
				$ciudad= $data['ciudad'];
				$estado= $data['estado'];
				$predio_superficie= $data['predio_superficie'];
				$clave_catastral= $data['clave_catastral'];
				$calle_norte= $data['calle_norte'];
				$calle_sur= $data['calle_sur'];
				$calle_este= $data['calle_este'];
				$calle_oeste= $data['calle_oeste'];
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar domicilio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="far fa-address-book"></i> Actualizar domicilio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_domicilio" value="<?php echo $id_domicilio; ?>">
    	<label for="calle1">Calle </label>
        <input type="text" name="calle1" id="calle1" placeholder="Calle" value="<?php echo $calle1; ?>">
        <label for="numero_exterior">No. exterior</label>
        <input type="text" name="numero_exterior" id="numero_exterior" placeholder="No. exterior" value="<?php echo $numero_exterior; ?>">
        <label for="numero_interior">No. interior</label>
        <input type="text" name="numero_interior" id="numero_interior" placeholder="No. interior" value="<?php echo $numero_interior; ?>">
        <label for="tipo">Tipo</label>
        <select type="text" name="tipo" id="tipo" placeholder="Tipo" value="<?php echo $tipo; ?>"> >
		    <option>Urbana</option>
		    <option>Rural</option>	
		    <option>Otro</option>		     
		</select>         
        <label for="codigo_postal">Codigo postal</label>
        <input type="text" name="codigo_postal" id="codigo_postal" placeholder="Codigo postal" value="<?php echo $codigo_postal; ?>">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?php echo $ciudad; ?>">
        <label for="estado">Estado</label>
        <input type="text" name="estado" id="estado" placeholder="Estado" value="<?php echo $estado; ?>"> 
        <label for="predio_superficie">Superficie</label>
        <input type="number" step="0.001" name="predio_superficie" id="predio_superficie" placeholder="Predio superficie" value="<?php echo $predio_superficie; ?>"> 
        <label for="clave_catastral">Clave catastral</label>
        <input type="text" name="clave_catastral" id="clave_catastral" placeholder="Clave catastral" value="<?php echo $clave_catastral; ?>"> 
        <label for="calle_norte">Calle norte</label>
        <input type="text" name="calle_norte" id="calle_norte" placeholder="Calle norte" value="<?php echo $calle_norte; ?>"> 
        <label for="calle_sur">Calle sur</label>
        <input type="text" name="calle_sur" id="calle_sur" placeholder="Calle sur" value="<?php echo $calle_sur; ?>">  
        <label for="calle_este">Calle este</label>
        <input type="text" name="calle_este" id="calle_este" placeholder="Calle este" value="<?php echo $calle_este; ?>"> 
        <label for="calle_oeste">Calle oeste</label>
        <input type="text" name="calle_oeste" id="calle_oeste" placeholder="Calle oeste" value="<?php echo $calle_oeste; ?>"> 

        <input type="submit" value="Actualizar domicilio" class="btn_save">
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