<?php

class modelo
{
	protected $_db;

	public function __construct()
	{
		$this ->_db = new mysqli("localhost", "root", "", "examenp");
		if($this ->_db->connect_errno)
		{
			echo "Error en la conexión:". $this->_db->connect_errno;
			return;
		}

		$this->_db->set_charset("utf-8");
		if($this ->_db)
		{
		//	echo " Conexion exitosa";
			return;
		}
	}
}
class mLibro extends modelo
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_temporal()
	{
		$result = $this->_db->query("SELECT pk_libro, nombre_libro, autor, calificacion FROM libros");
		$libro =$result->fetch_all(MYSQLI_ASSOC);
		if($libro){
			return $libro;
			
		}else{
		echo "Error ";
	}
	}
}
$mLibro = new mLibro();
$mostrar_libro = $mLibro->get_temporal();									
 
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href='book.png' rel='shortcut icon' type='image/png'/>
	<title>Libros</title>
	<meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">  
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/stylo.css">
	<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
<!-- Menu-->
<?php include('menu.php') ?>

<div class="container-fluid">

	<div class="row"> <!-- Renglon 1-->
		<div class="col-xs-12  col-lg-3 buscador"> <!-- Inicio de columna 1 de Renglon 1-->
			<center> 
				<h4><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				<strong>Buscar: </strong>
				<input type="text" id="bus" name="bus" class="form-control cajat"  placeholder="Título, autor o calificación" onkeyup="loadXMLDoc()" required />
				</h4>
				<hr>	
					<div id="myDiv">
						<!--Resultados de busqueda -->
					</div>
			</center>						
		</div><!-- Fin de columna 1 de Renglon 1-->


		<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-3"> <!-- Inicio de columna 2 de Renglon 1-->
				<section  class="row"> 

						<?php
							if ($mostrar_libro) {
							foreach($mostrar_libro as $row):
							$PK= $row['pk_libro'];
						 ?>
						<div class="clearfix visible-sm-block"></div>
							<div class="col-xs-12 col-lg-4 lista">	
								<br>
								<a class="thumbnail desc" href="descipcion.php?pklibro=<?php echo $PK; ?>" >
									<center><p class="lead"><strong class="titulo"> <?php echo $row['nombre_libro'];  ?></strong></center>
									<br>
									<blockquote>
										<p class="calif">Autor: <?php echo $row['autor']; echo "<br>"; ?>Calificacion: <?php echo $row['calificacion']; ?> </p> 
									</blockquote>			
								</a>
							</div>
							
						<?php 
							endforeach;
						?>
				</section> <!-- Inicio de columna 2 de Renglon 1-->
		</div>

	</div>

<?php }else{

 ?> 
<br>
 <div class="container-fluid panel">
  <div class="well well-lg">
   La base de datos esta vacia.
 <br>Corre el archivo csv.php para insertar algunos ejemplos en la base da datos
 <br>
 <button type="button" class="btn btn-default  btn-lg"><a href="csv.php">Cargar ejemplos </a></button>
  </div>
</div>
</div>
  <?php  }?>

<script src="Bootstrap/js/jquery.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="d4all.mx.js"></script>
</body>
</html>


