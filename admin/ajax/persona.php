<?php

  ob_start();

  if (strlen(session_id()) < 1) {

    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {

    //Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['trabajadores'] == 1) {

      require_once "../modelos/Persona.php";

      $persona = new Persona();

      date_default_timezone_set('America/Lima');
      $date_now = date("d-m-Y h.i.s A");

      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      
      $idpersona	  	= isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
      $nombre 		      = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $tipo_documento 	= isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
      $num_documento  	= isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
      $direccion		    = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
      $telefono		      = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";     
      $email			      = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
      $cargo_persona     = isset($_POST["cargo_persona"])? $_POST["cargo_persona"] :"";



      // foto1, 
      // foto1_actual, 

      // $idpersona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, 
       
      $imagen1			    = isset($_POST["foto1"])? limpiarCadena($_POST["foto1"]):"";
      switch ($_GET["op"]) {

        case 'guardaryeditar':

          // imgen de perfil
          if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {

						$imagen1=$_POST["foto1_actual"]; $flat_img1 = false;

					} else {

						$ext1 = explode(".", $_FILES["foto1"]["name"]); $flat_img1 = true;						

            $imagen1 = $date_now .' '. rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/img/persona/perfil/" . $imagen1);
						
					}

          if (empty($idpersona)){
            
            $rspta=$persona->insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $persona->obtenerImg($idpersona);
              $img1_ant = $datos_f1['data']['foto_perfil'];
              if ($img1_ant != "") { unlink("../dist/img/persona/perfil/" . $img1_ant);  }
            }            

            // editamos un persona existente
            // $rspta=$persona->editar($idpersona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1);
            
            echo json_encode($rspta, true);
          }            

        break;

        case 'desactivar':

          $rspta=$persona->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$persona->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$persona->mostrar($idpersona);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$persona->tbla_principal($_GET["tipo_persona"]);
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {         
          
              $data[]=array(
                "0"=>$cont++,
                "1"=>'<button class="btn btn-warning btn-sm" onclick="mostrar('.$value['idpersona'].')" data-toggle="tooltip" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></button>'.
                  ' <button class="btn btn-danger btn-sm" onclick="eliminar_persona('.$value['idpersona'].', \''.encodeCadenaHtml($value['nombres']).'\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>'<div class="user-block">
                  <img class="img-circle" src="../dist/img/persona/perfil/'. $value['foto_perfil'] .'" alt="User Image" onerror="'.$imagen_error.'">
                  <span class="username"><p class="text-primary m-b-02rem" >'. $value['nombres'] .'</p></span>
                  <span class="description">'. $value['tipo_documento'] .': '. $value['numero_documento'] .' </span>
                  </div>',
                "3"=> $value['direccion'],
                "4"=>'<a href="tel:+51'.quitar_guion($value['celular']).'" data-toggle="tooltip" data-original-title="Llamar al persona.">'. $value['celular'] . '</a>',
                "5"=> '<b>'.$value['banco'] .': </b>'. $value['cuenta_bancaria'] .' <br> <b>CCI: </b>'.$value['cci'],
                "6"=>(($value['estado'])?'<span class="text-center badge badge-success">Activado</span>': '<span class="text-center badge badge-danger">Desactivado</span>').$toltip,
                "7"=> $value['nombres'],
                "8"=> $value['tipo_documento'],
                "9"=> $value['numero_documento'],
                "10"=> $value['banco'],
                "11"=> $value['cuenta_bancaria'],
                "12"=> $value['cci']

              );
            }
            $results = array(
              "sEcho"=>1, //Información para el datatables
              "iTotalRecords"=>count($data), //enviamos el total registros al datatable
              "iTotalDisplayRecords"=>1, //enviamos el total registros a visualizar
              "data"=>$data);
            echo json_encode($results, true);

          } else {
            echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
          }
        break;  

        case 'verdatos':
          $rspta=$persona->verdatos($idpersona);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);
        break;        

        case 'formato_banco':           
          $rspta=$persona->formato_banco($_POST["idbanco"]);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);           
        break;

        /* =========================== S E C C I O N   R E C U P E R A R   B A N C O S =========================== */
        case 'recuperar_banco':           
          $rspta=$persona->recuperar_banco();
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);           
        break;
        /* =========================== S E C C I O N  T I P O   P E R S O N A  =========================== */
        case 'cargo_persona':

          $rspta=$persona->cargo();
          $data = "";

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $reg) { 
             $data .= '<option value=' . $reg['idcargo_persona'] . '>' . $reg['nombre_cargo'] . '</option>';
           }
           $retorno = array(
             'status' => true, 
             'message' => 'Salió todo ok', 
             'data' => $data, 
           );
   
           echo json_encode($retorno, true);
 
         } else {
 
           echo json_encode($rspta, true); 
         }

      }

      //Fin de las validaciones de acceso
    } else {
      $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
      echo json_encode($retorno);
    }
  }

  ob_end_flush();

?>
