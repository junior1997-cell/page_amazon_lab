var tabla;  

//Función que se ejecuta al inicio
function init() {

  $(".musuarios").addClass("active");

  tbla_principal();

}

function show_hide_form(flag) {
	if (flag == 1)	{		
		$("#mostrar-tabla").show();
    $("#mostrar-form").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar").show();
	}	else	{
		$("#mostrar-tabla").hide();
    $("#mostrar-form").show();
    $(".btn-regresar").show();
    $(".btn-agregar").hide();
	}
}

function permisos() {
  $("#permisos").html('<i class="fas fa-spinner fa-pulse fa-2x"></i>');
  //Permiso
  $.post(`../ajax/usuario.php?op=permisos&id=`, function (e) {

    e = JSON.parse(e); //console.log(r);

    if (e.status == true) { $("#permisos").html(e.data); } else { ver_errores(e); }
    //$("#permiso_4").rules('add', { required: true, messages: {  required: "Campo requerido" } });
    
  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

//Función limpiar
function limpiar_form_usuario() {
  $("#guardar_registro").html('Guardar Cambios').removeClass('disabled');
  // Agregamos la validacion
  $("#trabajador").rules('add', { required: true, messages: {  required: "Campo requerido" } });  
  $("#password").rules('add', { required: true, messages: {  required: "Campo requerido" } });

  //Select2 trabajador
  lista_select2("../ajax/usuario.php?op=select2Trabajador", '#trabajador', null);
 
  $("#idusuario").val("");
  $("#trabajador_c").html("Trabajador");   
  $("#trabajador_old").val(""); 
  $("#cargo").val("").trigger("change"); 
  $("#login").val("");
  $("#password").val("");
  $("#password-old").val(""); 
  
  $(".modal-title").html("Agregar usuario");    

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function tbla_principal() {


  tabla = $('#tabla-usuarios').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [ { extend: 'excelHtml5'}, { extend: 'pdfHtml5'}],
    ajax:{
      url: '../ajax/usuario.php?op=tbla_principal',
      type : "get",
      dataType : "json",						
      error: function(e){        
        console.log(e.responseText); ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {    

      // columna: 1
      if (data[1] != '') {
        $("td", row).eq(1).addClass("text-center text-nowrap");   
          
      }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 5,//Paginación
    order: [[ 0, "asc" ]],//Ordenar (columna,orden)
  }).DataTable();

  $(".tabla").show();
  $(".cargando").hide();
}

//ver perfil
function ver_img_perfil(img_perfil,nombre_usuario){

  $('#modal-ver-imagen').modal("show");
  $('#nombre_usuario').html(nombre_usuario);

  if (img_perfil == "" || img_perfil == null  ) {

    $("#ver_imagen").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');

  } else {

    $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(img_perfil)}</i></div></div>`);
    
    // cargamos la imagen adecuada par el archivo
    if ( extrae_extencion(img_perfil) == "pdf" ) {

      $("#ver_imagen").html(`<iframe src="${img_perfil}" frameborder="0" scrolling="no" width="100%" height="210"> </iframe>`);

    }else{
      if (
        extrae_extencion(img_perfil) == "jpeg" || extrae_extencion(img_perfil) == "jpg" || extrae_extencion(img_perfil) == "jpe" ||
        extrae_extencion(img_perfil) == "jfif" || extrae_extencion(img_perfil) == "gif" || extrae_extencion(img_perfil) == "png" ||
        extrae_extencion(img_perfil) == "tiff" || extrae_extencion(img_perfil) == "tif" || extrae_extencion(img_perfil) == "webp" ||
        extrae_extencion(img_perfil) == "bmp" || extrae_extencion(img_perfil) == "svg" ) {

        $("#ver_imagen").html(`<img src="${img_perfil}" alt="" width="80%" onerror="this.src='../dist/svg/error-404-x.svg';" >`); 
        
      } else {
        $("#ver_imagen").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');
      }        
    }      
  }

}

init();
