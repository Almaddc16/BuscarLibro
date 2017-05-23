<?php 

include 'conn.php';
class mLibro extends modelo
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_temporal()
	{
		$result = $this->_db->query("SELECT pk_libro, nombre_libro, autor, calificacion FROM libros where pk_libro='".$pklibro = $_REQUEST['pklibro']."'");
		$libro =$result->fetch_all(MYSQLI_ASSOC);
		return $libro;
	}
}
$mLibro = new mLibro();
$mostrar_libro = $mLibro->get_temporal();


foreach($mostrar_libro as $row):
	
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href='book.png' rel='shortcut icon' type='image/png'/>

	<title>Libro: <?php echo $row['nombre_libro'];  ?></title>
	<meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">  
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/css.css">
</head>
 <?php include('menu.php') ?>
<body>
<div class="container">
	<div class="page-header">
		  <h2>Detelles de libro</h2>
	</div>

		<blockquote>
		  <p><?php 
			echo $row['nombre_libro'];  ?></p>
		  <footer>Autor: <cite title="Source Title"><?php echo $row['autor']; ?> </cite></footer>
		   <p class="small">Calificacion:<kbd>
		<?php
		 echo $row['calificacion']; 
		endforeach
		 ?></kbd></p>
		</blockquote>


	<div class="container">
		<a href="index.php"> 
		<button type="button" class="btn btn-default  btn-lg">Regresar </button></a>
	</div>
</div>

</body>
</html>
