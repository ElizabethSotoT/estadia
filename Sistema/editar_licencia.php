<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{

		//id_licencia`, `cuota_anual`, `forma_pago`, `fecha_pago`, `fecha_inicio`, `fecha_final`, `id_persona`, `id_anuncio` 
		//licencia_anuncios

		$alert='';
		if(empty($_POST['cuota_anual']) || empty($_POST['forma_pago']) || empty($_POST['fecha_pago']) || empty($_POST['fecha_inicio'])  || empty($_POST['fecha_final'])  || empty($_POST['id_persona'])  || empty($_POST['id_anuncio']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$id_licencia= $_POST['id_licencia'];
			$cuota_anual= $_POST['cuota_anual'];
			$forma_pago= $_POST['forma_pago'];
			$fecha_pago= $_POST['fecha_pago'];	
			$fecha_inicio= $_POST['fecha_inicio'];
			$fecha_final= $_POST['fecha_final'];
			$id_persona= $_POST['id_persona'];
			$id_anuncio= $_POST['id_anuncio'];
			
			$query= mysqli_query($conection, "select * from licencia_anuncios where id_licencia = '$id_licencia'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">Licencia ya existe</p>';	
			}else{
					if(empty($_POST['id_licencia'])){
						$sql_update= mysqli_query($conection,"update licencia_anuncios
															set cuota_anual='$cuota_anual', forma_pago='$forma_pago',fecha_pago='$fecha_pago', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio'
															where id_licencia='$id_licencia'");
					
					}else{
						$sql_update= mysqli_query($conection,"update licencia_anuncios
															set cuota_anual='$cuota_anual', forma_pago='$forma_pago',fecha_pago='$fecha_pago', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', id_persona='$id_persona', id_anuncio='$id_anuncio'
															where id_licencia='$id_licencia'");
					}

					

				if($sql_update){
					$alert='<p class="msg_save">Licencia actualizada correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la licenca</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	
//Mostrar datos
	if (empty($_GET['id'])){
		header('location:lista_licencia.php');
			mysqli_close($conection);
	}
		$id_licencia= $_GET['id'];
		$query= mysqli_query($conection,"select id_licencia, cuota_anual, forma_pago, fecha_pago, fecha_inicio, fecha_final, id_persona, id_anuncio FROM licencia_anuncios WHERE id_licencia=$id_licencia");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_licencia.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$id_licencia= $data['id_licencia'];
				$cuota_anual= $data['cuota_anual'];
				$forma_pago= $data['forma_pago'];
				$fecha_pago= $data['fecha_pago'];	
				$fecha_inicio= $data['fecha_inicio'];
				$fecha_final= $data['fecha_final'];
				$id_persona= $data['id_persona'];
				$id_anuncio= $data['id_anuncio'];
			}	
		}
	
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Licencia de anuncio</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar Licencia de anuncio</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="id_licencia" value="<?php echo $id_licencia; ?>">
    	<label for="cuota_anual">Cuota anual</label>
        <input type="text" name="cuota_anual" id="cuota_anual" placeholder="Clave Catastral*" value="<?php echo $cuota_anual; ?>">
    	<label for="forma_pago">Forma de pago</label>
        <input type="text" name="forma_pago" id="forma_pago" placeholder="Forma de pago" value="<?php echo $forma_pago; ?>">
    	<label for="fecha_pago">Fecha de pago</label>
        <input type="date" name="fecha_pago" id="fecha_pago" placeholder="Calle del anuncio(entre)" value="<?php echo $fecha_pago; ?>">
        <label for="fecha_inicio">Fecha de inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de inicio" value="<?php echo $fecha_inicio; ?>">
        <label for="fecha_final">Fecha de final</label>
        <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha de final" value="<?php echo $fecha_final; ?>">
        <label for="id_persona">Nombre del responsable</label>
        <?php include "conexion.php";
        $query_persona= mysqli_query($conection, "select * from personas order by id_persona asc");
            mysqli_close($conection);
        $result_persona= mysqli_num_rows($query_persona);

        ?>
        <select name="id_persona" id="id_persona"> 
            <?php
                if ($result_persona > 0)
                {
            
                   while($id_persona= mysqli_fetch_array($query_persona)) {
            ?>
            <option value="<?php echo $id_persona['id_persona']; ?>"><?php echo $id_persona['nombre_responsable'] ?></option>
            <?php
                    }
                }
            
        ?>

        <p>Esto es para que se muestren correctamente los list</p>
        <input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <input type="hidden" placeholder="Forma de pago">
        <label for="id_anuncio">Ubicación de anuncio</label>
        <?php include "conexion.php";
        $query_anuncio= mysqli_query($conection, "select * from anuncios order by id_anuncio asc");
            mysqli_close($conection);
        $result_anuncio= mysqli_num_rows($query_anuncio);
        ?>
        <select name="id_anuncio" id="id_anuncio"> 
            <?php
                if ($result_anuncio > 0)
                {
                   while($id_anuncio= mysqli_fetch_array($query_anuncio)) {
            ?>
            <option value="<?php echo $id_anuncio['id_anuncio']; ?>"><?php echo $id_anuncio['ubicacion'] ?></option>
            <?php
                    }
                }
            
        ?>
           
        <input type="submit" value="Actualizar licencia" class="btn_save">
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