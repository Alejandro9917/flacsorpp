@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#modalFieldType"><i
                        class="fas fa-file-alt"></i> Crear tipo de documento
                </button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table id="table_FieldType" class="table bg-success table-active table-hover">
                        <caption>List of Data</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de documento</th>
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
            getFieldTypes();

            $('#modalFieldType').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');

                getFieldType(id);
            });

            $('#modalAuthor').on('hiden.bs.modal', function (event) {
                clear();
            });
        });

        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                sendFieldType();
            }

            else{
                updateFieldType(id);
            }
        });

        function getFieldTypes(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/file_types",
                method: "GET"
            }).done(function(res){
                print(res);
            });
        }

        function getFieldType(id){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/file_types/detail/" + id,
                method: "GET"
            }).done(function(res){
                set(res);
            });
        }

        function sendFieldType(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/file_types",
                method: 'POST',
                data: $("#form_field_type").serialize(),
                success: function(res){
                    console.log(res);
                },
                error: function(res){
                    console.log(res);
                    //setErrors(res.responseJSON.errors);
                }
            });
        }

        function updateFieldType(id){

        }

        function print(FieldTypes){
            FieldTypes.map(function(fileType){
                $('#table_FieldType').append(
                    "<tr>" +
                    "<td scope='row'>" + fileType.id + "</td>" +
                    "<td>" + fileType.name + "</td>" +
                    "<td>" +
                    "<button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalFieldType' data-whatever=" + fileType.id + "><i class='fas fa-pencil-alt'></i> Editar</button>" +
                    "<a href='/public/file_types/"+fileType.id+"/forms' class='btn btn-success'><i class='fas fa-link'></i>Configurar formularios de metadata</a>" +
                    "</td>" +
                    "</tr>"
                );
            });
        }

        function set(FieldType){
            $('#name').val(FieldType.form_name);
            $("#send").attr('data-whatever', FieldType.id);
        }

        function clear(){
            $('#name').val("");
            $("#send").attr('data-whatever', "null");
        }
    </script>

@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalFieldType" tabindex="-1" role="dialog" aria-labelledby="modalFieldTypeTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFieldTypeTitle">Registro de Tipo de archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_field_type" action="">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nombre Documento</label>
                            <input class="form-control" type="text" name="name" id="name"
                                   placeholder="Nombre del documento">
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
