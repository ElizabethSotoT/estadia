<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de Anuncios</title>
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
						header ("location: lista_anuncio.php");
						mysqli_close($conection);
					}
				?>

				<H1><i class="fa fa-map-marker" aria-hidden="true"></i> Anuncios</H1>
                <a href="registro_anuncio.php" class="btn_new">Registrar anuncio</a>
                <form action="buscar_anuncio.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
                    <input type="submit" value="buscar" class="btn_search">
                    <a href="lista_anuncio.php"><img src="img/cerrar.png" class="btn_delete" style="margin-top:7px; margin-left:10px"></a>
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                        <th>Clave catastral</th>
                        <th>Ubicación</th>
                        <th>Zona</th>
                        <th>Tipo</th>
                        <th>Medida 1</th>
                        <th>Medida 2</th>
                        <th>Salario minimo</th>
                        <th>Cantidad</th>
                        <th>Opciones</th>
                    </tr>
                    <?php
					//paginador
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from anuncios");
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
					$query= mysqli_query($conection,"SELECT id_anuncio, clave_catastral, ubicacion, zona, tipo_anuncio, medida1, medida2, salarios_minimo, cantidad FROM anuncios WHERE (
						id_anuncio like '%$busqueda%' or
						clave_catastral like '%$busqueda%' or
						ubicacion like '%$busqueda%' or
						zona like '%$busqueda%' or
						tipo_anuncio like '%$busqueda%' or
						medida1 like '%$busqueda%' or
						medida2 like '%$busqueda%' or
						salarios_minimo like '%$busqueda%' or
						cantidad like '%$busqueda%' 
				) 
					order by id_anuncio asc LIMIT $desde,$por_pagina");


					mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_anuncio']; ?></td>
                        <td><?php echo $data['clave_catastral']; ?></td>
                        <td><?php echo $data['ubicacion']; ?></td>
                        <td><?php echo $data['zona']; ?></td>
                        <td><?php echo $data['tipo_anuncio']; ?></td>
                        <td><?php echo $data['medida1']; ?></td>
                        <td><?php echo $data['medida2']; ?></td>
                        <td><?php echo $data['salarios_minimo']; ?></td>
                        <td><?php echo $data['cantidad']; ?></td>
                        <td>
                        	<a class="link_edit" href="editar_anuncio.php?id=<?php echo $data['id_anuncio']; ?>">Editar</a>
                            |
                            <a class="link_delete" href="eliminar_confirmar_anuncio.php?id=<?php echo $data['id_anuncio']; ?>">Eliminar</a>
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
