@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar documentos...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalCollection"><i class="fas fa-file-alt"></i> Crear Colección</button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_collections" class="table bg-success table-active table-hover">
                        <caption>Listado de Colecciones</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Propiedades</th>
                            <th scope="col">Creada por</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Entrar</th>
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

    <script>
        $(document).ready(function(){
            $('#modalCollection').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                getCollection(id);
            });

            $('#modalCollection').on('hiden.bs.modal', function (event) {
                clear();
            });

            $("#name").keyup(function(e){
                $("#slug").val($("#name").val().toLowerCase().replace(/ /gi, "-"));
            });

            getCollections();
        });

        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                send();
            }

            else{
                update(id);
            }

            var table = $("#table_collections tbody").empty();
            clearErrors();
            getCollections();
            clear();
        });

        function getCollections(){
            $.ajax({
                url: "http://127.0.0.1:8000/collection",
                method: "GET"

            }).done(function(res){
                var response = res;
                print(response);
            });
        }

        function getCollection(id){
            $.ajax({
                url: "http://127.0.0.1:8000/collection/" + id,
                method: "GET"
            }).done(function(res){
                    var response = res;
                    set(response);
            });
        }

        function send(){
            var now = new Date();
            $.ajax({            
                url: "http://127.0.0.1:8000/collection/",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#name").val(),
                    slug: $("#slug").val(),
                    priority: $("#priority").val(),
                    is_folder: $("#is_folder").val(),
                    is_public: $("#is_public").val(),
                    status: $("#status").val(),
                    created_by: {{ Auth::user()->id }}
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
                url: "http://127.0.0.1:8000/collection/" + id,
                method: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#name").val(),
                    slug: $("#slug").val(),
                    priority: $("#priority").val(),
                    is_folder: $("#is_folder").val(),
                    is_public: $("#is_public").val(),
                    status: $("#status").val()
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

        function print(collections){
            collections.map(function(collection){
                $("#table_collections").append(
                    "<tr>" + 
                    "<th scope=row>" + collection.id + "</th>" +
                    "<td>" + collection.name + "</td>" +
                    "<td>" + (collection.is_folder ? "Es una carpeta" : "Es una colección") + " | " + (collection.is_public ? "Carpeta pública" : "Carpet privada") + "</td>" +
                    "<td>" + collection.user.name + "</td>" +
                    "<td>" + (collection.status ? "Activo" : "Inactivo") + "</td>" +
                    "<td>" +
                        "<a href='http://127.0.0.1:8000/" + (collection.is_folder ? 'file':'collection') + "/in/" + collection.slug + "' " +
                        "class='btn btn-warning' data-toggle=tooltip data-placement=bottom title='Entrar a la colección'>" +
                        "<i class='fas " + (collection.is_folder ? 'fa-file':'fa-folder') + "'></i>" +
                        "</a>" +                        
                    "</td>" +
                    "<td><button type='submit' class='btn btn-info' data-toggle='modal' data-target='#modalCollection' data-whatever=" + collection.id + ">Editar <i class='fa fa-pencil-alt'></i></button></td>" +
                    "</tr>"
                );
            });
        }

        function set(collection){
            $("#name").val(collection.name);
            $("#slug").val(collection.slug);
            $("#priority").val(collection.priority);
            $("#is_folder").val(collection.is_folder);
            $("#is_public").val(collection.is_public);
            $("#status").val(collection.status);
            $("#send").attr('data-whatever', collection.id);
        }

        function setErrors(errors){
            $("#name").after("<span class='text-danger'>" + errors.name + "</span>");
            $("#slug").after("<span class='text-danger'>" + errors.slug + "</span>");
            $("#priority").after("<span class='text-danger'>" + errors.priority + "</span>");
            $("#is_folder").after("<span class='text-danger'>" + errors.is_folder + "</span>");
            $("#is_public").after("<span class='text-danger'>" + errors.is_public + "</span>");
            $("#status").after("<span class='text-danger'>" + errors.status + "</span>");
        }

        function clearErrors(){
            $(".text-danger").remove();
        }

        function clear(){
            $("#name").val();
            $("#slug").val();
            $("#priority").val();
            $("#is_folder").val();
            $("#is_public").val();
            $("#status").val();
            $("#send").attr('data-whatever', "null");
        }
    </script>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalCollection" tabindex="-1" role="dialog" aria-labelledby="modalCollectionTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCollectionTitle">Registro de Colecciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                <label for="name">Nombre</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Nombre del documento">
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Ingrese el Slug">
                            </div>
                        {{-- </div> --}}
                        
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="priority">Prioridad</label>
                            <input class="form-control" type="number" name="priority" id="priority" min="0" max="5">
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-xl-6 col-lg-6">
                            <label for="status">Estado</label>
                            <select class="form-control" id="status" name="status">
                                <option selected disabled>Seleccione...</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-xl-6 col-lg-6">    
                            <label for="is_folder">¿Es una carpeta de documentos?</label>
                            <select class="form-control" name="is_folder" id="is_folder">
                                <option selected disabled>Seleccione...</option>
                                <option value="1">Si.</option>
                                <option value="0">No.</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-xl-6 col-lg-6"> 
                            <label for="is_public">¿Esta es una colección pública?</label>
                            <select class="form-control" name="is_public" id="is_public">
                                <option selected disabled>Seleccione...</option>
                                <option value="1">Si.</option>
                                <option value="0">No.</option>
                            </select>
                        </div>
                    </div>
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
<div class="modal fade shadow-sm" id="exampleModalLink" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
