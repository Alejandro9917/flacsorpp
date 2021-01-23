@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalMetadata"><i
                        class="fas fa-file-alt"></i> Crear Meta data
                </button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_metadata" class="table bg-success table-active table-hover">
                        <caption>List of Data</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del Formulario</th>
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
            getMetadatas();

            $('#modalMetadata').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                getMetadata(id);
            });

            $('#modalAuthor').on('hiden.bs.modal', function (event) {
                clear();
            });
        });

        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                sendMetadata();
            }

            else{
                updateMetadata(id);
            }
        });

        function getMetadatas(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/metadata",
                method: "GET"
            }).done(function(res){
                print(res);
            });
        }

        function getMetadata(id){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/metadata/" + id,
                method: "GET"
            }).done(function(res){
                set(res);
            });
        }

        function sendMetadata(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/metadata",
                method: 'POST',
                data: $("#form_metadata").serialize(),
                success: function(res){
                    console.log(res);
                },
                error: function(res){
                    console.log(res);
                    //setErrors(res.responseJSON.errors);
                }
            });
        }

        function updateMetadata(id){

        }

        function print(metadatas){
            metadatas.map(function(metadata){
                $('#table_metadata').append(
                    "<tr>" +
                    "<td scope='row'>" + metadata.id + "</td>" +
                    "<td>" + metadata.form_name + "</td>" +
                    "<td>" +
                    "<button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalMetadata' data-whatever=" + metadata.id + "><i class='fas fa-pencil-alt'></i> Editar</button>" +
                    "<a href='/public/metadata/"+metadata.id+"/fields' class='btn btn-success'><i class='fas fa-link'></i>Campos</a>" +
                    "</td>" +
                    "</tr>"
                );
            });
        }

        function set(metadata){
            $('#form_name').val(metadata.form_name);
            $('#header').val(metadata.header);
            $('#priority').val(metadata.priority);
            $('#class_container').val(metadata.class_container);
            $('#is_accordion').val(metadata.is_accordion);
            $('#is_collapsed').val(metadata.is_collapsed);
            $('#extra_js').val(metadata.extra_js);
            $('#extra_css').val(metadata.extra_css);
            $('#is_required').val(metadata.is_required);
            $("#send").attr('data-whatever', metadata.id);
        }

        function clear(){
            $('#form_name').val("");
            $('#header').val("");
            $('#priority').val("");
            $('#class_container').val("");
            $('#is_accordion').val("");
            $('#is_collapsed').val("");
            $('#extra_js').val("");
            $('#extra_css').val("");
            $('#is_required').val("");
            $("#send").attr('data-whatever', "null");
        }
    </script>

@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalMetadata" tabindex="-1" role="dialog" aria-labelledby="modalMetadataTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMetadataTitle">Registro de Formularios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_metadata" action="">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="form_name">Nombre Form</label>
                            <input class="form-control" type="text" name="form_name" id="form_name"
                                   placeholder="Nombre del form">
                        </div>
                        <div class="form-group col">
                            <label for="header">Cabeceras</label>
                            <input class="form-control" type="text" name="header" id="header"
                                   placeholder="Cabeceras del formulario">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="priority">Prioridad</label>
                            <input class="form-control" type="number" name="priority" id="priority" value="0" min="0">
                        </div>
                        <div class="form-group col">
                            <label for="class_container">Clase contenedora</label>
                            <input class="form-control" type="text" name="class_container" id="class_container"
                                   placeholder="Clase contenedora">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="is_accordion">Es desplegabe</label>
                            <select name="is_accordion" id="is_accordion" class="form-control">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="is_collapsed">Se colapsa</label>
                            <select name="is_collapsed" id="is_collapsed" class="form-control">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="extra_js">Extra JS</label>
                            <input class="form-control" type="text" name="extra_js" id="extra_js" placeholder="Contiene Js">
                        </div>
                        <div class="form-group col">
                            <label for="extra_css">Extra CSS</label>
                            <input class="form-control" type="text" name="extra_css" id="extra_css"
                                   placeholder="Contiene Css">
                        </div>
                    </div>

                    <div class="form-row form-group">
                        <div class="form-group col">
                            <label for="is_required">Es requerido</label>
                            <select name="is_required" id="is_required" class="form-control">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <a type="submit" id="send" class="btn btn-success float-right" data-whatever="null"><i
                            class="fas fa-cloud-upload-alt"></i> Guardar</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-whatever="null"><i class="fas fa-times-circle"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
