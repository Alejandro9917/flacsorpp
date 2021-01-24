@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>
@section('content')
    <a href="/public/metadata/create" class="btn btn-primary"> Regresar</a>
    <h3 class="title">Formularios para "{{$myFileType->name}}"</h3>

    <div class="row" id="main_field_container">
    
    </div>
    

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campos-modal">
        Añadir Formularios
    </button>

    <script>
        var editor;
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

        
        function getMetadatas(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/file_types/detail/{{$myFileType->id}}",
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

        function sendMetadataField(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/file_types/store_form",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    file_type_id: {{$myFileType->id}},
                    meta_data_forms_id: $("#meta_data_forms_id").val(),
                    visible: $("#visible").val(),
                    
                    
                },
                success: function(res){
                    console.log(res);
                },
                error: function(res){
                    console.log(res);
                    //setErrors(res.responseJSON.errors);
                }
            });
            getMetadatas();
        }

        function updateMetadata(id){

        }

        $("#send").click(function(){
            var id = $("#send").attr('data-whatever');

            if(id == "null"){
                sendMetadataField();
            }

            else{
                updateMetadataField(id);
            }
        });


        function print(metadatas){
            $('#main_field_container').html("");
            metadatas.file_types_metadata_forms.map(function(metadata){
                var form = metadata.metadatas;
                var printHtml = "";

                printHtml = 
                    '<div class="col-md-12">'+
                        '<div class="card mb-6 shadow-sm" >'+
                            '<div class="row no-gutters">'+
                                '<div class="col-md-12">'+
                                    '<div class="card-body row">'+
                                        
                                        '<div class="col-md-4">'+
                                            '<h4>Datos formulario</h4>'+
                                            '<h6>Nombre Formulario</h6> <input class="form-control" disabled type="text" name="metadataform_id_'+ form.id +'" value="'+ form.form_name + '">'+
                                            '<h6>Header name</h6> <input class="form-control" disabled type="text" name="metadataform_header_'+ form.id +'" value="'+ form.header + '">'+
                                            '<h6>Priority</h6> <input class="form-control" disabled type="text" name="metadataform_header_'+ form.id +'" value="'+ form.priority + '">'+
                              
                                        '</div>'+
                                        '<div class="col-md-4">' +
                                        '<h4>Campos de formulario</h4>' +

                                        '<div class="panel-group" id="accordion">';
                                            
                                        



                                        // fields loop
                                        form.fields.map(function(field){
                                            printHtml += '<div class="panel panel-default">' +
                                                '<div class="panel-heading  well">' +
                                                    '<h5 class="panel-title ">' +
                                                        '<a data-toggle="collapse" data-parent="#accordion" href="#collapse_'+ form.id +'_field_'+ field.id +'">' +
                                                        '<span class="badge"> + '+ field.field_name + '</span></a>' +
                                                    '</h5>' +
                                                '</div>' +
                                                '<div id="collapse_'+ form.id +'_field_'+ field.id +'" class="panel-collapse collapse in">' +
                                                    '<div class="panel-body">' +
                                                        '<table class="table">' +
                                                            '<tr><td>Placeholder</td><td>'+field.placeholder+'</td></tr>' +
                                                            '<tr><td>Field type</td><td>'+field.field_type_id+'</td></tr>' +
                                                            '<tr><td>Default Value</td><td>'+field.default_value+'</td></tr>' +
                                                        '</table>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                        });

                                        
                                        printHtml +=    
                                        '</div> </div>'+
                                        '<div class="col-md-4">'+
                                            ' <button class="btn btn-warning">Cambiar visibilidad</button> <br><br> <button class="btn btn-danger">Borrar</button> <br><br>'+
                                            ' <button class="btn btn-primary"> + Prioridad</button> <br><br> <button class="btn btn-primary"> - Prioridad</button>'+
                                        '</div>'+
                                        
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                $('#main_field_container').append(printHtml);
                
                /*
                var temp_editor = ace.edit("editor_" +  metadata.metadatas);
                code= JSON.parse(metadata.json_config);
                temp_editor.setValue(JSON.stringify(code, null, '\n')); 
                temp_editor.setTheme("ace/theme/monokai");
                temp_editor.session.setMode("ace/mode/json");
                /* */
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

<!-- Modal -->
<div class="modal fade" id="campos-modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Campos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-row">
                    <div class="form-group col-4">
                            <label for="meta_data_forms_id">Formulario</label>
                            <select class="form-control" name="meta_data_forms_id" id="meta_data_forms_id">
                                <option value="0" selected disabled>Seleccione...</option>
                                @foreach( $allMetadata as $singleMetadata)
                                    <option  value="{{$singleMetadata->id}}">{{$singleMetadata->form_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="visible">Visible</label>
                            <select class="form-control" name="visible" id="visible">
                                <option value="1" selected >Visble</option>
                                <option value="0"  >No visible</option>
                                    
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="send" data-whatever="null" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>

<style>
    .ace_editor {
        height: 250px !important;
    }

</style>
