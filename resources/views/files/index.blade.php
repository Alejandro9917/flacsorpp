@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar documentos...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalFile"><i class="fas fa-file-alt"></i> Crear Documento</button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_file" class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo de documento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Creado por</th>
                            <th scope="col">Modificado</th>
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
        $(document).ready(function(){
            getFiles();

            $('#modalFile').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');
                getFile(id);
            });

            $('#modalFile').on('hiden.bs.modal', function (event) {
                clear();
            });
        });

        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                send();
            }

            else{
                update(id);
            }

            var table = $("#table_file tbody").empty();

            clearErrors();
            getFiles();
            clear();
        });

        function getFiles(){
            $.ajax({
                url: "http://127.0.0.1:8000/file",
                method: "GET",
                error: function(res){
                    var response = res;
                    },
            }).done(function(res){
                    var response = res;
                    print(response);
                });
        }

        function getFile(id){
            $.ajax({
                url: "http://127.0.0.1:8000/file/" + id,
                method: "GET",
                error: function(res){
                }
            }).done(function(res){
                    var response = res;
                    set(response);
                });
        }

        function send(){
            $.ajax({            
                url: "{{ url('file') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#name").val(),
                    type: $("#type").val(),
                    status: $("#status").val(),
                    created_by: 1,
                    collection_id: 3
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

        function update(id){
            $.ajax({            
                url: "http://127.0.0.1:8000/file/" + id,
                method: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#name").val(),
                    type: $("#type").val(),
                    status: $("#status").val(),
                    created_by: 1,
                    collection_id: 3
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

        function print(files){
            files.map(function(file){
                $("#table_file").append(
                    "<tr>" +
                    "<th scope='row'>" + file.id + "</th>" +
                    "<td>" + file.name + "</td>" +
                    "<td>" + file.type + "</td>" +
                    "<td>" + (file.status ? "Activo" : "Inactivo") + "</td>" +
                    "<td>" + file.user.name + "</td>" +
                    "<td>" + file.updated_at + "</td>" +
                    "<td><button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalFile' data-whatever=" + file.id + "><i class='fas fa-pencil-alt'></i> Editar</button></td>" +
                    "</tr>"
                );
            });
        }

        function set(file){
            $("#name").val(file.name);
            $("#type").val(file.type);
            $("#status").val(file.status);
            $("#send").attr('data-whatever', file.id);
        }

        function setErrors(error){
            $("#name").after("<span class='text-danger'>" + error.name + "</span>");
            $("#type").after("<span class='text-danger'>" + error.type + "</span>");
            $("#status").after("<span class='text-danger'>" + error.status + "</span>");
        }

        function clearErrors(){
            $(".text-danger").remove();
        }

        function clear(){
            $("#name").val("");
            $("#type").val("");
            $("#status").val("");
            $("#send").attr('data-whatever', null);
        }
    </script>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalFile" tabindex="-1" role="dialog"
     aria-labelledby="modalFileTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFileTitle">Registro de Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formFile" action="">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Nombre del documento">


                        <label for="type">Tipo de documento</label>
                        <input class="form-control" type="text" name="type" id="type" placeholder="Tipo de documento">


                        <label for="status">Estado</label>
                        <input class="form-control" type="text" name="status" id="status" placeholder="Estado">
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


{{-- Modal para los links dentro de las opciones de Documentos --}}
<!-- Modal -->
<div class="modal fade shadow-sm" id="exampleModalLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Registro de Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>
                    Crear Nuevo
                </button>
                <div class="table-responsive">
                    <table class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Cumpleaños</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        <tr>
                            <th scope="row">1 <button type="submit" class="btn bg-success" data-dismiss="modal"><i class="far fa-check-circle"></i></button></th>
                            <td>Lyan Miller</td>
                            <td>Raynolds Raynolds</td>
                            <td>20-03-1997</td>
                            <td>ryan@testing.com</td>
                        </tr>
                        <tr>
                            <th scope="row">2 <button type="submit" class="btn bg-success" data-dismiss="modal"><i class="far fa-check-circle"></i></button></th>
                            <td>Cristiano</td>
                            <td>Ronaldo</td>
                            <td>21-09-1992</td>
                            <td>cr7@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">3 <button type="submit" class="btn bg-success" data-dismiss="modal"><i class="far fa-check-circle"></i></button></th>
                            <td>Carlos</td>
                            <td>Azaustre</td>
                            <td>09-12-1987</td>
                            <td>carlosazaustre@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
