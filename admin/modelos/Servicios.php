<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Servicios
{
	//Implementamos nuestro constructor
	public function __construct() { }

	public function insertar($id_paginaweb,$nombre,$descripcion,$caracteristicas,$imagen_perfil)
	{
	
		$sql="INSERT INTO servicio(idpagina_web, nombre_servicio, descripcion, caracteristicas, icono) 
		VALUES ('$id_paginaweb','$nombre','$descripcion','$caracteristicas','$imagen_perfil')";
		return ejecutarConsulta($sql);
			
	}

	public function editar($idservicio,$id_paginaweb,$nombre,$descripcion,$caracteristicas,$imagen_perfil)
	{
		$sql="UPDATE servicio SET idpagina_web='$id_paginaweb', nombre_servicio='$nombre',caracteristicas='$caracteristicas',descripcion='$descripcion',icono='$imagen_perfil'
		 WHERE idservicio='$idservicio'";	
		return ejecutarConsulta($sql);	
	}

	public function eliminar($idservicio)
	{
		$sql="DELETE FROM servicio WHERE idservicio ='$idservicio';";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idservicio )
	{
		$sql="SELECT*FROM servicio WHERE idservicio ='$idservicio'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar($id)
	{
		$sql="SELECT*FROM servicio WHERE idpagina_web='$id' ORDER BY idservicio DESC";
		return ejecutarConsulta($sql);		
	}

	public function reg_img($idservicio)
	{
		$sql="SELECT icono FROM servicio WHERE idservicio='$idservicio'";
		return ejecutarConsultaSimpleFila($sql);		
	}
		
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------

	//Implementar un método para listar los registros
	public function listar_serv_web()
	{
		$sql="SELECT*FROM servicio ORDER BY idservicio DESC";
		return ejecutarConsultaArray($sql);		
	}

	//Implementar un método para listar los registros
	public function listar_serv_web_f()
	{
		$sql="SELECT*FROM servicio ORDER BY idservicio DESC LIMIT 3";
		return ejecutarConsultaArray($sql);		
	}

}

?>