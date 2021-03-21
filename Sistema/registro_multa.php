<?php
session_start();
//SELECT `id_multa`, `fecha`, `fecha_requerimiento`, `id_requerimiento` FROM `multas_anuncios` WHERE 1

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_requerimiento']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			date_default_timezone_set('America/Mexico_City');
			$fecha=date("Y-m-d H-i-s");	
			$id_requerimiento= $_POST['id_requerimiento'];
			
			$query= mysqli_query($conection, "select * from multas_anuncios where id_requerimiento = '$id_requerimiento'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">La multa ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"INSERT INTO 
				multas_anuncios (fecha, id_requerimiento)
				values ('$fecha', '$id_requerimiento')");
				if($query_insert){
					$alert='<p class="msg_save">Multa registrada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar multa</p>';
                                        echo "_Fecha:$fecha _Id_requerimiento:$id_requerimiento";
					}	
			}
			
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de multa</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro multa</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
        <label for="id_requerimiento">Requerimiento</label>
        <input type="text" name="id_requerimiento" id="id_requerimiento" placeholder="Requerimiento">         

        
        <input type="submit" value="Crear multa" class="btn_save">
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