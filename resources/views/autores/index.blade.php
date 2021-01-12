
@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar autores...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalAuthor"><i class="fas fa-file-alt"></i> Crear Autor</button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_author" class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Cumpleaños</th>
                            <th scope="col">Email</th>
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
        $(document).ready(function() {
            getAuthors();

            $('#modalAuthor').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                getAuthor(id);
            });

            $('#modalAuthor').on('hiden.bs.modal', function (event) {
                clear();
            });
        });

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
            var table = $("#table_author tbody").empty();

            //Limpiando mensajes de error
            clearErrors();

            //Se obtienen los datos
            getAuthors();

            //Se limpian los datos
            clear();
        });

        //Función para obtener los datos
        function getAuthors(){
            //Se obtienen los autores
            $.ajax({
                url: "http://127.0.0.1:8000/author",
                method: "GET"

            }).done(function(res){
                //Captura los datos de la api
                var response = res;

                //Envia los datos a la función para pintarlos
                print(response);
            });
        }

        //Función para obtener los datos de un usuario
        function getAuthor(id){
            //Se obtienen los tags
            $.ajax({
                url: "http://127.0.0.1:8000/author/" + id,
                method: "GET"
            }).done(function(res){
                    //Captura los datos de la api
                    var response = res;

                    //Envia los datos a la función para pintarlos
                    set(response);
                });
        }

        //Función para agregar un nuevo autor
        function send(){
            //Se crea un objeto ajax
            $.ajax({            
                url: "{{ url('author') }}",
                method: 'POST',
                data: $("#form_author").serialize(),
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    setErrors(response.responseJSON.errors);
                }
            });
        }

        //Función para actualizar los datos de un usuario
        function update(id){
            //Se crea un objeto ajax
            $.ajax({            
                url: "http://127.0.0.1:8000/author/" + id,
                method: 'PUT',
                data: $("#form_author").serialize(),
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    setErrors(response.responseJSON.errors);
                }
            });
        }

        //Función para pintar los datos en la tabla
        function print(authors){
            //Imprime lo datos obtenidos
            authors.map(function(author){
                $("#table_author").append(
                    "<tr>" +
                    "<th scope='row'>" + author.id + "</th>" +
                    "<td>" + author.first_name +  " " + author.second_name + "</td>" +
                    "<td>" + author.first_lastname +  " " + author.second_lastname + "</td>" +
                    "<td>" + author.birthday + "</td>" +
                    "<td>" + author.email + "</td>" +
                    "<td><button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalAuthor' data-whatever=" + author.id + "><i class='fas fa-pencil-alt'></i> Editar</button></td>" +
                    "</tr>"
                );
            });
        }

        //Función para pintar los datos en el formulario 
        function set(author){
            $("#first_name").val(author.first_name);
            $("#second_name").val(author.second_name);
            $("#first_lastname").val(author.first_lastname);
            $("#second_lastname").val(author.second_lastname);
            $("#birthday").val(author.birthday);
            $("#email").val(author.email);
            $("#send").attr('data-whatever', author.id);
        }

        //Función para mostrar errores en el form
        function setErrors(errors){
            $("#first_name").after("<span class='text-danger'>" + errors.first_name + "</span>");
            $("#second_name").after("<span class='text-danger'>" + errors.second_name + "</span>");
            $("#first_lastname").after("<span class='text-danger'>" + errors.first_lastname + "</span>");
            $("#second_lastname").after("<span class='text-danger'>" + errors.second_lastname + "</span>");
            $("#birthday").after("<span class='text-danger'>" + errors.birthday + "</span>");
            $("#email").after("<span class='text-danger'>" + errors.email + "</span>");
        }

        //Función para eliminar los mensajes de error el en form
        function clearErrors(){
            $(".text-danger").remove();
        }

        //Función para limpiar los campos
        function clear(){
            $("#first_name").val();
            $("#second_name").val();
            $("#first_lastname").val();
            $("#second_lastname").val();
            $("#birthday").val();
            $("#email").val();
            $("#send").attr('data-whatever', "null");
        }
    </script>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalAuthor" tabindex="-1" role="dialog" aria-labelledby="modalAuthorTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAuthorTitle">Registro de Autores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_author" action="">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="first_name">Primer Nombre</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Primer Nombre">
                        </div>

                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="second_name">Segundo Nombre</label>
                            <input class="form-control" type="text" name="second_name" id="second_name" placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="first_lastname">Primer Apellido</label>
                            <input class="form-control" type="text" name="first_lastname" id="first_lastname" placeholder="Primer Apellido">
                        </div>

                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="second_lastname">Segundo Apellido</label>
                            <input class="form-control" type="text" name="second_lastname" id="second_lastname" placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group  col-lg-6 col-xl-5">
                            <label for="birthday">Cumpleaños</label>
                            <input class="form-control" type="date" name="birthday" id="birthday">
                        </div>

                        <div class="form-group col-lg-6 col-xl-7">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico">
                        </div>
                    </div>
                    <a id="send" type="submit" class="btn btn-success float-right" data-whatever="null"><i class="fas fa-cloud-upload-alt"></i> Guardar</a>
                </form>

            </div>
            <div class="modal-footer">
                <button id="send" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
