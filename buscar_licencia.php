<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de Licencia de Anuncios</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

			<div class="articulo">
				<?php 
					$busqueda= strtolower($_REQUEST['busqueda']);
					
					if(empty($busqueda)){
						header ("location: lista_licencia.php");
						mysqli_close($conection);
					}
				?>
				<H1><i class="far fa-map"></i> Licencias</H1>
                <a href="registro_licencia.php" class="btn_new">Crear licencia</a>
                <form action="buscar_licencia.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                    <a href="lista_licencia.php"><img src="img/cerrar.png" class="btn_delete" style="margin-top:7px; margin-left:10px"></a>
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                    	<th>Nombre del responsable</th>
						<th>Nombre comercial</th>
                    	<th>RFC</th>
                        <th>Ubicacion</th>
                        <th>Tipo</th>
                        <th>Dimensiones</th>
                        <th>Cuota anual</th>
                        <th>Forma de pago</th>
                        <th>Fecha de pago</th>
                        <th>Fecha inicio</th>
                        <th>Fecha final</th>
						<th>PDF</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_licencia from licencia_anuncios");
					$result_register=mysqli_fetch_array($sql_registe);
					$total_registro=$result_register['total_licencia'];
					$por_pagina=5;
					if(empty($_GET['pagina'])){
						$pagina=1;
					}else{
						$pagina= $_GET['pagina'];
					}
					$desde=($pagina-1)*$por_pagina;
					$total_paginas= ceil($total_registro/$por_pagina);
					$query= mysqli_query($conection,"SELECT l.id_licencia, p.nombre_responsable, p.nombre_comercial, p.rfc, a.ubicacion, a.medida1, a.medida2, a.tipo_anuncio, l.cuota_anual, l.forma_pago, l.fecha_pago, l.fecha_inicio, l.fecha_final from anuncios a inner join licencia_anuncios l on a.id_anuncio = l.id_anuncio inner join personas p on l.id_persona = p.id_persona where(
							id_licencia like '%$busqueda%' or 
							nombre_responsable like '%$busqueda%' or 
							nombre_comercial like '%$busqueda%' or 
							rfc like '%$busqueda%' or 
							ubicacion like '%$busqueda%' or 
							medida1 like '%$busqueda%' or 
							medida2 like '%$busqueda%' or 
							tipo_anuncio like '%$busqueda%' or 
							cuota_anual like '%$busqueda%' or 
							forma_pago like '%$busqueda%' or 
							fecha_pago like '%$busqueda%' or 
							fecha_inicio like '%$busqueda%' or 
							fecha_final like '%$busqueda%' 
						)
						order by id_licencia asc LIMIT $desde,$por_pagina");
					mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_licencia']; ?></td>
                    	<td><?php echo $data['nombre_responsable']; ?></td>
						<td><?php echo $data['nombre_comercial']; ?></td>
                    	<td><?php echo $data['rfc']; ?></td>
               			<td><?php echo $data['ubicacion']; ?></td>
                        <td><?php echo $data['medida1']; ?></td>
                        <td><?php echo $data['medida2']; ?></td>
                        <td><?php echo $data['tipo_anuncio']; ?></td>
                        <td><?php echo $data['cuota_anual']; ?></td>
                        <td><?php echo $data['forma_pago']; ?></td>
                        <td><?php echo $data['fecha_pago']; ?></td>
                        <td><?php echo $data['fecha_inicio']; ?></td>
                        <td><?php echo $data['fecha_final']; ?></td>
						<td>
						<a class="link_edit" type=hidden href="pdf_licencia.php?id=<?php echo $data['id_licencia']; ?>&nombre_responsable=<?php echo $data['nombre_responsable']; ?>&nombre_comercial=<?php echo $data['nombre_comercial']; ?>&rfc=<?php echo $data['rfc']; ?>&ubicacion=<?php echo $data['ubicacion']; ?>&medida1=<?php echo $data['medida1']; ?>&medida2=<?php echo $data['medida2']; ?>&cuota_anual=<?php echo $data['cuota_anual']; ?>&forma_pago=<?php echo $data['forma_pago']; ?>&fecha_pago=<?php echo $data['fecha_pago']; ?>&fecha_inicio=<?php echo $data['fecha_inicio']; ?>&fecha_final=<?php echo $data['fecha_final']; ?>">PDF</a>
						</td>
                        <td>
                        	<a class="link_edit" href="editar_licencia.php?id=<?php echo $data['id_licencia']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_licencia.php?id=<?php echo $data['id_licencia']; ?>">Eliminar</a>
 
                        </td>
                    </tr> 
                    <?php
					}	
					}
					
                    ?>
					                  
                </table>
                </div>
                <div class="paginador">
                	<ul>
                    <?php
						if($pagina!=1){	
					?>
                    
                    	<li><p><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></p></li>
                        <li><p><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></p></li>
						<?php
						}
						 for ($i=1; $i<=$total_paginas; $i++){
								if($i==$pagina){
									echo '<li class="pageSelect">'.$i.'</li>';
								}else{
									echo '<li><p><a href="?pagina='.$i.'">'.$i.'</a></p></li>';
								 }
							  }
							  
							  if($pagina!=$total_paginas){
						 ?>

                        <li><p><a href="?pagina=<?php echo $pagina+1; ?>"><i class="fas fa-forward"></i></a></p></li>
                        <li><p><a href="?pagina=<?php echo $total_paginas;?>"><i class="fas fa-step-forward"></i></a></p></li>
                        <?php } ?>
                    </ul>
                </div>
			</div>
		 
		<?php include "includes/aside.php"; ?>
		</div>
	</section>
		<?php include "includes/footer.php"; ?>
</body>
</html>