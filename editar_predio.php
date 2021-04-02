<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['superficie'])|| empty($_POST['propietario']) || empty($_POST['calle1']) || empty($_POST['numero1'])|| empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$idPredio= $_POST['idpredio'];
			$clave= $_POST['clave'];
			$manzana= $_POST['manzana'];	
			$lote= $_POST['lote'];
			$superficie= $_POST['superficie'];
			$propietario= $_POST['propietario'];
			$calle1= $_POST['calle1'];
			$numero1= $_POST['numero1'];
			$rol= $_POST['rol'];


			$query1= mysqli_query($conection, "select * from predios where clave = '$clave'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">La clave de predio ya existe</p>';	
			}else{
					if(empty($_POST['clave'])){
						$sql_update= mysqli_query($conection,"update predios
															set manzana='$manzana',lote='$lote', superficie='$superficie', propietario='$propietario', calle1='$calle1', numero1='$numero1',id_colonia='$rol'
															where id_predio='$idPredio'");
					
					}else{
						$sql_update= mysqli_query($conection,"update predios
													set clave='$clave', manzana='$manzana',lote='$lote', superficie='$superficie', propietario='$propietario', calle1='$calle1', numero1='$numero1',id_colonia='$rol' 							
															where id_predio='$idPredio'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Predio actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el predio</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_predio.php');
			mysqli_close($conection);
	}
		$id_predio= $_GET['id'];
		$query= mysqli_query($conection,"select p.id_predio, p.clave, p.manzana,p.lote, p.superficie, p.propietario, p.calle1, 
															p.numero1, a.nombre, a.id_asent 
													 from predios p inner join asentamientos a on p.id_colonia= a.id_asent 
													 WHERE id_predio=$id_predio and estatus=1" );
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_predio.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$idpred= $data['id_predio'];
				$clave= $data['clave'];
				$manzana= $data['manzana'];	
				$lote= $data['lote'];
				$superficie= $data['superficie'];
				$propietario= $data['propietario'];
				$calle1= $data['calle1'];
				$numero1= $data['numero1'];
				$idcolonia= $data['id_asent'];
				$colonia= $data['nombre'];
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Predio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar predio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="idpredio" value="<?php echo $idpred; ?>">
    	<label for="clave">Clave de predio</label>
        <input type="text" name="clave" id="clave" placeholder="Clave del predio" value="<?php echo $clave; ?>">
        <label for="manzana">No. de manzana</label>
        <input type="text" name="manzana" id="manzana" placeholder="No. de manzana" value="<?php echo $manzana; ?>">
        <label for="lote">No. de lote</label>
        <input type="text" name="lote" id="lote" placeholder="No. de lote" value="<?php echo $lote; ?>">
        <label for="superficie">Superficie</label>
        <input type="number" step="0.001" name="superficie" id="superficie" placeholder="Superficie del predio" value="<?php echo $superficie; ?>"> 
        <label for="propietario">Propietario</label>
        <input type="text" name="propietario" id="propietario" placeholder="Nombre del propietario" value="<?php echo $propietario; ?>">
        <label for="calle1">Calle del predio</label>
        <input type="calle1" name="calle1" id="calle1" placeholder="Domicilio del predio, calle" value="<?php echo $calle1; ?>">
        <label for="numero1">Número</label>
        <input type="text" name="numero1" id="numero1" placeholder="Número exterior" value="<?php echo $numero1; ?>"> 
        <label for="colonia">Colonia</label>
        <?php include "conexion.php";
		$query_rol= mysqli_query($conection, "select * from asentamientos order by nombre1");
			mysqli_close($conection);
		$result_rol= mysqli_num_rows($query_rol);

		?>
        <select name="rol" id="rol"> 
        <option value="<?php echo $idcolonia; ?>" selected><?php echo $colonia; ?></option>
			<?php
                if ($result_rol > 0)
                {
            
                   while($rol= mysqli_fetch_array($query_rol)) {
			?>
            <option value="<?php echo $rol['id_asent']; ?>"><?php echo $rol['nombre'] ?></option>
            <?php
					}
                }
            
            ?>
        <input type="submit" value="Actualizar predio" class="btn_save">
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