@extends('partials.app')

@section('content')
    <h3 class="title">Campos creados</h3>

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
                            <label for="field_name">Campo</label>
                            <input type="text" class="form-control" name="field_name" id="field_name"
                                   placeholder="Nombre del campo">
                        </div>
                        <div class="form-group col">
                            <label for="class">Clase</label>
                            <input type="text" class="form-control" name="class" id="class"
                                   placeholder="Nombre de la clase">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-group col-5">
                            <label for="class_container">Clase contenedora</label>
                            <input class="form-control" type="text" name="class_container" id="class_container"
                                   placeholder="Clase contenedora">
                        </div>
                        <div class="form-group col-4">
                            <label for="class_container">Id de elemento</label>
                            <select name="id_element" id="id_element" class="form-control">
                                <option value="1">1</option>
                                <option value="0">2</option>
                            </select>
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
                            <select class="form-control" name="json_config" id="json_config">
                                <option value="0" selected disabled>Seleccione...</option>
                                <option value="0">Primera opcion</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="field_type_id">Id del campo</label>
                            <select class="form-control" name="field_type_id" id="field_type_id">
                                <option value="0" selected disabled>Seleccione...</option>
                                <option value="0">Primera opcion</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="meta_data_form_id">Id de formulario</label>
                            <select class="form-control" name="meta_data_form_id" id="meta_data_form_id">
                                <option value="0" selected disabled>Seleccione...</option>
                                <option value="0">Primera opcion</option>
                            </select>
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
