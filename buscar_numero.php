<?php

session_start();
if($_SESSION['rol']!=4)
	{
		header("location: ./");
		
	}
	include "conexion.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de No. Oficial</title>
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
						header ("location: lista_numero.php");
						mysqli_close($conection);
					}
				?>
            
				<H1><i class="fas fa-dice-five"></i> Lista de No. Oficial</H1>
                <a href="registro_numero.php" class="btn_new">Registra No. oficial</a>
                <form action="buscar_numero.php" method="get" class="form_search">
                	<input type="text" name="busqueda" id="busqueda" placeholder="buscar" value="<?php echo $busqueda; ?>">
                    <input type="submit" value="buscar" class="btn_search">
                </form>
                <div  style="overflow: auto" width="50%">
                <table>
                	<tr>
                    	<th>ID</th>
                        <th>Folio</th>
                        <th>Predio</th>
                        <th>Propietario</th>
                        <th>Número asignado</th>
                        <th>Número (texto)</th>
                        <th>Orden de pago</th>
                        <th>Costo del trámite</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de elaboración</th>
                        <th>Fecha de entrega</th>
                        <th>Estatus</th>
                        <th>Acción</th>
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
					$sql_registe=mysqli_query($conection,"select count(*) as total_registro, n.id_numero, n.folio, p.clave, p.propietario, n.numero1, n.numero2,
														n.orden_p, n.costo,	n.fecha1, n.fecha2, n.fecha3, n.estatus 
													 from numero_oficial n 
                                                     inner join predios p on n.id_predio= p.id_predio
																							where
																								
																								n.id_numero like   '%$busqueda%' or 
																								n.folio like 	     '%$busqueda%' or
																								p.clave like     '%$busqueda%' or
																								p.propietario like 	     '%$busqueda%' or
																								n.numero1 like '%$busqueda%' or
																								n.numero2 like  '%$busqueda%' or
																								n.orden_p like  '%$busqueda%' or
																								n.costo like  '%$busqueda%' or
																								n.fecha1 like  '%$busqueda%' or
																								n.fecha2 like  '%$busqueda%' or
																								n.fecha3 like  '%$busqueda%' or
																								n.estatus like '%$busqueda%' "
																							    );
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
					$query= mysqli_query($conection,"select n.id_numero, n.folio, p.clave, p.propietario, n.numero1, n.numero2,
														n.orden_p, n.costo,	n.fecha1, n.fecha2, n.fecha3, n.estatus 
													 from numero_oficial n 
                                                     inner join predios p on n.id_predio= p.id_predio
													 WHERE 
														(
															n.id_numero like   '%$busqueda%' or 
															n.folio like 	     '%$busqueda%' or
															p.clave like     '%$busqueda%' or
															p.propietario like 	     '%$busqueda%' or
															n.numero1 like '%$busqueda%' or
															n.numero2 like  '%$busqueda%' or
															n.orden_p like  '%$busqueda%' or
															n.costo like  '%$busqueda%' or
															n.fecha1 like  '%$busqueda%' or
															n.fecha2 like  '%$busqueda%' or
															n.fecha3 like  '%$busqueda%' or
															n.estatus like '%$busqueda%' 
								)					
					
					order by n.id_numero asc
					LIMIT $desde,$por_pagina
					");
					mysqli_close($conection);
					$result=mysqli_num_rows($query);
					if($result>0){
						while ($data= mysqli_fetch_array($query)){
					?>	
                    <tr>
                    	<td><?php echo $data['id_numero']; ?></td>
                        <td><?php echo $data['folio']; ?></td>
                        <td><?php echo $data['clave']; ?></td>
                        <td><?php echo $data['propietario']; ?></td>
                        <td><?php echo $data['numero1']; ?></td>
                        <td><?php echo $data['numero2']; ?></td>
                        <td><?php echo $data['orden_p']; ?></td>
                        <td><?php echo $data['costo']; ?></td>
                        <td><?php echo $data['fecha1']; ?></td>
                        <td><?php echo $data['fecha2']; ?></td>
                        <td><?php echo $data['fecha3']; ?></td>
                        <td><?php echo $data['estatus']; ?></td>
                        <td>
                        	<a class="link_edit" href="editar_construccion.php?id=<?php echo $data['id_lic_const']; ?>">Editar</a>

                            
                            |
                            <a class="link_delete" href="eliminar_confirmar_construccion.php?id=<?php echo $data['id_lic_const']; ?>">Eliminar</a>

                        </td>
                    </tr> 
                    <?php
					}	
					}
					
                    ?>
					                  
                </table>
                </div>
                <?php
				if($total_registro!=0){
					
				
				?>
                
                <div class="paginador">
                	<ul>
                    <?php
						if($pagina!=1){
							
						
					?>
                    
                    	<li><p><a href=""><i class="fas fa-step-backward"></i></a></p></li>
                        <li><p><a href=""><i class="fas fa-backward"></i></a></p></li>
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

                        <li><p><a href=""><i class="fas fa-forward"></i></a></p></li>
                        <li><p><a href=""><i class="fas fa-step-forward"></i></a></p></li>
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