var tabla;
var id_get = varaibles_get();
var id =id_get.id;
var carpeta =id_get.carpeta;
console.log(carpeta);

//Función que se ejecuta al inicio
$(document).on("ready", function () {

  $(`.mservicios${id_get.id}`).addClass("active");
  $("#id_paginaweb").val(id_get.id);
  $("#carpeta_pag").val(id_get.carpeta);

  listar(id_get.id);  

  $("#guardar_registro").on("click", function (e) {$("#submit-form-servicios").submit();});

});

// abrimos el navegador de archivos
$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });

// Eliminamos el doc 1
function doc1_eliminar() {

	$("#doc1").val("");

	$("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

	$("#doc1_nombre").html("");

}
//revisualizar imagen
$(document).ready(function() {
  $('.revisualizar').attr("onclick",`1, 'admin/dist/img/${carpeta}/img'`);
  //console.log($('.revisualizar').attr("onclick"));
});

//Función limpiar
function limpiar() {

  $("#idservicio").val("");
  $("#nombre").val("");
  $("#precio").val("");
  $("#descripcion").val(""); 
  $("#caracteristicas").val("");
  $(".clss_caracteristicas").html("");

  $("#doc_old_1").val("");
  $("#doc1").val("");  
  $('#doc1_ver').html(`<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >`);
  $('#doc1_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

}

function listar(id) {

  $(".tabla").hide();
  $(".cargando").show();

  tabla=$('#tabla-servicios').dataTable({
    "responsive": true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['excelHtml5','pdf'],
    "ajax":{
        url: `../ajax/servicios.php?op=listar&id=${id}&carpeta=${carpeta}`,
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
      createdRow: function (row, data, ixdex) {

        $("td", row).addClass('class_table');
        if (data[0] != '') { $("td", row).eq(0).addClass('text-center'); }
        if (data[2] != '') { $("td", row).eq(2).addClass('text-nowrap'); }
        if (data[3] != '') { $("td", row).eq(3).addClass('text-center'); }

      },
    "language": {
      "lengthMenu": "Mostrar: _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)

  }).DataTable();

  $(".tabla").show();
  $(".cargando").hide();
  
}
//ver ficha tecnica
function ver_img_perfil(img_perfil,nombre_servicio){

  $('#modal-ver-imagen').modal("show");
  $('#nombre_servicio').html(nombre_servicio);

  if (img_perfil == "" || img_perfil == null  ) {

    $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/svg/drag-n-drop.svg" style="width: 100%;"  alt="Image Description"></img>`)
  
   }else{
     
    $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/${carpeta}/img/${img_perfil}" style="width: 100%;"  alt="Image Description"></img>`)
 
   }

}

//ver caracteristicas
function ver_caracteristicas(idservicio){
  // console.log(idservicio+'  - '+idservicio);


  $("#modal-ver-caracteristicas").modal("show");

  $.post("../ajax/servicios.php?op=mostrar_servicio", { idservicio: idservicio }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {

      if (e.data.caracteristicas==null || caracteristicas=="" || e.data.caracteristicas=='<p><br></p>') {
        $(".nombre_s").html(e.data.nombre_servicio);

        $(".listar_caracteristicas").html(`<div class="col-lg-12">
        <div class="cbp-item product">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Ninguna Característica por mostrar!</strong> puede editar el registro y agregar características.
          </div>
        </div>
      </div>`);
        
      } else {
        $(".nombre_s").html(e.data.nombre_servicio);
        $(".listar_caracteristicas").html(e.data.caracteristicas);
      }
    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { console.log(e); ver_errores(e); } );
 
}

//Función para guardar o editar
function guardaryeditar(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#caracteristicas").val($(".clss_caracteristicas").html());
  var formData = new FormData($("#form-servicios")[0]);
 
  $.ajax({
    url: "../ajax/servicios.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {             
      try {
        e = JSON.parse(e);  console.log(e);   
        if (e.status == true) {
          Swal.fire("Correcto!", "Registrado correctamente", "success");
          tabla.ajax.reload();         
          limpiar();  
          $("#modal-agregar-servicios").modal("hide");   
        }else{    
          ver_errores(e);
        }            
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 
      $("#guardar_registro").html('Actualizar').removeClass('disabled');
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress").css({"width": percentComplete+'%'});
          $("#barra_progress").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress").css({ width: "0%",  });
      $("#barra_progress").text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress").css({ width: "0%", });
      $("#barra_progress").text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar(idservicio) {
  limpiar();
  $("#modal-agregar-servicios").modal("show");
  //$("#proveedor").val("").trigger("change"); 
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/servicios.php?op=mostrar_servicio", { idservicio: idservicio }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {      

      $("#id_paginaweb").val(e.data.idpagina_web);
      $("#idservicio").val(e.data.idservicio);
      $("#nombre").val(e.data.nombre_servicio);
      $("#precio").val(e.data.precio);
      $("#descripcion").val(e.data.descripcion);
      $("#caracteristicas").val(e.data.caracteristicas);
      $(".clss_caracteristicas").html(e.data.caracteristicas);
      
      if (e.data.icono == "" || e.data.icono == null  ) {

        $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
        $("#doc1_nombre").html('');
        $("#doc_old_1").val(""); $("#doc1").val("");

      } else {

        $("#doc_old_1").val(e.data.icono); 
        $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(e.data.icono)}</i></div></div>`);
        $("#doc1_ver").html(doc_view_extencion(e.data.icono, `admin/dist/${carpeta}/img`, '100%'));        
      } 

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

//Función para eliminar registros
function eliminar(idservicio) {
  Swal.fire({
    title: "¿Está Seguro de  Eliminar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/servicios.php?op=eliminar", { idservicio: idservicio }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
    
        tabla.ajax.reload();
        total();
      });      
    }
  });   
}

var idproyecto=0;
$(function () {

  
  $.validator.setDefaults({

    submitHandler: function (e) {
        guardaryeditar(e);
      
    },
  });
  

  $("#form-servicios").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {

      nombre:{required: true},
      descripcion:{required: true}, 
      // terms: { required: true },
    },
    messages: {

        nombre: { required: "Campo requerido", },
        descripcion: { required: "Campo requerido", }, 

    },
        
    errorElement: "span",

    errorPlacement: function (error, element) {

      error.addClass("invalid-feedback");

      element.closest(".form-group").append(error);
    },

    highlight: function (element, errorClass, validClass) {

      $(element).addClass("is-invalid").removeClass("is-valid");
    },

    unhighlight: function (element, errorClass, validClass) {

      $(element).removeClass("is-invalid").addClass("is-valid");
   
    },


  });

});

function extrae_extencion(filename) {
    return filename.split('.').pop();
  }



