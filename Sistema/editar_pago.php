<?php
session_start();
//id_pago, concepto, importe, fecha 

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_pago'])|| empty($_POST['concepto']) || empty($_POST['importe']) || empty($_POST['fecha']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			$id_pago= $_POST['id_pago'];
			$concepto= $_POST['concepto'];
			$importe= $_POST['importe'];	
			$fecha= $_POST['fecha'];
			
			$query= mysqli_query($conection, "select * from ordenes_pago where id_pago = '$id_pago'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El pago ya existe</p>';	
			}else{
					if(empty($_POST['clave'])){
						$sql_update= mysqli_query($conection,"UPDATE ordenes_pago
															set id_pago='$id_pago',concepto='$concepto', importe='$importe', fecha='$fecha'
															where id_pago='$idPago'");
					
					}else{
						$sql_update= mysqli_query($conection,"UPDATE ordenes_pago
															set id_pago='$id_pago',concepto='$concepto', importe='$importe', fecha='$fecha'
															where id_pago='$idPago'");

				if($sql_update){
					$alert='<p class="msg_save">Pago actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el pago</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_pago.php');
			mysqli_close($conection);
	}
		$id_pago= $_GET['id'];
		$query= mysqli_query($conection,"SELECT id_pago, concepto, importe, fecha from ordenes_pago WHERE id_pago=$id_pago");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_pago.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_pago= $data['id_pago'];
				$concepto= $data['concepto'];
				$importe= $data['importe'];	
				$fecha= $data['fecha'];				
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar pago</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar pago</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="idPago" value="<?php echo $id_pago; ?>"> 	
        <label for="concepto">Concepto</label>
        <input type="text" name="concepto" id="concepto" placeholder="Concepto" value="<?php echo $concepto; ?>">
        <label for="importe">Importe</label>
        <input type="number" name="importe" id="importe" placeholder="Importe" value="<?php echo $importe; ?>">
        <label for="fecha">Fecha</label>
        <input type="text" name="fecha" id="fecha" placeholder="Fecha" value="<?php echo $fecha; ?>">
        
        <input type="submit" value="Actualizar pago" class="btn_save">
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