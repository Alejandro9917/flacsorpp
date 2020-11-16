@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal"
                        data-target="#modalCitation"><i class="fas fa-file-alt"></i> Crear Citación
                </button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_citation" class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Título</th>
                            <th scope="col">Punto</th>
                            <th scope="col">Referencias</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <script type="text/javascript">
        //Evento cuando termine de cargar la página 
        $(document).ready(function(){
            //Se obtienen los datos
            getCitations();

            //Se imprimen los datos de cada tag en el modal asigando 
            $('#modalCitation').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                //Se obtienen los datos de un único tag mediante un request
                getCitation(id);
            });

            $('#modalCitation').on('hiden.bs.modal', function (event) {
                //Se limpian los datos
                clear();
            });
        });

        //Evento al enviar datos
        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                //Se envían los datos
                send();
            }

            else{
                update(id);
            }

            //Limpiando la tabla
            var table = $("#table_citation tbody").empty();

            //Limpiando mensajes de error
            clearErrors();

            //Se obtienen los datos
            getCitations();

            //Se limpian los datos
            clear();
        });

        //Función para obtener las citaciones
        function getCitations(){
            //Se obtienen los autores
            $.ajax({
                url: "http://127.0.0.1:8000/citation",
                method: "GET"

            }).done(function(res){
                //Captura los datos de la api
                var response = res;

                //Envia los datos a la función para pintarlos
                print(response);
            });
        }

        //Función para obtener una sola citación
        function getCitation(id){
            //Se obtienen los tags
            $.ajax({
                url: "http://127.0.0.1:8000/citation/" + id,
                method: "GET",
                success: function(res){
                    //Captura los datos de la api
                    var response = res;

                    //Envia los datos a la función para pintarlos
                    set(response);
                }
            });
        }

        //Función para agregar citaciones 
        function send(){
            //Se crea un objeto ajax
            $.ajax({            
                url: "http://127.0.0.1:8000/citation",
                method: 'POST',
                data: {
                    _token: "hwDjTqcEaTwyiDJyIgut5jKvNw7JtRyNq7VrQZ5x",
                    content: $("#content").val(),
                    title: $("#title").val(),
                    pointer: $("#pointer").val(),
                    reference: $("#reference").val(),
                    file_id: 1,
                },
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    setErrors(response.responseJSON.errors);
                }
            });
        }

        //Función para actualizar una citación
        function update(id){
            //Se crea un objeto ajax
            $.ajax({            
                url: "http://127.0.0.1:8000/citation/" + id,
                method: 'PUT',
                data: {
                    _token: "hwDjTqcEaTwyiDJyIgut5jKvNw7JtRyNq7VrQZ5x",
                    content: $("#content").val(),
                    title: $("#title").val(),
                    pointer: $("#pointer").val(),
                    reference: $("#reference").val(),
                    file_id: 1,
                },
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    setErrors(response.responseJSON.errors);
                }
            });
        }

        //Función para pintar las citaciones en la tabla 
        function print(citations){
            //Imprime los datos obtenidos
            citations.map(function(citation){
                $("#table_citation").append(
                    "<tr>" +
                    "<th scope='row'>" + citation.id + "</th>" +
                    "<td>" + citation.content + "</td>" +
                    "<td>" + citation.title + "</td>" +
                    "<td>" + citation.pointer + "</td>" +
                    "<td>" + citation.reference + "</td>" +
                    "<td><button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalCitation' data-whatever=" + citation.id + "><i class='fas fa-pencil-alt'></i> Editar</button></td>" +
                    "</tr>"
                );
            });
        }

        //Función para pintar los datos en el formulario
        function set(citation){
            $("#content").val(citation.content);
            $("#title").val(citation.title);
            $("#pointer").val(citation.pointer);
            $("#reference").val(citation.reference);
            $("#send").attr('data-whatever', citation.id);
        }

        //Función para pintar los datos en el formulario
        function setErrors(erros){
            $("#content").after("<span class='text-danger'>" + errors.content + "</span>");
            $("#title").after("<span class='text-danger'>" + errors.title + "</span>");
            $("#pointer").after("<span class='text-danger'>" + errors.pointer + "</span>");
            $("#reference").after("<span class='text-danger'>" + errors.reference + "</span>");
        }

        //Función para eliminar los mensajes de error el en form
        function clearErrors(){
            $(".text-danger").remove();
        }

        //Función para limpiar los datos del formulario
        function clear(){
            $("#content").val();
            $("#title").val();
            $("#pointer").val();
            $("#reference").val();
            $("#send").attr('data-whatever', null);
        }
    </script>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalCitation" tabindex="-1" role="dialog" aria-labelledby="modalCitationTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCitationTitle">Registro de Citaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCitation" action="">
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <input class="form-control" type="text" name="content" id="content" placeholder="Ingrese el Contenido">
                    </div>

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Ingrese el titulo">
                    </div>

                    <div class="form-group">
                        <label for="pointer">Punto</label>
                        <input class="form-control" type="text" name="pointer" id="pointer"
                               placeholder="Punto de la citación">
                    </div>

                    <div class="form-group">
                        <label for="reference">Referencias</label>
                        <input class="form-control" type="text" name="reference" id="reference"
                               placeholder="Referencias de la citación">
                    </div>

                    <div class="form-group">
                        <label for="file_id">Pertenece a un archivo?</label>
                        <select name="file_id" id="file_id" class="form-control">
                            <option value="0" selected disabled>Seleccione...</option>
                            <option value="1">Opcion #1</option>
                            <option value="2">Opcion #2</option>
                        </select>
                    </div>

                    <a id="send" type="submit" class="btn btn-success float-right" data-whatever="null"><i class="fas fa-cloud-upload-alt"></i>Guardar</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
