<?php
include "conexion.php";
require_once __DIR__ . '.../lib/MPDF/vendor/autoload.php';

$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PDF Requerimiento</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
      <header class="clearfix">
      <div id="logo1">
        <img src="img/victoria.jpg" aling=left>
        
      </div>
      <div id="logo2">
      <img src="img/tam.jpg" aling=right>
      </div>
      <div id="company" class="clearfix">
        <h2>REQUERIMIENTO POR ANUNCIOS</h2>';
        $id_requerimiento= $_GET['id'];
        $nombre_responsable= $_GET['nombre_responsable'];
        $nombre_comercial= $_GET['nombre_comercial']; 
        $fecha= $_GET['fecha']; 
        $descripcion= $_GET['descripcion'];  
        $html.='
        <div><b>FOLIO DE REQUERIMIENTO:RA-DDUMAT-'.$id_requerimiento.'<b></div>
        <div>Cd. Victoria, Tamps. a '.$fecha.' </div>
      </div>

    </header>
    <main>
      <div id="descripcion">
      <strong>'.$nombre_responsable.'</strong><br>
      '.$nombre_comercial.'<br><br><br>
      <b>P R E S E N T E</b>
        <div>
          En relación con el problema detectado consistente en:<br><br>
          <strong><u>'.$descripcion.' </u></strong><br><br>
           Y toda vez que se trata de una conducta violatoria, de disposiciones administrativas en materia de Imagen Urbana, se le hace saber lo siguiente:<br><br>
          Con fundamento en lo dispuesto por los artículos 14, 16 y 115 fracción II de la Constitución Política de os Estados Unidos Mexicanos; Art. 73 fracción IX del Código Municipal para el Estado de Tamaulipas, Art. 12 fracción XXI, XXVII, de la Ley de Asentamientos Humanos, Ordenamiento Territorial y Desarrollo Urbano para el Estado de Tamaulipas, y artículos 4, 5, 57, 89 y 90 del Reglamento para la Imagen Urbana de Victoria, Tamaulipas.
          .<br><br>';
        $html.='
            Con fundamento en lo dispuesto en los Artículos 93 fracción II, III, VII, IX y 95 del Reglamento para la Imagen Urbana de Victoria, Tamps., la Dirección sancionara administrativamente a los que cometen infracciones a lo establecido en el reglamento, se ordenan las siguientes medidas:<br>
            <ul>
                <li>La suspensión de trabajos y servicios.</li>
                <li>La suspensión del uso del vehículo con publicidad móvil.</li>
                <li>La clausura temporal de instalaciones, construcciones y obras.</li>
                <li>El retiro de instalaciones accesorias.</li>
                <li>Tramitar los permisos correspondientes ante el Departamento de Gestión Urbana.</li>
            </ul><br>

            Informándole que esta Dirección de Desarrollo Urbano, Medio Ambiente y Transporte dará inicio al procedimiento administrativo correspondiente, para determinar posibles infracciones a la legislación y reglamentación en materia de Imagen Urbana.<br>
          <div id=atentamente>
              <br><br><br><br><br><br>
              <strong>A T E N T A M E N T E</strong>
              <br>
              <br> <br> <br>
              <hr>

              <br>INSPECTOR O JEFE DEL DEPARTAMENTO
          </div>
       </div>
      </div>
    </main>
    <footer>
      Francisco I. Madero #102, Zona Centro 87000.
      Cd. Victoria Tamaulipas, Mexico.<br>
      <b>WWW.CIUDADVICTORIA.GOB.MX</b> 
    </footer>
  </body>
</html>';
$mpdf = new \Mpdf\Mpdf();
//$mpdf ->SetFooter('{nbpg}');
$css = file_get_contents('css/style.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

?>