<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Usuario
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }
  //Implementar un método para listar los registros
  public function listar() {
    $sql = "SELECT u.idusuario, p.nombre_persona, p.tipo_documento, p.numero_documento, p.celular, p.correo, u.cargo, u.login, p.foto_perfil, u.estado
    FROM usuario as u, persona as p
    WHERE u.idpersona = p.idpersona AND u.idusuario = up.idusuario AND u.estado=1 AND u.estado_delete=1  ORDER BY p.nombres ASC;";
    return ejecutarConsulta($sql);
  }
  //Implementar un método para listar los permisos marcados
  public function listarmarcados($idusuario) {
    $sql = "SELECT up.idusuario_permiso,up.idusuario,up.idpermiso,p.nombre FROM usuario_permiso as up, permiso as p WHERE up.idpermiso=p.idpermiso AND up.idusuario='$idusuario'; ";
    return ejecutarConsultaArray($sql);
  }

  //Función para verificar el acceso al sistema
  public function verificar($login, $clave) {
    $sql = "SELECT u.idusuario, u.idpersona, u.login, p.nombre_persona, p.tipo_documento, p.numero_documento, p.celular, p.direccion, p.correo, p.foto_perfil, cp.nombre_cargo 
    FROM usuario as u, persona as p, cargo_persona as cp 
    WHERE u.idpersona = p.idpersona AND p.idcargo_persona = cp.idcargo_persona AND u.login = '$login' AND u.password ='$clave' AND u.estado=1 AND u.estado_delete =1;";
    return ejecutarConsultaSimpleFila($sql);
  }



}

?>
