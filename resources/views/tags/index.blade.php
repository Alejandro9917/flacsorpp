
@extends('partials.app')

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
               <input type="search" class="form-control" placeholder="Buscar...">
           </div>
           <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
               <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalTag"><i class="fas fa-file-alt"></i> Crear Tags</button>
           </div>

           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
               <div class="table-responsive-md ">
                   <table id="table_tag" class="table bg-success table-active table-hover">
                       <caption>List of Tags</caption>
                       <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th scope="col">Código</th>
                           <th scope="col">Nombre</th>
                           <th scope="col">Color</th>
                           <th scope="col">Actualizado el</th>
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
        $(document).ready(function() {
            //Se llama a la función para obtener y pintar los datos
            gets();

            //Se imprimen los datos de cada tag en el modal asigando 
            $('#modalTag').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                //Se obtienen los datos de un único tag mediante un request
                get(id);
            });

            $('#modalTag').on('hiden.bs.modal', function (event) {
                //Se limpian los datos
                clear();
            });
        });

        //Evento cuando se cree un nuevo tag
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
            var table = $("#table_tag tbody").empty();
            
            //Se obtienen los datos
            gets();

            //Se limpian los datos
            clear();
        });

        //Función para obtener los datos por ajax
        function gets(){
            //Se obtienen los tags
            $.ajax({
                url: "http://127.0.0.1:8000/tag",
                method: "GET"

            }).done(function(res){
                //Captura los datos de la api
                var response = res;

                //Envia los datos a la función para pintarlos
                print(response);
            });
        }

        //Función para obtener los datos de un solo tag
        function get(id){
            //Se obtienen los tags
            $.ajax({
                url: "http://127.0.0.1:8000/tag/" + id,
                method: "GET",
                success: function(res){
                    //Captura los datos de la api
                    var response = res;

                    //Envia los datos a la función para pintarlos
                    set(response);
                }
            });
        }

        //Función para guardar los datos
        function send(){
            //Se crea un objeto ajax
            $.ajax({            
                url: "{{ url('tag') }}",
                method: 'POST',
                data: $("#form_tag").serialize(),
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    console.log(response.responseJSON.errors);
                }
            });
        }

        //Función para actualizar los datos
        function update(id){
            //Se crea un objeto ajax
            $.ajax({            
                url: "http://127.0.0.1:8000/tag/" + id,
                method: 'PUT',
                data: $("#form_tag").serialize(),
                success: function(res){
                    var response = res;
                },
                error: function(res){
                    var response = res;
                    console.log(response.responseJSON.errors);
                }
            });
        }

        //Función para pintar datos en pantalla
        function print(tags){
            //Iprime los datos obtenidos en la tabla
            tags.map(function(tag){
                $("#table_tag").append(
                "<tr>" +
                "<th scope='row'>" + tag.id + "</th>" +
                "<td>" + tag.cod_tag + "</td>" +
                "<td>" + tag.name + "</td>" +
                "<td>" + tag.color + "</td>" +
                "<td>" + tag.updated_at + "</td>" +
                "<td><button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalTag' data-whatever=" + tag.id + "><i class='fas fa-pencil-alt'></i> Editar</button></td>" +
                "</tr>");
            });
        }

        //Función para pintar los datos en el formulario 
        function set(tag){
            $("#cod_tag").val(tag.cod_tag);
            $("#name").val(tag.name);
            $("#color").val(tag.color);
            $("#send").attr('data-whatever', tag.id);
        }

        //Función para limpiar los campos
        function clear(){
            $("#cod_tag").val(0);
            $("#name").val("");
            $("#color").val("");
            $("#send").attr('data-whatever', "null");
        }
    </script>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalTag" tabindex="-1" role="dialog" aria-labelledby="modalTagTitl" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTagTitle">Registro de Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_tag" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="cod_tag">Codigo</label>
                        <input class="form-control" type="number" name="cod_tag" id="cod_tag" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Nombre del tag">
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input class="form-control" type="text" name="color" id="color" placeholder="Color del tag">
                    </div>

                    <a type="submit" id="send" class="btn btn-success float-right" data-whatever="null"><i class="fas fa-cloud-upload-alt"></i> Guardar</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
