<?php 
/*buscar por titulo, autor y calificacion*/
	
include 'conn.php';
class pModelo extends modelo
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_p()
	{
		@$q=$_REQUEST["q"];
		
		$result = $this->_db->query("SELECT pk_libro, nombre_libro, autor, calificacion FROM  libros where nombre_libro LIKE '".$q."%' OR autor LIKE '".$q."%' OR calificacion LIKE '".$q."%'");
		$p =$result->fetch_all(MYSQL_ASSOC);
		return $p;
	}
}
$pModelo = new pModelo();
$a_p = $pModelo->get_p();

?>

<?php foreach($a_p as $row): ?>
	
	<?php $PK = $row['pk_libro'];?>

		<div class="listalibro" >
				<a  href="descipcion.php?pklibro=<?php echo $PK; ?>"><br>
					<h4><p class="titulo"><?php echo $row['nombre_libro']; ?></p></h4>
					<p class="calif"><?php echo $row['autor']; echo "<br>";echo "Cal: ".$row['calificacion']; ?>
					</p>
				</a>	
			<hr>
		</div>
			
<?php endforeach;?>
	
