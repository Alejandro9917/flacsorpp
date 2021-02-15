@extends('partials.app')
<?php $APP_DOMAIN = URL::to('/'); ?>

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
                            <th scope="col">Vincular</th>
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

            // ---------- New  Code ----------
            $("#file_type_id").change(function(){ 
                var element = $(this).find('option:selected');
                console.log("Valor seleccionado");
                form_drawer.html("");
                console.log(element.val());
                printForms(element.val());
            }); 

            var form_drawer = $("#form_drawer");

            function printForms(file_type_id) {
                
                $.ajax({
                    url: "{{ $APP_DOMAIN }}/file_types/forms",
                    method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    file_type_id: file_type_id,
                },
                }).done(function(res){
                    console.log(res);
                    form_drawer.append("<h4>"+ res.name + "</h4>");
                    $.each(res.file_types_metadata_forms, function(i, singleForm) {
                        printSingleForm(singleForm);
                    });
                    
                });
            }

            function printSingleForm(singleForm){
                var printHtml = "";
                form = singleForm.metadata;
                console.log(form);
                form_drawer.append('<div class="panel-group" id="accordion_'+singleForm.id+"_"+form.id+'">');
                form_drawer.append("<h5>"+ form.form_name + "</h5>");
                printHtml += '<div class="panel panel-default">' +
                        '<div class="panel-heading  well">' +
                            '<h5 class="panel-title ">' +
                                '<a data-toggle="collapse" data-parent="#accordion" href="#collapse_'+ form.id +'_field_'+ singleForm.id +'">' +
                                '<span class="badge"> + '+  form.form_name + '</span></a>' +
                            '</h5>' +
                        '</div>' +
                        '<div id="collapse_'+ form.id +'_field_'+ singleForm.id +'" class="panel-collapse collapse in">';
                form.fields.map(function(field){
                            printHtml +=
                            '<div class="panel-body">' +
                                '<table class="table">' +
                                    '<tr><td>'+field.field_name+'</td><td> <input type="'+field.field_type.type+'" placeholder="'+field.placeholder+'" value=""></td></tr>' +
                                '</table>' +
                            '</div>' +
                        '</div>';
                        
                });
                printHtml +='</div>';
                form_drawer.append(printHtml);
            }


            function printSingleField(field){

            }

            // ------ END new Code ----------


            getFiles();

            $('#modalFile').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('whatever');
                getFile(id);
            });

            $('#modalFile').on('hiden.bs.modal', function (event) {
                clear();
            });

            $("#modalCitation").on('show.bs.modal', function(event){
                var button = $(event.relatedTarget);
                var id = button.data('file');
                getCitations(id);
            });

            $("#modalCitation").on('hide.bs.modal', function(event){
                $("#table_citations").empty();
            });

            $("#modalTag").on('show.bs.modal', function(event){
                var button = $(event.relatedTarget);
                var id = button.data('file');
                $("#modalTag").attr('data-whatever', id);
                getTagsFile(id);
                getTags();
            });

            $("#modalTag").on('hide.bs.modal', function(event){
                $("#table_tags").empty();
                $("#table_tags_file").empty();
            });

            $('a#asiganados_tab').on('shown.bs.tab', function (e) {
                id = $("#modalTag").attr('data-whatever');
                getTagsFile(id);
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

        function linkUpTag(tag_id){
            file_id = $("#modalTag").attr('data-whatever');

            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/files/tags",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    file_id: file_id,
                    tag_id: tag_id
                },
                success: function(res){
                    var response = res;
                    console.log(res);
                },
                error: function(res){
                    var response = res;
                    console.log(response);
                }
            });
        }

        function unlinkTag(tag_id){
            file_id = $("#modalTag").attr('data-whatever');

            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/files/tags/delete",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    file_id: file_id,
                    tag_id: tag_id
                },
                success: function(res){
                    var response = res;
                    console.log(res);
                },
                error: function(res){
                    var response = res;
                    console.log(response);
                }
            });

            $("#table_tags_file").empty();
            getTagsFile(file_id);
        }

        function getFiles(){
            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/file",
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
                url: "<?php echo $APP_DOMAIN; ?>/file/" + id,
                method: "GET",
                error: function(res){
                }
            }).done(function(res){
                    var response = res;
                    set(response);
            });
        }

        function getCitations(file_id){
            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/citation/file/" + file_id,
                method: "GET",
                error: function(res){
                }
            }).done(function(res){
                    var response = res;
                    printCitations(response);
            });
        }

        function getTags(){
            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/tag/",
                method: "GET",
                error: function(res){
                }
            }).done(function(res){
                    var response = res;
                    printTags(response);
            });
        }

        function getTagsFile(file_id){
            $.ajax({
                url: "<?php echo $APP_DOMAIN; ?>/file/tags/" + file_id,
                method: "GET",
                error: function(res){
                }
            }).done(function(res){
                    var response = res;
                    printTagsFile(response);
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
                    created_by: {{ Auth::user()->id }},
                    collection_id: 1
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
                url: "<?php echo $APP_DOMAIN; ?>/file/" + id,
                method: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#name").val(),
                    type: $("#type").val(),
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
                    "<td>"+
                    "<button type='submit' data-file=" + file.id + " class='btn btn-warning' data-toggle='tooltip' data-placement='bottom' title='Vincular Autores'>" +
                        "<i class='fas fa-address-book' data-toggle='modal' data-target='#modalAuthor'></i></button>" +
                    "<button type='submit' data-file=" + file.id + " class='btn btn-warning' data-placement='bottom' title='Vincular Citaciones' data-toggle='modal' data-target='#modalCitation'>" +
                        "<i class='fas fa-calendar-plus'></i></button>" +
                    "<button type='submit' data-file=" + file.id + " class='btn btn-warning' data-placement='bottom' title='Vincular Tags' data-toggle='modal' data-target='#modalTag'>" +
                        "<i class='fas fa-clipboard'></i></button>" +
                    "</td>" +
                    "<td><button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#modalFile' data-whatever=" + file.id + "><i class='fas fa-pencil-alt'></i> Editar</button></td>" +
                    "</tr>"
                );
            });
        }

        function printCitations(citations){
            citations.map(function(citation){
                $("#table_citations").append(
                    "<tr>" +
                    "<th scope='row'>" + citation.id + "</th>" +
                    "<td>" + citation.title + "</td>" +
                    "<td>" + citation.content + "</td>" +
                    "<td>" + citation.point + "</td>" +
                    "<td>" + citation.reference + "</td>" +
                    "<td><button type='submit' class='btn bg-success' data-citation=" + citation.id + "><i class='far fa-check-circle'></i></button></td>" +
                    "</tr>"
                );
            });
        }

        function printTags(tags){
            tags.map(function(tag){
                $("#table_tags").append(
                    "<tr>" +
                    "<th scope='row'>" + tag.id + "</th>" +
                    "<td>" + tag.cod_tag + "</td>" +
                    "<td>" + tag.name + "</td>" +
                    "<td>" + tag.color + "</td>" +
                    "<td><button onClick='linkUpTag(" + tag.id + ")' type='submit' class='btn bg-success' data-file=" + tag.id + "><i class='far fa-check-circle'></i></button></td>" +
                    "</tr>"
                );
            });
        }

        function printTagsFile(tags){
            tags.map(function(tag){
                $("#table_tags_file").append(
                    "<tr>" +
                    "<th scope='row'>" + tag.id + "</th>" +
                    "<td>" + tag.cod_tag + "</td>" +
                    "<td>" + tag.name + "</td>" +
                    "<td>" + tag.color + "</td>" +
                    "<td><button onClick='unlinkTag(" + tag.id + ")' type='submit' class='btn bg-danger' data-dismiss='modal' data-tag=" + tag.id + "><i class='text-white far fa-trash-alt'></i></button></td>" +
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
<div class="modal fade shadow-sm" id="modalFile" tabindex="-1" role="dialog" aria-labelledby="modalFileTitle" aria-hidden="true">
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
                        <select class="form-control" name="file_type_id" id="file_type_id">
                                <option value="0" selected disabled>Seleccione...</option>
                                @foreach( $file_types as $single_file_type)
                                    <option value="{{$single_file_type->id}}">{{$single_file_type->name}}</option>
                                @endforeach
                            </select>


                        <label for="status">Estado</label>
                        <input class="form-control" type="text" name="status" id="status" placeholder="Estado">
                    </div>
                    <div id="form_drawer" class="form-group">

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


<!--Modal de citaciones-->
<div class="modal fade shadow-sm" id="modalCitation" tabindex="-1" role="dialog" aria-labelledby="modalCitationTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCitationTitle">Citaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Ir a Crear Nueva</button>
                <div class="table-responsive">
                    <table class="table bg-success table-active table-hover">
                        <caption>Lista de Autores</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Punto</th>
                            <th scope="col">Referencia</th>
                            <th scope="col">Añadir</th>
                        </tr>
                        </thead>
                        <tbody id="table_citations" class="bg-light">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>Cerrar</button></div>
        </div>
    </div>
</div>

<!--Modal de tags-->
<div class="modal fade shadow-sm" id="modalTag" tabindex="-1" role="dialog" aria-labelledby="modalTagTitle" aria-hidden="true" data-whatever="">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTagTitle">Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Ir a crear nuevo</button>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="asiganados_tab" data-toggle="tab" href="#asiganados" role="tab" aria-controls="asiganados" aria-selected="true">Tag asignados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nuevo_tab" data-toggle="tab" href="#nuevo" role="tab" aria-controls="nuevo" aria-selected="false">Tags disponibles</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="asiganados" role="tabpanel" aria-labelledby="asiganados_tab">
                        <div class="table-responsive">
                            <table class="table bg-success table-active table-hover">
                                <caption>Lista de Tags</caption>
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Añadir</th>
                                </tr>
                                </thead>
                                <tbody id="table_tags_file" class="bg-light">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nuevo" role="tabpanel" aria-labelledby="nuevo_tab">
                        <div class="table-responsive">
                            <table class="table bg-success table-active table-hover">
                                <caption>Lista de Tags</caption>
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Añadir</th>
                                </tr>
                                </thead>
                                <tbody id="table_tags" class="bg-light">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>Cerrar</button></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade shadow-sm" id="modalAuthor" tabindex="-1" role="dialog" aria-labelledby="modalAuthorTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAuthorTitle">Autores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>
                    Ir a Crear Nuevo
                </button>
                <div class="table-responsive">
                    <table id="table_authors" class="table bg-success table-active table-hover">
                        <caption>Lista de Autores</caption>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>Cerrar</button></div>
        </div>
    </div>
</div>
