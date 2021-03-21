<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['calle1']) || empty($_POST['numero_exterior']) || empty($_POST['tipo']) || empty($_POST['codigo_postal'])|| empty($_POST['ciudad']) || empty($_POST['predio_superficie']) || empty($_POST['clave_catastral']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{	
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
			
			$query= mysqli_query($conection, "select * from domicilios_personas where clave_catastral='$clave_catastral'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El domicilio con esta "Clave Catastral" ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"INSERT into 
				domicilios_personas (calle1, numero_exterior, numero_interior, tipo, codigo_postal, ciudad, estado, predio_superficie, clave_catastral, calle_norte, calle_sur, calle_este, calle_oeste)
				values ('$calle1', '$numero_exterior', '$numero_interior', '$tipo', '$codigo_postal', '$ciudad', '$estado', '$predio_superficie', '$clave_catastral', '$calle_norte', '$calle_sur', '$calle_este', '$calle_oeste')");

				if($query_insert){
					$alert='<p class="msg_save">Domicilio registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar domicilio</p>';
                                        echo "_Calle1:$calle1 _Numero_exterior:$numero_exterior _Numero_interior:$numero_interior _Tipo:$tipo _Codigo_postal:$codigo_postal _Ciudad:$ciudad _Estado:$estado _Predio_superficie:$predio_superficie _clave_catastral:$clave_catastral _Calle_norte:$calle_norte _Calle_sur:$calle_sur _Calle_este:$calle_este _Calle_oeste:$calle_oeste";
					}	
			}
			header('location:lista_domicilio.php');
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Domicilios</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-address-book"></i> Registro Domicilios</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="calle1">Calle*</label>
        <input type="text" name="calle1" id="calle1" placeholder="Calle">
        <label for="numero_exterior">No. exterior*</label>
        <input type="text" name="numero_exterior" id="numero_exterior" placeholder="No. exterior">
        <label for="numero_interior">No. interior</label>
        <input type="text" name="numero_interior" id="numero_interior" placeholder="No. interior">
        <label for="tipo">Tipo*</label>        
        <select type="text" name="tipo" id="tipo" placeholder="Tipo">
		    <option>Urbana</option>
		    <option>Rural</option>	
		    <option>Otro</option>		     
		</select> 
        <label for="codigo_postal">Codigo postal*</label>
        <input type="text" name="codigo_postal" id="codigo_postal" placeholder="Codigo postal">
        <label for="ciudad">Ciudad*</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad">
        <label for="estado">Estado*</label>
        <input type="text" name="estado" id="estado" placeholder="Estado"> 
        <label for="predio_superficie">Superficie*</label>
        <input type="number" step="0.001" name="predio_superficie" id="predio_superficie" placeholder="Predio superficie"> 
        <label for="clave_catastral">Clave catastral*</label>
        <input type="text" name="clave_catastral" id="clave_catastral" placeholder="Clave catastral"> 
        <label for="calle_norte">Calle norte</label>
        <input type="text" name="calle_norte" id="calle_norte" placeholder="Calle norte"> 
        <label for="calle_sur">Calle sur</label>
        <input type="text" name="calle_sur" id="calle_sur" placeholder="Calle sur"> 
        <label for="calle_este">Calle este</label>
        <input type="text" name="calle_este" id="calle_este" placeholder="Calle este"> 
        <label for="calle_oeste">Calle oeste</label>
        <input type="text" name="calle_oeste" id="calle_oeste" placeholder="Calle oeste"> 
   
        <input type="submit" value="Crear domicilio" class="btn_save">
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