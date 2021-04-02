<?php
include "conexion.php";
require_once __DIR__ . '.../lib/MPDF/vendor/autoload.php';

$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PDF Multa</title>
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
        <h2>MULTA</h2>';
        $id_multa= $_GET['id'];
        $fecha= $_GET['fecha'];
        $fecha_requerimiento= $_GET['fecha_requerimiento']; 
        $id_requerimiento= $_GET['id_requerimiento']; 
        $descripcion= $_GET['descripcion'];  
        $html.='
        <div><b>FOLIO DE MULTA:MA-DDUMAT-'.$id_multa.'<b></div>
        <div>Cd. Victoria, Tamps. a '.$fecha.' </div>
      </div>

    </header>
    <main>
      <div id="descripcion">
      <strong>'.$fecha_requerimiento.'</strong><br>
      '.$id_requerimiento.'<br><br><br>
      <b>P R E S E N T E.-</b>
        <div>
           Con relación al ANUNCIO PUBLICITARIOS <strong>'.$descripcion.' </strong> y con el objetivo de dar cumplimiento al Reglamento de Imagen Urbana de Victoria Tamaulipas, y de acuerdo a los dispuesto por los artículos 1, 2, 3, 5, 39, 41 y 93 Fracción II de dicha Legislación, con fecha <strong>'.$fecha_requerimiento.' </u></strong>  se le entrego un requerimiento con número de folio <strong>'.$id_requerimiento.'</strong>. Toda vez que no cuenta con la autorización correspondiente para la colación de los anuncios.
          .<br><br>';
        $html.='
            En consecuencia de la omisión a los preceptos de legalidad que de esta emanan, resulta aplicable lo dispuesto en el Capítulo Quinto, Sección II al Art. 97 Fracción V del Reglamento de la Imagen Urbana de Victoria, Tamaulipas, <strong><u>sanción de 250 salarios mínimos equivalente a $30,805.00</u></strong> (TREINTA MIL OCHOCIENTOS CINCO PESOS 00/100 m.n.)  Vigente en el área geográfica a que pertenece el Municipio, es necesario que se presente a la Presidencia Municipal al departamento de Ingresos, para realizar el  <strong><u>pago correspondiente a la sanción</u></strong> en un plazo de 5 días hábiles a partir de la fecha en que se entrega el presente oficio de MULTA, debiendo presentar el comprobante correspondiente a este Departamento, sin que esto implique la autorización del permiso. <br> <br>

              No omito hacer de su conocimiento que de no cumplir este requerimiento, se turnara al Área Jurídica ara emitir la resolución que en derecho proceda a efecto de hacer efectiva dicha infracción. 
              <br>
            

            
          <div id=atentamente>
              <br><br><br><br><br><br>
              <strong>A T E N T A M E N T E</strong>
              <br>
              <br> <br> <br>
              <hr>

              <br>DIRECTOR DE DESARROLLO URBANO Y MEDIO AMBIENTE
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