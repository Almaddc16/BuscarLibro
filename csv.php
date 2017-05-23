<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href='book.png' rel='shortcut icon' type='image/png'/>
  <title>CSV Libros</title>
  <meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">  
  <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"> 
</head>
<body>

 <button type="button" class="btn btn-default  btn-lg"><a href="index.php"><span class="glyphicon glyphicon-home"></span> </a></button><br>
<?php

  # conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "", "examenp");
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
  
  $Libros = fopen ("lista-libros.csv" , "r" );//leo el archivo que contiene los datos del producto
while (($datos =fgetcsv($Libros,1000,",")) !== FALSE )//Leo linea por linea del archivo hasta un maximo de 1000 caracteres por linea leida usando coma(,) como delimitador
{
 $linea[]=array('nombre_libro'=>$datos[0],'autor'=>$datos[1],'calificacion'=>$datos[2]);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo
}
fclose ($Libros);//Cierra el archivo

  $ingresado=0;//Variable que almacenara los insert exitosos
  $error=0;//Variable que almacenara los errores en almacenamiento
  $duplicado=0;//Variable que almacenara los registros duplicados
    foreach($linea as $indice=>$value) //Iteracion el array para extraer cada uno de los valores almacenados en cada items
  {
  $nombre_libro=$value["nombre_libro"];//Nombre  del libro
  $autor=$value["autor"];//Autor de libro
  $calificacion=$value["calificacion"];//calificacion del libro
 
  
  $sql=mysqli_query($con,"select * from libros where nombre_libro='$nombre_libro'");//Consulta a la tabla libros
  $num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
  if ($num==0)//Si es == 0 inserto
  {
  if ($insert=mysqli_query($con,"insert into libros(pk_libro, nombre_libro, autor, calificacion) values(null,'$nombre_libro','$autor','$calificacion')"))
  {
  echo $msj='<font color=green>El Libro <b>'.$autor.'</b> Guardado <br></font><br/>';
  $ingresado+=1;
  }//fin del if que comprueba que se guarden los datos
  else//sino ingresa el libro
  {
  echo $msj='<font color=red>El Libro <b>'.$nombre_libro.' </b> NO Guardado '.mysqli_error().'</font><br/>';
  $error+=1;
  }
  }//fin de if que comprueba que no haya en registro duplicado
  else
  {
  $duplicado+=1;
  echo $duplicate='<font color=red>El libro nombre_libro <b>'.$nombre_libro.'</b> Esta duplicado<br></font>';
  }
  }
  echo "<font color=green>".number_format($ingresado,2)." Productos Almacenados con exito<br/>";
  echo "<font color=red>".number_format($duplicado,2)." Productos Duplicados<br/>";
  echo "<font color=red>".number_format($error,2)." Errores de almacenamiento<br/>";
  ?>
</body>
</html>