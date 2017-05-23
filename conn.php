<?php class modelo
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
		//	echo "exito:";
			return;
		}
	}
} ?>