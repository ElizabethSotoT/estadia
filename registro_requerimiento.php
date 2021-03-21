<?php
session_start();
//SELECT `id_requerimiento`, `id_persona`, `fecha`, `descripcion` FROM `requerimientos_anuncios` WHERE 1

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['id_persona']) || empty($_POST['fecha']) || empty($_POST['descripcion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{

			$id_persona= $_POST['id_persona'];
			$fecha= $_POST['fecha'];	
			$descripcion= $_POST['descripcion'];
			
			$query= mysqli_query($conection, "select * from requerimientos_anuncios where descripcion='$descripcion'");
				//mysqli_close($conection);
			$result= mysqli_fetch_array($query);
			if($result > 0){
				$alert='<p class="msg_error">Requerimiento ya existe</p>';	
			}else{
				
				$query_insert= mysqli_query($conection,"INSERT into 
				requerimientos_anuncios (id_persona, fecha, descripcion)
				values ('$id_persona', '$fecha', '$descripcion')");
				if($query_insert){
					$alert='<p class="msg_save">Requerimiento registrado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al registrar el requerimiento</p>';
                                        echo "_id_requerimiento:$id_requerimiento _id_persona:$id_persona _Fecha:$fecha _Descripcion:$descripcion";
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
	<title>Registro de requerimiento</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>     
 
	<div class="articulo">

	<div class="form_register">
    <h1><i class="fas fa-draw-polygon"></i> Registro de requerimiento</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
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
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" placeholder="Fecha">
        <label for="descripcion">Descripcion</label>
        <small><i>En relacion con el problema detectado consistente en:</i></small>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">       

        
        <input type="submit" value="Crear requerimiento" class="btn_save">
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