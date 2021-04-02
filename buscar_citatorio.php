<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de citatorios</title>
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
						header ("location:lista_citatorio.php");
						mysqli_close($conection);
					}
				?>
				<H1><i class="far fa-map"></i> Citatorios</H1>
                <a href="registro_citatorio.php" class="btn_new">Crear citatorio</a>
                <form action="buscar_citatorio.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                    <a href="lista_citatorio.php"><img src="img/cerrar.png" class="btn_delete" style="margin-top:7px; margin-left:10px"></a>
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                        <th>Razon</th>
                        <th>Fecha</th>
                        <th>Fecha citatorio</th>
                        <th>Nombre del responsable</th>
						<th>Nombre comercial</th>
                        <th>ID Requerimiento</th>
                        <th>Fecha Requerimiento</th>
						<th>Descripción de requerimiento</th>
						<th>PDF</th>
                        <th>Acciones</th>
                    </tr>
                    
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from citatorios_anuncios");
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
					$query= mysqli_query($conection,"SELECT c.id_citatorio, c.razon, c.fecha_creado, c.fecha_citatorio, c.id_persona, p.nombre_responsable, p.nombre_comercial, c.id_requerimiento, r.fecha as fecha_requerimiento, r.descripcion FROM personas p INNER JOIN citatorios_anuncios c on p.id_persona=c.id_persona INNER JOIN requerimientos_anuncios r on r.id_requerimiento = c.id_requerimiento where
																													c.id_citatorio like '%$busqueda%' or 
																													c.razon like '%$busqueda%' or 
																													c.fecha_creado like '%$busqueda%' or 
																													c.fecha_citatorio like '%$busqueda%' or 
																													p.nombre_responsable like '%$busqueda%' or 
																													p.nombre_comercial like '%$busqueda%' or 
																													c.id_requerimiento like '%$busqueda%' or 
																													r.fecha like '%$busqueda%' or 
																													r.descripcion like '%$busqueda%' 
																													 order by id_citatorio asc	LIMIT $desde,$por_pagina");
						mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_citatorio']; ?></td>
                        <td><?php echo $data['razon']; ?></td>
                        <td><?php echo $data['fecha_creado']; ?></td>
                        <td><?php echo $data['fecha_citatorio']; ?></td>
                        <td><?php echo $data['nombre_responsable']; ?></td>
						<td><?php echo $data['nombre_comercial']; ?></td>
                        <td><?php echo $data['id_requerimiento']; ?></td>
                        <td><?php echo $data['fecha_requerimiento']; ?></td>
						<td><?php echo $data['descripcion']; ?></td>
						<td>
						<a class="link_edit" type=hidden href="pdf_citatorio.php?id=<?php echo $data['id_citatorio']; ?>&razon=<?php echo $data['razon']; ?>&fecha_creado=<?php echo $data['fecha_creado']; ?>&fecha_citatorio=<?php echo $data['fecha_citatorio']; ?>&nombre_responsable=<?php echo $data['nombre_responsable']; ?>&nombre_comercial=<?php echo $data['nombre_comercial']; ?>&id_requerimiento=<?php echo $data['id_requerimiento']; ?>&fecha_requerimiento=<?php echo $data['fecha_requerimiento']; ?>&descripcion=<?php echo $data['descripcion']; ?>">PDF</a>
						</td>
                        <td>
                        	<a class="link_edit" href="editar_citatorio.php?id=<?php echo $data['id_citatorio']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_citatorio.php?id=<?php echo $data['id_citatorio']; ?>">Eliminar</a>
 
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