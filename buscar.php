<?php  
 $connect = mysqli_connect("localhost", "root", "", "urbano1");  
 if(isset($_POST["query"]))  
 {  
      $output = '';
      $query ="SELECT id_predio, clave, propietario FROM predios WHERE clave LIKE '%".$_POST["query"]."%'";
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      
            if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["clave"]. " ". $row["propietario"]. " ". $row["id_predio"].'</li>';
                
           }  
      }  
      else  
      {  
           $output .= '<li> Predio no encontrado</li>';  
      }  
      $output .= '</ul>';  
      echo $output;
 } 

 ?>
