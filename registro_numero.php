<?php
session_start();
/*if($_SESSION['rol']!=4)
	{
		header("location: ./");
		
	}
*/
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['folio'])|| empty($_POST['clave']) || empty($_POST['numero1']) || empty($_POST['numero2'])|| empty($_POST['orden'])|| empty($_POST['costo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$folio= $_POST['folio'];
			$clave= $_POST['clave'];
			$ultima_palabra = strrpos($clave, ' ') + 1; // +1 para no incluir el espacio en el resultado
			$clave2 = substr($clave, $ultima_palabra); // 
//			print_r($clave2);
			$numero1= $_POST['numero1'];
			$numero2= $_POST['numero2'];
			$orden= $_POST['orden'];
			$costo= $_POST['costo'];
			$fecha1= $_POST['fecha1'];
			$fecha2= $_POST['fecha2'];
			$fecha3= $_POST['fecha3'];
			$estatus= $_POST['estatus'];

			$query= mysqli_query($conection, "select * from numero_oficial where folio = '$folio'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El folio del número ya existe</p>';	
			}else{
				
				$sql= mysqli_query($conection,"insert into 
				numero_oficial (folio, id_predio, numero1, numero2, orden_p, fecha1, fecha2, fecha3, costo, estatus, usuario_id)
				values ('$folio', '$clave2', '$numero1', '$numero2', '$orden', '$fecha1', '$fecha2', '$fecha3', '$costo', '$estatus', '4')");
				
				//codigo para guardar pdf
				$resultado = mysqli_query($conection,$sql);
				$id_insert = mysqli_insert_id($conection);

				if($_FILES["archivo"]["error"]>0){
					echo "Error al cargar archivo";
				} else{
					$permitidos = array("application/pdf");
					$limite_kb = 500;

					if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

						$ruta = 'files/'.$id_insert.'/';
						$archivo = $ruta.$_FILES["archivo"]["name"];

						//si no existe carpeta, la crea
						if(!file_exists($ruta)){
							mkdir($ruta);
						}

						if(!file_exists($archivo)){
							$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

							if($resultado){
								echo "Archivo guardado";
							} else{
								echo "Error al guardar archivo";
							}
						} else {
							echo "Archivo ya existe";
						}
					}

				}

				$sql2 = mysqli_query($conection, "UPDATE numero_oficial SET urlfile ='$archivo' where id_numero = '$id_insert'");
				
				if($sql){
					$alert='<p class="msg_save">No. Oficial registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar el No. Oficial</p>';
					}	
			}
			
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Núm. Oficial</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-dice-five"></i> Registro Núm. Oficial</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="POST" enctype="multipart/form-data">
    	<label for="folio">Folio</label>
        <input type="text" name="folio" id="folio" placeholder="Folio del No. Oficial">
    	<label for="clave">Predio</label>
        <input type="text" name="clave" id="clave" class="form-control" placeholder="Ingresa la clave del predio"/>  
        <div id="claveList"></div> 
        <label for="numero1">Número</label>
        <input type="text" name="numero1" id="numero1" placeholder="Número asignado">
        <label for="numero2">Número (texto)</label>
        <input type="text" name="numero2" id="numero2" placeholder="Número asignado en texto"> 
        <label for="orden">Orden de pago</label>
        <input type="text" name="orden" id="orden" placeholder="Orden de pago"> 
        <label for="costo">Costo del trámite</label>
        <input type="number" name="costo" id="costo" step="0.001">
        <label for="fecha1">Fecha de ingreso (aaaa-mm-dd)</label>
        <input type="date" name="fecha1" id="fecha1" placeholder="Fecha de ingreso">
        <label for="fecha2">Fecha de elaboracion (aaaa-mm-dd)</label>
        <input type="date" name="fecha2" id="fecha2" placeholder="Fecha de elaboración">
        <label for="fecha3">Fecha de entrega (aaaa-mm-dd)</label>
        <input type="date" name="fecha3" id="fecha3" placeholder="Fecha de entrega">
        <label for="estatus">Estatus del tramite</label> 
      	 <select name="estatus">
       		<option>Recibido</option>
      	    <option>Procesado</option>
       	    <option>Firmado</option>
       	    <option>Entregado</option>
         </select>
         <!--Form para subir pdf 12/Enero/2021-->
           	<div>    	
	    		<label for="archivo">Subir archivo</label>
	        	<input type="file" id="archivo" name="archivo" accept="application/pdf"/>
	    	</div>		 		

        <input type="submit" value="Crear Número Oficial" class="btn_save">        
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

<script>
 $(document).ready(function(){
      $('#clave').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  {  
                $.ajax({  
                     url:"buscar.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                        $('#claveList').fadeIn();  
                        $('#claveList').html(data);  
                     } 
                });  
           }
      });  
      $(document).on('click', 'li', function(){  
           $('#clave').val($(this).text()); 
           $('#claveList').fadeOut();  
          
      });  
 });  
 </script> 
