@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>
@section('content')
    <h3 class="title">Campos creados para "{{$myFormMetadata->form_name}}"</h3>

    <div class="card mb-3 shadow-sm" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title">Campos creados</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam aperiam
                        atque culpa cupiditate dolore doloremque ea eius, ex facilis fuga illum incidunt iusto labore
                        molestiae molestias, natus, nobis nulla.</p>
                    <p class="card-text"><small class="text-muted">Cambios realizados hace 3 segundos atras</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campos-modal">
        Crear Campos
    </button>

    <script>
        $(document).ready(function(){
            getMetadatas();

            $("#field_type_id").change(function(){ 
                var element = $(this).find('option:selected'); 
                var json_template = element.attr("json_template"); 

                $('#json_config').val(atob(json_template)); 
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

        function sendMetadata(){
            $.ajax({
                url: "{{ $APP_DOMAIN }}/createField",
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
                        <div class="form-group col-4">
                            <label for="json_config">Json Config</label>
                            <div  id="json_config" >Selecciona un tipo de campo</div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
