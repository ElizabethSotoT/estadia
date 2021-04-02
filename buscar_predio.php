<?php
	include "conexion.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de Predios</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
						header ("location: lista_predio.php");
						mysqli_close($conection);
					}
				?>
            
				<H1><i class="far fa-map"></i> Lista de Predios</H1>
                <a href="registro_predio.php" class="btn_new">Registra predio</a>
                <form action="buscar_predio.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar" value="<?php echo $busqueda; ?>">
                    <input type="submit" value="buscar" class="btn_search">
                    <a href="lista_predio.php"><img src="img/cerrar.png" class="btn_delete" style="margin-top:7px; margin-left:10px"></a>
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
					//$rol='';
					//if($busqueda=='administrador'){
					//	$rol= " OR id_rol like '%1%'";	
					//}else if($busqueda=='supervisor'){
						//$rol= " OR id_rol like '%2%'";
					//}else if ($busqueda=='operador'){
						//$rol= " OR id_rol like '%3%'";	
					//}
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro from predios 
																							where
																								(
																								id_predio like   '%$busqueda%' or 
																								clave like 	     '%$busqueda%' or
																								manzana like     '%$busqueda%' or
																								lote like 	     '%$busqueda%' or
																								superficie like  '%$busqueda%' or
																								propietario like '%$busqueda%' or
																								calle1 like 	 '%$busqueda%' or
																								numero1 like 	 '%$busqueda%' 
																							
																								)
																							and 
																							estatus=1");
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
					$query= mysqli_query($conection,"select p.id_predio, p.clave, p.manzana, p.lote, p.superficie, p.propietario, p.calle1, p.numero1, 											a.nombre 
													 from predios p inner join asentamientos a on p.id_colonia= a.id_asent 
													 WHERE 
								(
								p.id_predio like '%$busqueda%' or 
								p.clave like 	'%$busqueda%' or
								p.manzana like   '%$busqueda%' or
								p.lote like 	'%$busqueda%' or
								p.superficie like 	'%$busqueda%' or
								p.propietario like 	'%$busqueda%' or
								p.calle1 like 	'%$busqueda%' or
								p.numero1 like 	'%$busqueda%' or
								a.nombre like '%$busqueda%'
								)					
					AND
					
					estatus=1 order by id_predio asc
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
                
                <?php
				if($total_registro!=0){
					
				
				?>
                </div>
                <div class="paginador">
                	<ul>
                    <?php
						if($pagina!=1){
							
						
					?>
                    
                    	<li><p><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-backward"></i></a></p></li>
                        <li><p><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-backward"></i></a></p></li>
						<?php
						}
						 for ($i=1; $i<=$total_paginas; $i++){
								if($i==$pagina){
									echo '<li class="pageSelect">'.$i.'</li>';
								}else{
									echo '<li><p><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></p></li>';
								 }
							  }
							  
							  if($pagina!=$total_paginas){
						 ?>

                        <li><p><a href="?pagina=<?php echo $pagina+1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-forward"></i></a></p></li>
                        <li><p><a href="?pagina=<?php echo $total_paginas;?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-forward"></i></a></p></li>
                        <?php } ?>
                    </ul>
                </div>
                
                <?php } ?>
			</div>
		 
		<?php include "includes/aside.php"; ?>
		</div>
	</section>
		<?php include "includes/footer.php"; ?>
</body>
</html>