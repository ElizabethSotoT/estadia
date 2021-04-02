<?php
include "conexion.php";
require_once __DIR__ . '.../lib/MPDF/vendor/autoload.php';

$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PDF Cotización</title>
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
        <h2>COTIZACIÓN</h2>';
        $id_cotizacion= $_GET['id'];
        $fecha= $_GET['fecha'];
        $fecha_inicio= $_GET['fecha_inicio'];
        $fecha_final= $_GET['fecha_final']; 
        $nombre_responsable= $_GET['nombre_responsable']; 
        $nombre_comercial= $_GET['nombre_comercial']; 
        $rfc= $_GET['rfc']; 
        $id_anuncio= $_GET['id_anuncio'];
        $ubicacion= $_GET['ubicacion']; 
        $tipo_anuncio= $_GET['tipo_anuncio'];
        $medida1= $_GET['medida1']; 
        $medida2= $_GET['medida2']; 
        $cantidad= $_GET['cantidad']; 
        $html.='
        <div><b>FOLIO DE COTIZACIÓN:CA-DDUMAT-'.$id_cotizacion.'<b></div>
        <div>Cd. Victoria, Tamps. a '.$fecha.' </div>
      </div>

    </header>
    <main>
      <div id="descripcion">
      <strong>'.$nombre_responsable.'</strong><br>
      '.$nombre_comercial.'<br>
      R.F.C. '.$rfc.'<br><br>
      <b>P R E S E N T E</b>
        <div>Con el objetivo de optimizar los servicios de este departamento, sírvase encontrar anexo a la presente, una cotización desglosada de los anuncios que tiene instaladas la empresa que usted representa, a fin de que se presente a realizar los trámites y pagos necesarios para adquirir la renovación de la <strong>Vigencia de Anuncios Publicitarios correspondientes al año 2021</strong>. Considerando para este efecto de forma ordinaria al tiempo de <strong>'.$fecha_inicio.' a '.$fecha_final.'</strong>.<br><br>';
        $html.='
          Así mismo se le apercibe que de no presentarse en los tiempos ordinarios, se aplicaran las medidas, que la ley de la materia estipulada.<br>
          Lo anterior de acuerdo a los dispuesto en el Art. 57 frac. IV inciso c) del Reglamento de Imagen Urbana de Victoria, Tamaulipas y Art. 34 Frac. I, II, III, IV Y V de la Ley de Ingresos para el ejercicio fiscal del año 2021.
          Sin otro particular. Quedo de Usted.<br>
          <div id=atentamente>
              <br><br><br><br><br><br>
              <strong>A T E N T A M E N T E</strong>
              <br>
              <br> <br> <br>
              <hr>

              <br>JEFE DEL DEPARTAMENTO DE GESTION URBANA
          </div>
           <br> <br> <br> <br>
          <b>Nota.</b> Esta dirección se reserva el derecho de revisar que los anuncios se encuentren en perfectas condiciones de pintura, estructura, así como la leyenda del mismo. Esto con la finalidad de otorgar el permiso correspondiente a este año.
       </div>
      </div>
      <div id="cotizacion">';
          $html.='
        <h1 style="text-transform: uppercase;">COTIZACIÓN '.$nombre_responsable.'</h1>
        <table>
            <tr>
              <th>ID</th>
              <th>Ubicación</th>
              <th>Medidas aproximadas</th>
              <th>Cantidad</th>
            </tr>
            <tr>
              <td>'.$id_anuncio.'</td>
              <td>'.$ubicacion.'</td>
              <td>'.$medida1.' x '.$medida2.' M2</td>
              <td>$'.$cantidad.'</td>
            </tr>
        </table>
        <br><br>
        <strong>
        CANTIDAD TOTAL A PAGAR POR EL AÑO 2021<br>
        $ '.$cantidad.'<br><br><br>
        
        NOTA:</strong> De acuerdo al D E C R E T O NO. LXIII-768 mediante el cual se expide la Ley de ingresos del Municipio de Victoria, Tamaulipas, para el ejercito Fiscal del año 2021:

        <br><br><strong>
        CAPITULO V <br>
        SECCION CUARTA<br>
        ACCESORIOS DE LOS DERECHOS<br>
        Artículo 38</strong>.- Cuando no se cubran los derechos en la fecha o dentro del plazo fijado or las disposiciones fiscales, dará lugar a la causación o cobro de un recargo a razón del 1.13%por cada mes o fracción que se retarde el pago y hasta que el mismo se efectue, independientemente de la actualización y de la sanción a que haya lugar. Se pondrán exentar parte de los recargos causados, en los términos que dispone el artíulo 98 del código Municipal para el Estado de Tamaulipas
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