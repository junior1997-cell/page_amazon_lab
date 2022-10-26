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
    
    case 'permisos':
      //Obtenemos todos los permisos de la tabla permisos      
      $rspta = $permisos->listar();

      if ( $rspta['status'] ) {

        //Obtener los permisos asignados al usuario
        $id = $_GET['id'];
        $marcados = $usuario->listarmarcados($id);
        //Declaramos el array para almacenar todos los permisos marcados
        $valores = [];

        if ($marcados['status']) {

          //Almacenar los permisos asignados al usuario en el array
          foreach ($marcados['data'] as $key => $value) {
            array_push($valores, $value['idpermiso']);
          }

          $data = ""; $num = 8;  $stado_close = false;
          //Mostramos la lista de permisos en la vista y si están o no marcados <label for=""></label>
          foreach ($rspta['data'] as $key => $value) {

            $div_open = ''; $div_close = '';

            if ( ($key + 1) == 1 ) {                  
              $div_open = '<ol class="list-unstyled row"><div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">'. 
              '<li class="text-primary"><input class="h-1rem w-1rem" type="checkbox" id="marcar_todo" onclick="marcar_todos_permiso();"> ' .
                '<label for="marcar_todo" class="marcar_todo">Marcar Todo</label>'.
              '</li>';                 
            } else {
              if ( ($key + 1) == $num ) { 
                $div_close = '</div>';
                $num += 9;
                $stado_close = true;
              } else {
                if ($stado_close) {
                  $div_open = '<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">';
                  $stado_close = false; 
                }             
              }
            }               
            
            $sw = in_array($value['idpermiso'], $valores) ? 'checked' : '';

            $data .= $div_open.'<li>'. 
              '<div class="form-group mb-0">'.
                '<div class="custom-control custom-checkbox">'.
                  '<input id="permiso_'.$value['idpermiso'].'" class="custom-control-input permiso h-1rem w-1rem" type="checkbox" ' . $sw . ' name="permiso[]" value="' . $value['idpermiso'] . '"> '.
                  '<label for="permiso_'.$value['idpermiso'].'" class="custom-control-label font-weight-normal" >' .$value['icono'] .' '. $value['nombre'].'</label>' . 
                '</div>'.
              '</div>'.
            '</li>'. $div_close;
          }

          $retorno = array(
            'status' => true, 
            'message' => 'Salió todo ok', 
            'data' => $data.'</ol>', 
          );

          echo json_encode($retorno, true);

        } else {
          echo json_encode($marcados, true);
        }

      } else {
        echo json_encode($rspta, true);
      }    

    break;    

    default: 
      $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
    break;
    
  }

  ob_end_flush();
?>
