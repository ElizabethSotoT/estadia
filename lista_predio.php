<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de Predios</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

 
			<div class="articulo">
				<H1><i class="far fa-map"></i> Lista de Predios</H1>
                <a href="registro_predio.php" class="btn_new">Crear predio</a>
                <form action="buscar_predio.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                    
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                        <th>Clave</th>
                        <th>Manzana</th>
                        <th>Lote</th>
                        <th>Superficie</th>
                        <th>Propietario</th>
                        <th>Calle</th>
                        <th>Número</th>
                        <th>Colonia</th>
                    </tr>
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from predios where estatus=1");
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
					$query= mysqli_query($conection,"select p.id_predio, p.clave, p.manzana,p.lote, p.superficie, p.propietario, p.calle1, 
															p.numero1, a.nombre 
													 from predios p inner join asentamientos a on p.id_colonia= a.id_asent 
													 WHERE estatus=1 order by id_predio asc
					LIMIT $desde,$por_pagina
					");
						mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_predio']; ?></td>
                        <td><?php echo $data['clave']; ?></td>
                        <td><?php echo $data['manzana']; ?></td>
                        <td><?php echo $data['lote']; ?></td>
                        <td><?php echo $data['superficie']; ?></td>
                        <td><?php echo $data['propietario']; ?></td>
                        <td><?php echo $data['calle1']; ?></td>
                        <td><?php echo $data['numero1']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td>
                        	<a class="link_edit" href="editar_predio.php?id=<?php echo $data['id_predio']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_predio.php?id=<?php echo $data['id_predio']; ?>">Eliminar</a>
 
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