<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de cotizaciones</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
				<H1><i class="far fa-map"></i> Cotizaciones</H1>
                <a href="registro_cotizacion.php" class="btn_new">Crear cotización</a>
                <form action="buscar_cotizacion.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	
                	<tr>
                    	<th>ID</th>
                    	<th>Fecha de cotización</th>
                    	<th>Fecha de inicio</th>
                    	<th>Fecha final</th>
                        <th>Nombre del responsable</th>
                        <th>Nombre comercial</th>
                        <th>R.F.C.</th> 
                        <th>ID Anuncio</th>
                        <th>Anuncio Ubicación</th>
                        <th>Tipo de anuncio</th>
                        <th colspan="2">Medidas</th>
                        <th>Cantidad</th>
                        <th>PDF</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from cotizaciones_anuncio");
					$result_register=mysqli_fetch_array($sql_registe);
					$total_registro=$result_register['total_registro'];
					$por_pagina=5;
					if(empty($_GET['pagina'])){
						$pagina=1;
					}else{
						$pagina= $_GET['pagina'];
					}
					$desde=($pagina-1)*$por_pagina;
					$total_paginas= ceil($total_registro/$por_pagina);
					$query= mysqli_query($conection,"select c.id_cotizacion, c.fecha, c.fecha_inicio, c.fecha_final, p.nombre_responsable, p.nombre_comercial, p.rfc, p.calle, p.numero, p.id_colonia, asent.nombre1, c.id_persona, c.id_anuncio, a.ubicacion, a.tipo_anuncio, a.medida1, a.medida2, a.cantidad FROM personas p INNER JOIN cotizaciones_anuncio c on p.id_persona = c.id_persona INNER JOIN anuncios a on a.id_anuncio=c.id_anuncio INNER JOIN asentamientos asent on asent.id_asent=p.id_colonia order by id_cotizacion asc
					LIMIT $desde,$por_pagina
					");
						mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_cotizacion']; ?></td>
                        <td><?php echo $data['fecha']; ?></td>
                        <td><?php echo $data['fecha_inicio']; ?></td>
                        <td><?php echo $data['fecha_final']; ?></td>
                        <td><?php echo $data['nombre_responsable']; ?></td>
                        <td><?php echo $data['nombre_comercial']; ?></td>
                        <td><?php echo $data['rfc']; ?></td>
                        <td><?php echo $data['id_anuncio']; ?></td>
                        <td><?php echo $data['ubicacion']; ?></td>
                        <td><?php echo $data['tipo_anuncio']; ?></td>
                        <td><?php echo $data['medida1']; ?></td>
                        <td><?php echo $data['medida2']; ?></td>
                        <td><?php echo $data['cantidad']; ?></td>
                        <td>
                        <a class="link_edit" href="pdf_cotizacion.php?id=<?php echo $data['id_cotizacion']; ?>&fecha=<?php echo $data['fecha']; ?>&fecha_inicio=<?php echo $data['fecha_inicio']; ?>&fecha_final=<?php echo $data['fecha_final']; ?>&nombre_responsable=<?php echo $data['nombre_responsable']; ?>&nombre_comercial=<?php echo $data['nombre_comercial']; ?>&rfc=<?php echo $data['rfc']; ?>&id_anuncio=<?php echo $data['id_anuncio']; ?>&ubicacion=<?php echo $data['ubicacion']; ?>&tipo_anuncio=<?php echo $data['tipo_anuncio']; ?>&medida1=<?php echo $data['medida1']; ?>&medida2=<?php echo $data['medida2']; ?>&cantidad=<?php echo $data['cantidad']; ?>">PDF</a>
                        </td>
                        <td>
                        	<a class="link_edit" href="editar_cotizacion.php?id=<?php echo $data['id_cotizacion']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_cotizacion.php?id=<?php echo $data['id_cotizacion']; ?>">Eliminar</a>
 
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