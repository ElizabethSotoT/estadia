<?php
include "conexion.php";
require_once __DIR__ . '.../lib/MPDF/vendor/autoload.php';

$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PDF Citatorio</title>
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
        <h2>CITATORIO</h2>';
        $id_citatorio= $_GET['id'];
        $razon= $_GET['razon'];
        $fecha_creado= $_GET['fecha_creado'];
        $fecha_citatorio= $_GET['fecha_citatorio'];
        $nombre_responsable= $_GET['nombre_responsable'];
        $nombre_comercial= $_GET['nombre_comercial']; 
        $id_requerimiento= $_GET['id_requerimiento']; 
        $fecha_requerimiento= $_GET['fecha_requerimiento']; 
        $descripcion= $_GET['descripcion'];  
        $html.='
        <div><b>FOLIO DE CITATORIO:CA-DDUMAT-'.$id_citatorio.'<b></div>
        <div>Cd. Victoria, Tamps. a '.$fecha_creado.' </div>
      </div>

    </header>
    <main>
      <div id="descripcion">
      <strong>'.$nombre_responsable.'</strong><br>
      '.$nombre_comercial.'<br><br><br>
      <b>P R E S E N T E</b>
        <div>
          
           Con el objetivo de dar cumplimiento al Reglamento de la Imagen Urbana de Victoria Tamaulipas, y de acuerdo a los dispuesto por los artículos 1, 2, 4, 5, 39, 41 de dicha Legislación; con fecha de  <strong>'.$fecha_requerimiento.'  se le entrego un Requerimiento con número de folio '.$id_requerimiento.'</strong>,  a efecto de regularizar el trámite correspondiente para obtener su <strong><u>LICENCIA DE ANUNCIO PUBLICITARIO</u></strong>, sin embargo ha hecho caso omiso a dicho trámite, violentado así los preceptos de legalidad que se precisan.<br><br>
            En consecuencia resulta necesario por segunda y última ocasión notificarle  de nueva cuenta para que se presente a las <strong>'.$fecha_citatorio.'</strong>, en las oficinas que ocupa esta Dirección a mi cargo, para tramitar su <strong><u>LICENCIA DE ANUNCIO PUBLICITARIO</u></strong> apercibiéndolo de no presentarse en la hora y día indicado, se aplicara la Sanción que establece el Art. 97 Fracción V, del Reglamento antes mencionado que corresponde a los 300 S.M <strong>($26,064.00 pesos M.N.)</strong> vigente en el área geográfica a que pertenece en Municipio cuando no se cuente con el permiso correspondiente.<br><br>';
        $html.='
            

            No omito hacer de su conocimiento, que de no cumplir este requerimiento, se turnara el Área Jurídica para emitir la resolución que en derecho proceda a efecto de hacer efectiva dicha infracción.<br>
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