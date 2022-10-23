<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  
  require_once "../modelos/Usuario.php";
  require_once "../modelos/Permiso.php"; 

  $usuario = new Usuario();  
  $permisos = new Permiso();

  switch ($_GET["op"]) {

    case 'verificar':

      $logina = $_POST['logina'];
      $clavea = $_POST['clavea'];

      //Hash SHA256 en la contraseña
      $clavehash = hash("SHA256", $clavea);

      $rspta = $usuario->verificar($logina, $clavehash);   //$fetch = $rspta->fetch_object();
     // echo $rspta;
      if ( $rspta['status'] ) {
        if ( !empty($rspta['data']) ) {

          //Declaramos las variables de sesión
          $_SESSION['idusuario'] = $rspta['data']['idusuario'];
          $_SESSION['nombre'] = $rspta['data']['nombre_persona'];
          $_SESSION['imagen'] = $rspta['data']['foto_perfil'];
          $_SESSION['login'] = $rspta['data']['login'];
          $_SESSION['cargo'] = $rspta['data']['nombre_cargo'];
          $_SESSION['tipo_documento'] = $rspta['data']['tipo_documento'];
          $_SESSION['num_documento'] = $rspta['data']['numero_documento'];
          $_SESSION['telefono'] = $rspta['data']['celular'];
          $_SESSION['email'] = $rspta['data']['correo'];

          //Obtenemos los permisos del usuario
          $marcados = $usuario->listarmarcados($rspta['data']['idusuario']);
          
          //Declaramos el array para almacenar todos los permisos marcados
          $valores = [];

          if ($rspta['status']) {
            //Almacenamos los permisos marcados en el array
            foreach ($marcados['data'] as $key => $value) {
              array_push($valores, $value['idpermiso']);
            }
            echo json_encode($rspta);
          }else{
            echo json_encode($marcados);
          }       

          //Determinamos los accesos del usuario
          in_array(1, $valores) ? ($_SESSION['escritorio'] = 1) : ($_SESSION['escritorio'] = 0);
          in_array(2, $valores) ? ($_SESSION['datos_generales'] = 1) : ($_SESSION['datos_generales'] = 0);
          in_array(3, $valores) ? ($_SESSION['mision_vision'] = 1) : ($_SESSION['mision_vision'] = 0);
          in_array(4, $valores) ? ($_SESSION['ceo_resenia'] = 1) : ($_SESSION['ceo_resenia'] = 0);
          in_array(5, $valores) ? ($_SESSION['valores'] = 1) : ($_SESSION['valores'] = 0);
          in_array(6, $valores) ? ($_SESSION['servicio'] = 1) : ($_SESSION['servicio'] = 0);
          in_array(7, $valores) ? ($_SESSION['cargo'] = 1) : ($_SESSION['cargo'] = 0);
          in_array(8, $valores) ? ($_SESSION['trabajadores'] = 1) : ($_SESSION['trabajadores'] = 0);
          in_array(9, $valores) ? ($_SESSION['usuarios'] = 1) : ($_SESSION['usuarios'] = 0);
        } else {
          echo json_encode($rspta, true);
        }
      }else{
        echo json_encode($rspta, true);
      }
      
    break;

    case 'tbla_principal':

      $rspta = $usuario->listar();
          
      //Vamos a declarar un array
      $data = [];  
      $imagen_error = "this.src='../assets/svg/default/user_default.svg'"; $cont=1;
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

      $img_perfil="http://admin.sevensingenieros.com/dist/docs/all_trabajador/perfil/";


      if ($rspta['status']) {

        foreach ($rspta['data'] as $key => $value) {

          $data[] = [
            "0" => '<div class="d-flex align-items-center mx-auto">
                    <a onclick="ver_img_perfil(\'' .$img_perfil.$value['foto_perfil'] . '\',\'' . $value['nombre_persona'] . '\')">
                      <div class="avatar avatar-circle">
                        <img class="avatar-img" src="'.$img_perfil.$value['foto_perfil'] . '" alt="Image Description" onerror="'.$imagen_error.'">
                      </div>
                    </a>
                    <div class="ml-3">
                      <small style="font-size: 14px;font-weight: bold;">'. $value['nombre_persona'] .'</small> <br>                         
                      <small class="text-muted"> - ' . $value['tipo_documento'] .  ': ' . $value['numero_documento'] .  '</small>
                    </div>
                  </div>',
            "1" => $value['celular'],
            "2" => $value['login'],
            "3" => $value['nombre_cargo']
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
        echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
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

  ob_end_flush();
?>
