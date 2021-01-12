<?php
session_start();

	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['folio'])|| empty($_POST['predio']) || empty($_POST['numero1']) || empty($_POST['numero2'])|| empty($_POST['orden'])|| empty($_POST['costo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		} else{
			$idNum= $_POST['id_numero'];
			$folio= $_POST['folio'];
			$predio= $_POST['predio'];	
			$numero1= $_POST['numero1'];
			$numero2= $_POST['numero2'];
			$orden= $_POST['orden_p'];			
			$estatus= $_POST['estatus'];
			//$usuario_id=$_SESSION['idUser'];
			//$dateadd=$_POST['date'];
			$costo= $_POST['costo'];
			$fecha1= $_POST['fecha1'];
			$fecha2= $_POST['fecha2'];
			$fecha3= $_POST['fecha3'];

			
			$query= mysqli_query($conection, "select * from numero_oficial where folio = '$folio'");

			$result1= mysqli_num_rows($query1);

			if($result1 > 0){
				$alert='<p class="msg_error">El folio del número ya existe</p>';	
			}else{
					if(empty($_POST['folio'])){
						$sql_update= mysqli_query($conection,"update numero_oficial
															set numero1='$numero1',numero2='$numero2', orden_p='$orden', estatus='$estatus', costo='$costo', fecha1='$fecha1',fecha2='$fecha2', fecha3='$fecha3'
															where id_numero='$idNumero'");
					
					}else{
						$sql_update= mysqli_query($conection,"update numero_oficial
															set folio='$folio', numero1='$numero1',numero2='$numero2', orden_p='$orden', estatus='$estatus', costo='$costo', fecha1='$fecha1',fecha2='$fecha2', fecha3='$fecha3'
															where id_numero='$idNumero'");
					}

				if($sql_update){
					$alert='<p class="msg_save">Número actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el número</p>';
					}	
			}	
		}	
			mysqli_close($conection);
	}
	

	if (empty($_GET['id'])){
		header('location:lista_numero.php');
			mysqli_close($conection);
	}
		$id_predio= $_GET['id'];
		$query= mysqli_query($conection,"select n.id_numero, n.id_predio, n.folio, p.clave, p.propietario, n.numero1, n.numero2,n.orden_p, n.costo, n.fecha1, n.fecha2, n.fecha3, n.estatus from numero_oficial n inner join predios p on n.id_predio= p.id_predio");
			mysqli_close($conection);
		$result_sql=mysqli_num_rows($query);
		if($result_sql==0){
			header('location:lista_numero.php');
		}else{	
			while($data=mysqli_fetch_array($query)){
				$idpred= $data['id_numero'];
				$folio= $data['folio'];
				$predio= $data['id_predio'];
				$propietario= $data['propietario'];	
				$numero1= $data['numero1'];
				$numero2= $data['numero2'];
				$orden= $data['orden_p'];
				$estatus= $data['estatus'];
				$costo= $data['costo'];
				$fecha1= $data['fecha1'];
				$fecha2= $data['fecha2'];
				$fecha3= $data['fecha3'];
			}	
		}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Número</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>
 
	<div class="articulo">

	<div class="form_register">
    <h1>Actualizar número</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
    <form action="" method="post">
    	<input type="hidden" name="idnumero" value="<?php echo $idpred; ?>">
    	<label for="folio">Folio</label>
        <input type="text" name="folio" id="folio" placeholder="No. de folio" value="<?php echo $folio; ?>">
        <label for="predio">Predio</label>
        <input type="text" name="predio" id="predio" placeholder="No. de predio" value="<?php echo $predio; ?>">
        <label for="propietario">Propietario</label>
        <input type="text" name="propietario" id="propietario" placeholder="Nombre del propietario" value="<?php echo $propietario; ?>">
        <label for="numero1">Número asignado</label>
        <input type="texto" name="numero1" id="numero1" placeholder="No. asignado" value="<?php echo $numero1; ?>">
        <label for="numero2">Número(texto)</label>
        <input type="texto" name="numero2" id="numero2" placeholder="Número asignado(texto)" value="<?php echo $numero2; ?>"> 
        <label for="ordenPago">Orden de pago</label>
        <input type="text" name="orden" id="orden" placeholder="Orden de pago" value="<?php echo $orden; ?>">
        <label for="costo">Costo del trámite</label>
        <input type="number" step="0.001" name="costo" id="costo" placeholder="Costo del trámite" value="<?php echo $costo; ?>">
        <label for="fecha1">Fecha de ingreso (aaaa-mm-dd)</label>
        <input type="date" name="fecha1" id="fecha1" placeholder="Fecha de ingreso" value="<?php echo $fecha1; ?>">
        <label for="fecha2">Fecha de elaboracion (aaaa-mm-dd)</label>
        <input type="date" name="fecha2" id="fecha2" placeholder="Fecha de elaboración" value="<?php echo $fecha2; ?>">
        <label for="fecha3">Fecha de entrega (aaaa-mm-dd)</label>
        <input type="date" name="fecha3" id="fecha3" placeholder="Fecha de entrega" value="<?php echo $fecha3; ?>">
        <label for="estatus">Estatus del tramite</label> 
      	 <select name="estatus">
       		<option>Recibido</option>
      	    <option>Procesado</option>
       	    <option>Firmado</option>
       	    <option>Entregado</option>
         </select> 
          <!--
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
          -->
        <input type="submit" value="Actualizar número" class="btn_save">
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