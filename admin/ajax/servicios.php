<?php

ob_start();

if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {

  header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

} else {
  
  if ($_SESSION['servicio'] == 1) {

    require_once "../modelos/Servicios.php";

    $servicios = new Servicios();
    
    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    $id_paginaweb = isset($_POST["id_paginaweb"]) ? limpiarCadena($_POST["id_paginaweb"]) : "";
    $idservicio = isset($_POST["idservicio"]) ? limpiarCadena($_POST["idservicio"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
    $caracteristicas = isset($_POST["caracteristicas"]) ? limpiarCadena($_POST["caracteristicas"]) : "";

    $foto2 = isset($_POST["doc1"]) ? limpiarCadena($_POST["doc1"]) : "";

    switch ($_GET["op"]) {

      case 'guardaryeditar':

        if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {

          $imagen_perfil = $_POST["doc_old_1"];

          $flat_img = false;

        } else {

          $ext1 = explode(".", $_FILES["doc1"]["name"]);

          $flat_img = true;

          $imagen_perfil = $date_now.' '.rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/img/servicios/imagen_perfil/" . $imagen_perfil);

        }

        if (empty($idservicio)) {
          
          $rspta = $servicios->insertar($id_paginaweb,$nombre, $descripcion, $caracteristicas, $imagen_perfil);
          echo json_encode($rspta, true);

        } else {
          
          if ($flat_img == true) {

            $datos_ficha1 = $servicios->reg_img($idservicio);

            if ($datos_ficha1['status']) {

              $ficha1_ant = $datos_ficha1['data']['icono'];

              if (!empty($ficha1_ant) ) {  unlink("../dist/img/servicios/imagen_perfil/" . $ficha1_ant);  }
            }
          }

          $rspta = $servicios->editar($idservicio, $id_paginaweb, $nombre, $descripcion, $caracteristicas, $imagen_perfil);
          echo json_encode($rspta, true);

        }

      break;

      case 'eliminar':
        $rspta = $servicios->eliminar($idservicio);
        echo json_encode($rspta, true);
      break;

      case 'mostrar_servicio':
        $rspta = $servicios->mostrar($idservicio);
        echo json_encode($rspta, true);
      break;

      case 'listar':
        $rspta = $servicios->listar($_GET['id']);

        $data = [];
        $comprobante = '';
        $cont = 1;
        $imagen_error = "this.src='../dist/svg/defaul_valor.png'";

        if ($rspta['status']) {

          while ($reg = $rspta['data']->fetch_object()) {
            $data[] = [
              "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idservicio . ')"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="eliminar(' . $reg->idservicio . ')"><i class="far fa-trash-alt"></i></button>',
              "1" =>  '<div class="media">
                        <div class="avatar avatar-circle mr-3">
                          <img onclick="ver_img_perfil(\'' . $reg->icono . '\',\'' . $reg->nombre_servicio . '\')" class="avatar-img cursor-pointer" src="../dist/img/servicios/imagen_perfil/'. $reg->icono .'" onerror="'.$imagen_error.'" alt="Image Description">
                        </div>
                        <div class="media-body">
                          <span class="d-block h5 mb-0">'. $reg->nombre_servicio .'</span>
                          <small class="d-block text-muted"><b>Precio:</b> S/ 56.00</small>
                        </div>
                      </div>',
              "2" => '<div class="bg-color-242244245 " style="overflow: auto; resize: vertical; height: 45px;" >'.$reg->descripcion .'</div>',
              "3" => '<button class="btn btn-info btn-xs" onclick="ver_caracteristicas(\'' . $reg->idservicio . '\')"><i class="fas fa-list-ul"></i></button>',
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => 1, //enviamos el total registros a visualizar
            "data" => $data,
          ];
          echo json_encode($results, true);

        } else {
          echo $rspta['code_error'] . ' - ' . $rspta['message'] . ' ' . $rspta['data'];
        }

      break;

      case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

      break;

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }
  } else {
    require 'noacceso.php';
  }
}

ob_end_flush();

?>
