<?php 

	include_once 'objeto.php';
	//Creación de clase de objetos
	class ManejoObjetos{

		private $conexion;

		public function __construct($conexion){
			
			$this->setConexion($conexion);
		}

		public function setConexion(PDO $conexion){

			$this->conexion = $conexion;
		}

		public function getContenidoPorFecha(){

			$matriz = array();

			$contador = 0;

			$resultado = $this->conexion->query("SELECT * FROM contenido ORDER BY fecha");

			while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){

				$blog = new Objeto();

				$blog->setId($registro["id"]);

				$blog->setTitulo($registro["titulo"]);

				$blog->setFecha($registro["fecha"]);

				$blog->setComentarios($registro["comentarios"]);

				$blog->setImagen($registro["imagen"]);

				$matriz[$contador] = $blog;

				$contador++;

			}

			return $matriz;

		}

		public function insertarContenido(Objeto $blog){
			$sql = "INSERT INTO contenido (titulo, fecha, comentarios, imagen) VALUES('" . $blog->getTitulo() . "','" . $blog->getFecha() . "','" . $blog->getComentarios() . "','" . $blog->getImagen() . "')";
			$this->conexion->exec($sql);
		}

	}




 ?>