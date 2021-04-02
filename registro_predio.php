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

			$clave= $_POST['clave'];
			$manzana= $_POST['manzana'];	
			$lote= $_POST['lote'];
			$superficie= $_POST['superficie'];
			$propietario= $_POST['propietario'];
			$calle1= $_POST['calle1'];
			$numero1= $_POST['numero1'];
			$rol= $_POST['rol'];
			
			$query= mysqli_query($conection, "select * from predios where clave = '$clave'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">La clave de predio ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"insert into 
				predios (clave, manzana, lote, superficie, propietario, calle1, numero1, id_colonia, usuario_id)
				values ('$clave', '$manzana', '$lote', '$superficie', '$propietario', '$calle1', '$numero1', '$rol', '$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Predio registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar el predio</p>';
                                        echo "_clave:$clave _manzana:$manzana _Lote:$lote _Superficie:$superficie _Calle:$calle1 _Numero:$numero1 _Rol:$rol _Usuario:$usuario_id";
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
	<title>Registro de Predio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro Predio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<label for="clave">Clave</label>
        <input type="text" name="clave" id="clave" placeholder="Clave predial">
        <label for="manzana">Manzana</label>
        <input type="text" name="manzana" id="manzana" placeholder="No. de manzana">
        <label for="lote">Lote</label>
        <input type="text" name="lote" id="lote" placeholder="No. de lote">
        <label for="superficie">Superficie</label>
        <input type="number" step="0.001" name="superficie" id="superficie" placeholder="Superficie del predio"> 
        <label for="propietario">Propietario</label>
        <input type="text" name="propietario" id="propietario" placeholder="Nombre del propietario">
        <label for="calle1">Calle del predio</label>
        <input type="text" name="calle1" id="calle1" placeholder="Domicilio del predio, calle">
        <label for="numero1">Número</label>
        <input type="text" name="numero1" id="numero1" placeholder="Número exterior"> 
        <label for="rol">Colonia</label>
        <?php include "conexion.php";
		$query_rol= mysqli_query($conection, "select * from asentamientos order by nombre1 asc");
			mysqli_close($conection);
		$result_rol= mysqli_num_rows($query_rol);

		?>
        <select name="rol" id="rol"> 
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
            

        
        <input type="submit" value="Crear predio" class="btn_save">
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