<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de domicilios</title>
	<?php include "includes/scripts.php"; ?>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="main">
<?php include "includes/wrapp.php"; ?>

			<div class="articulo">
				<H1><i class="far fa-address-book"></i> Lista de domicilios</H1>
                <a href="registro_domicilio.php" class="btn_new">Crear domicilio</a>
                <form action="buscar_domicilio.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                        <th>Calle</th>
                        <th>No. exterior</th>
                        <th>No. interior</th>
                        <th>Tipo</th>
                        <th>C.P.</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Predio superficie</th>
                        <th>Clave catastral</th>
                        <th>Norte</th>
                        <th>Sur</th>
                        <th>Este</th>
                        <th>Oeste</th>
                        <th>Opciones</th>
                    </tr>
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from domicilios_personas");
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
					$query= mysqli_query($conection,"SELECT id_domicilio, calle1, numero_exterior, numero_interior, tipo, codigo_postal, ciudad, estado, predio_superficie, clave_catastral, calle_norte, calle_sur, calle_este, calle_oeste FROM domicilios_personas order by id_domicilio asc
					LIMIT $desde,$por_pagina
					");
						mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_domicilio']; ?></td>
                        <td><?php echo $data['calle1']; ?></td>
                        <td><?php echo $data['numero_exterior']; ?></td>
                        <td><?php echo $data['numero_interior']; ?></td>
                        <td><?php echo $data['tipo']; ?></td>
                        <td><?php echo $data['codigo_postal']; ?></td>
                        <td><?php echo $data['ciudad']; ?></td>
                        <td><?php echo $data['estado']; ?></td>
                        <td><?php echo $data['predio_superficie']; ?></td>
                        <td><?php echo $data['clave_catastral']; ?></td>
                        <td><?php echo $data['calle_norte']; ?></td>
                        <td><?php echo $data['calle_sur']; ?></td>
                        <td><?php echo $data['calle_este']; ?></td>
                        <td><?php echo $data['calle_oeste']; ?></td>
                        <td>
                        	<a class="link_edit" href="editar_domicilio.php?id=<?php echo $data['id_domicilio']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_domicilio.php?id=<?php echo $data['id_domicilio']; ?>">Eliminar</a>
 
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