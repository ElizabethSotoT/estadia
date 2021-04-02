<?php
include "conexion.php";
require_once __DIR__ . '.../lib/MPDF/vendor/autoload.php';

$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PDF Licencia</title>
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
        <h2>LICENCIA DE ANUNCIO PUBLICITARIO</h2>';
        $id_licencia= $_GET['id'];
        
        $html.='
        <div><b>FOLIO DE AUNCIO:LA-DDUMAT-'.$id_licencia.'<b></div>';
        $html.='
        <div>Cd. Victoria, Tamps. a 20 de Enero 2021</div>
      </div>
      <div id="descripcion">
        <div>El R. Ayuntamiento de Victoria Tamaulipas, a través de la Dirección de Desarrollo Urbano, Medio 
        Ambiente y Transporte, y con fundamento en los Artíulos 12 fracción XXI y XXVII, y las 185 de la 
        Ley de Asentamientos Humanos, Ordenamiento Territorial y Desarrollo Urbano para el Estado de Tamaulipas, así
        como en el Artículo 49 fracción XXII del Código Municipal vientes en el Estado, y los diversos 8,39, 41, 45
        y 57 del Reglamento para la Imagen Urbana de Victoria, Tamaulipas, esta Dirreción DETERMINA PROCEDENTE otorgar
        la <b>VIGENCIA</b> DE ANUNCIO PUBLICITARIO al cumplimiento de los requisitos establecidos en el Reglamento 
        antes referido en materia de Imagen Urbano teniendo para sus efectos la siguiente descripción:  </div>
      </div>
    </header>
    <main>
      <table>
        <tbody>
        <tr>';
            $nombre_responsable= $_GET['nombre_responsable'];
            $nombre_comercial= $_GET['nombre_comercial'];
            $rfc= $_GET['rfc'];
            $ubicacion= $_GET['ubicacion']; 
            $medida1= $_GET['medida1']; 
            $medida2= $_GET['medida2']; 
            $cuota_anual= $_GET['cuota_anual']; 
            $forma_pago= $_GET['forma_pago']; 
            $fecha_pago= $_GET['fecha_pago']; 
            $fecha_inicio= $_GET['fecha_inicio'];
            $fecha_final= $_GET['fecha_final']; 
            $html.='
            <td class="service"><b>Nombre del Responsable</b></td>
            <td class="desc"><b>'.$nombre_responsable.'</b></td>
          </tr>
          <tr>
            <td class="service"><b>Nombre comercial</b></td>
            <td class="desc"><b>'.$nombre_comercial.'</b></td>
          </tr>
          <tr>
            <td class="service"><b>R.F.C.</b></td>
            <td class="desc">'.$rfc.'</td>
          </tr>
          <tr>
            <td class="service"><b>Ubicación</b></td>
            <td class="desc">'.$ubicacion.'</td>
          </tr>
          <tr>
            <td class="service"><b>Couta anual</b></td>
            <td class="desc">'.$medida1.' x '.$medida2.' M2</td>
          </tr>
          <tr>
            <td class="service"><b>Couta anual</b></td>
            <td class="desc">$'.$cuota_anual.'</td>
          </tr>
          <tr>
            <td class="service"><b>Forma de pago</b></td>
            <td class="desc">'.$forma_pago.'</td>
          </tr>
          <tr>
            <td class="service"><b>Fecha de pago</b></td>
            <td class="desc">'.$fecha_pago.'</td>
          </tr>
          <tr>
            <td class="service"><b>Fecha de inicio</b></td>
            <td class="desc">'.$fecha_inicio.'</td>
          </tr>
          <tr>
            <td class="service"><b>Fecha final</b></td>
            <td class="desc">'.$fecha_final.'</td>
          </tr>
          
        </table>';
        $html.='
      <div id="descripcion">
        <ul>';
          $id_licencia= $_GET['id'];
          $html.='
            <li type="disc">Se le solicita identificar unicamente los anuncios de Tipo Paleta y Auto soportados con el numero 
            de folio asignado (<b>LA-DDUMAT-'.$id_licencia.'</b>) de manera visible, lo antes posible.</li>
            <li type="disc">El pago de derechos realizado es conforme a la Ley de Ingresos del Municipio de Victoria, Tamaulipas vigente para 
            el ejercicio fiscal del año 2021, al termio del presete deberá solicitar la revalidación del mismo.</li>
            <li type="disc">Es responsabilidad del propietario del anuncio la veracidad de los cálculos estructurales señalados en el Artículo
            45 fracción V inciso f del Reglamento para la imagen Urbana de Victoria Tamaulipas.</li>
            <li type="disc">Esta Autoridad tiene facultades para calificar las infracciones e imponer las sanciones que en los Artículos 93 y 97
            consigna en el multicitado reglamento.</li>';
            $html.='
        </ul>
        
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