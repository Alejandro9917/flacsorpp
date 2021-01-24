@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>
@section('content')
    <a href="/public/metadata/create" class="btn btn-primary"> Regresar</a>
    <h3 class="title">Campos creados para formulario "{{$myFormMetadata->form_name}}"</h3>

    <div class="row" id="main_field_container">
    
    </div>
    

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campos-modal">
        Crear Campos
    </button>

    <script>
        var editor;
        $(document).ready(function(){
            getMetadatas();

            //init editor
            editor = ace.edit("json_config");

            $("#field_type_id").change(function(){ 
                var element = $(this).find('option:selected'); 
                var json_template = element.attr("json_template"); 

                editor.setValue(atob(json_template)); 
                
                editor.setTheme("ace/theme/monokai");
                editor.session.setMode("ace/mode/json");
            }); 


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
                url: "{{ $APP_DOMAIN }}/metadata/detail/{{$myFormMetadata->id}}",
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
                url: "{{ $APP_DOMAIN }}/metadata/store_field",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    field_name: $("#field_name").val(),
                    field_type_id: $("#field_type_id").val(),
                    class: $("#class").val(),
                    class_container: $("#class_container").val(),
                    id_element: $("#id_element").val(),
                    is_required: $("#is_required").val(),
                    validation_rule: $("#validation_rule").val(),
                    default_value: $("#default_value").val(),
                    placeholder: $("#placeholder").val(),
                    priority: $("#priority").val(),
                    json_config: editor.getValue(),
                    meta_data_form_id: {{$myFormMetadata->id}},
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
            metadatas.map(function(metadata){
                $('#main_field_container').append(
                    '<div class="col-md-12">'+
                        '<div class="card mb-6 shadow-sm" >'+
                            '<div class="row no-gutters">'+
                                '<div class="col-md-12">'+
                                    '<div class="card-body row">'+
                                        '<div class="col-md-4">'+
                                            '<h6>Field name</h6> <input class="form-control" type="text" name="field_name_'+ metadata.id +'" value="'+ metadata.field_name + '">'+
                                            '<h6>Field type</h6> <input class="form-control"  type="text" name="field_type_id_'+ metadata.id +'" value="'+ metadata.field_type_id + '">'+
                                            '<h6>Field class</h6> <input class="form-control"  type="text" name="class_'+ metadata.id +'" value="'+ metadata.class + '">'+
                                            '<h6>Field class_container</h6> <input class="form-control"  type="text" name="field_type_id_'+ metadata.id +'" value="'+ metadata.class_container + '">'+
                                            '<h6>Field id_element</h6> <input class="form-control"  type="text" name="id_element_'+ metadata.id +'" value="'+ metadata.id_element + '">'+
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                            '<h6>Field is_required</h6> <input class="form-control"  type="text" name="is_required_'+ metadata.id +'" value="'+ metadata.is_required + '">'+
                                            '<h6>Field validation_rule</h6> <input class="form-control"  type="text" name="validation_rule_'+ metadata.id +'" value="'+ metadata.validation_rule + '">'+
                                            '<h6>Field default_value</h6> <input class="form-control"  type="text" name="default_value_'+ metadata.id +'" value="'+ metadata.default_value + '">'+
                                            '<h6>Field placeholder</h6> <input class="form-control"  type="text" name="placeholder_'+ metadata.id +'" value="'+ metadata.placeholder + '">'+
                                            '<h6>Field priority</h6> <input class="form-control"  type="text" name="priority_'+ metadata.id +'" value="'+ metadata.priority + '">'+
                                            
                                        '</div>'+
                                        '<div class="col-md-4">'+
                                            '<p class="card-text"><div style="height:200px" id="editor_'+ metadata.id +'"></div></p>'+
                                            ' <button class="btn btn-warning">Editar</button> <button class="btn btn-danger">Borrar</button>'+
                                            ' <button class="btn btn-primary"> + Prioridad</button> <button class="btn btn-primary"> - Prioridad</button>'+
                                        '</div>'+
                                        
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                );
                
                var temp_editor = ace.edit("editor_" +  metadata.id);
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
                        <div class="form-group col">
                            <label for="field_name">Nombre de Campo</label>
                            <input type="text" class="form-control" name="field_name" id="field_name"
                                   placeholder="Nombre del campo">
                        </div>
                        <div class="form-group col-4">
                            <label for="field_type_id">Tipo de campo</label>
                            <select class="form-control" name="field_type_id" id="field_type_id">
                                <option value="0" selected disabled>Seleccione...</option>
                                @foreach( $field_types as $single_field)
                                    <option json_template="{{ base64_encode($single_field->json_template)}}" value="{{$single_field->id}}">{{$single_field->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="class">Clase CSS</label>
                            <input type="text" class="form-control" name="class" id="class"
                                   placeholder="Nombre de la clase">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-group col-5">
                            <label for="class_container">Clase CSS contenedora</label>
                            <input class="form-control" type="text" name="class_container" id="class_container"
                                   placeholder="Clase contenedora">
                        </div>
                        <div class="form-group col-4">
                            <label for="id_element">Id de elemento</label>
                            <input class="form-control" type="text" name="id_element" id="id_element"
                                   placeholder="Id de elemento">
                        </div>
                        <div class="form-group col-3">
                            <label for="is_required">Es requerido</label>
                            <select name="is_required" id="is_required" class="form-control">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="validation_rule">Regla de Validación</label>
                            <input type="text" class="form-control" name="validation_rule" id="validation_rule"
                                   placeholder="Regla de Validación">
                        </div>
                        <div class="form-group col">
                            <label for="default_value">Valor por defecto</label>
                            <input type="text" class="form-control" name="default_value" id="default_value"
                                   placeholder="Valor por defecto">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="placeholder">Marcador de posición</label>
                            <input type="text" class="form-control" name="placeholder" id="placeholder"
                                   placeholder="Marcador de posición">
                        </div>
                        <div class="form-group col">
                            <label for="priority">Prioridad</label>
                            <input type="text" class="form-control" name="priority" id="priority"
                                   placeholder="Prioridad">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="json_config">Json Config</label>
                            <div  id="json_config" style="height: 100px; position: none;" >Selecciona un tipo de campo</div>
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
