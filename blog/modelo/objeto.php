<?php 

	class Objeto{
		//Propiedades del objeto
		private $id;

		private $titulo;

		private $fecha;

		private $comentarios;

		private $imagen;

		//Métodos get y set
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;		
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function getFecha(){
			return $this->fecha;
		}

		public function setFecha($fecha){
			$this->fecha = $fecha;
		}

		public function getComentarios(){
			return $this->comentarios;
		}

		public function setComentarios($comentarios){
			$this->comentarios = $comentarios;
		}

		public function getImagen(){
			return $this->imagen;
		}

		public function setImagen($imagen){
			$this->imagen = $imagen;
		}
	}



 ?>