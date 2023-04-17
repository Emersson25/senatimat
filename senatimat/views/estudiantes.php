<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
  <!-- Modal trigger button -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-estudiante">
    Launch
  </button>
  
  <!-- Modal Body -->
  <div class="modal fade" id="modal-estudiante" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de estudiantes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-estudiantes">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="tipodocumento" class="form-label">Tipo documento:</label>
                <select name="tipodocumento" id="tipodocumento" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="nrodocumento" class="form-label">Nro documento:</label>
                <input type="text" class="form-control form-control-sm" id="nrodocumento">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="fechanacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" class="form-control form-control-sm" id="fechanacimiento">
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="escuela" class="form-label">Escuela:</label>
                <select name="escuela" id="escuela" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="carrera" class="form-label">Carreras:</label>
                <select name="carrera" id="carrera" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="fotografia">Fotografía:</label>
              <input type="file" id="fotografia" class="form-control form-control-sm">
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary" id="guardar-estudiante">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function (){
      
      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }

      function obtenerEscuelas(){
        $.ajax({
          url: '../controllers/escuela.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function (result){
            $("#escuela").html(result);
          }
        });
      }

      function registrarEstudiante(){
        Swal.fire({
          icon: 'question',
          title: 'Matrículas',
          text: '¿Está seguro de registrar al estudiante?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            console.log("Guardado datos...");
          }
        });
      }

      $("#guardar-estudiante").click(registrarEstudiante);

      //Al cambiar una escuela, se actualizará las carreras
      $("#escuela").change(function (){
        const idescuelaFiltro = $(this).val();

        $.ajax({
          url: '../controllers/carrera.controller.php',
          type: 'POST',
          data: {
            operacion     : 'listar',
            idescuela     : idescuelaFiltro
          },
          dataType: 'text',
          success: function(result){
            $("#carrera").html(result);
          }
        });
      });

      //Predeterminamos un control dentro del modal
      $("#modal-estudiante").on("shown.bs.modal", event => {
        $("#apellidos").focus();

        obtenerSedes();
        obtenerEscuelas();
      });

    });
  </script>

</body>

</html>