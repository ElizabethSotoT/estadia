<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if((empty($_POST['concepto']) || empty($_POST['importe'])))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			
			$concepto= $_POST['concepto'];
			$importe= $_POST['importe'];
			
			$query= mysqli_query($conection, "select * from ordenes_pago where concepto = '$concepto'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">El pago ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"INSERT into 
				ordenes_pago (concepto, importe)
				values ('$concepto', '$importe')");
				if($query_insert){
					$alert='<p class="msg_save">Orden de pago registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar la orden de pago</p>';
                                        echo "_importe:$importe _fecha:$fecha";
					}	
			}
			header('location:lista_pago.php');
			mysqli_close($conection);	
		}	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Orden de pago</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">


	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro pago</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="concepto">Concepto</label>
        <input type="text" name="concepto" id="concepto" placeholder="Concepto">
        <label for="importe">Importe</label>
        <input type="number" name="importe" id="importe" placeholder="Importe">
        <label for="fecha">Fecha</label>
        <input type="text" name="fecha" id="fecha" placeholder="Fecha">
                
        <input type="submit" value="Crear orden de pago" class="btn_save">
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