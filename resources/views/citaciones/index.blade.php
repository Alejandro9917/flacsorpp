@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fas fa-file-alt"></i> Crear Citación
                </button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Título</th>
                            <th scope="col">Punto</th>
                            <th scope="col">Referencias</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        <tr>
                            <th scope="row">1</th>
                            <td>Ministerio de Educación, Cultura y Deporte. (2013). Actas de I Congreso Internacional de
                                Educación Patrimonial, Madrid, 15 al 18 de octubre de 2012.
                            </td>
                            <td>Congresos</td>
                            <td>Actas del I Congreso de Historia de la Lengua Española en América y España, noviembre de
                                1994-enero de 1995.
                            </td>
                            <td>http://ipce.mcu.es/portada/destacado37.html</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Ministerio de Educación, Cultura y Deporte. (2013). Actas de I Congreso Internacional de
                                Educación Patrimonial, Madrid, 15 al 18 de octubre de 2012.
                            </td>
                            <td>Congresos</td>
                            <td>Actas del I Congreso de Historia de la Lengua Española en América y España, noviembre de
                                1994-enero de 1995.
                            </td>
                            <td>http://ipce.mcu.es/portada/destacado37.html</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Ministerio de Educación, Cultura y Deporte. (2013). Actas de I Congreso Internacional de
                                Educación Patrimonial, Madrid, 15 al 18 de octubre de 2012.
                            </td>
                            <td>Congresos</td>
                            <td>Actas del I Congreso de Historia de la Lengua Española en América y España, noviembre de
                                1994-enero de 1995.
                            </td>
                            <td>http://ipce.mcu.es/portada/destacado37.html</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade shadow-sm" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Registro de Citaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <input class="form-control" type="text" name="content" placeholder="Ingrese el Contenido">
                    </div>

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Ingrese el titulo">
                    </div>

                    <div class="form-group">
                        <label for="pointer">Punto</label>
                        <input class="form-control" type="text" name="pointer" id="pointer"
                               placeholder="Punto de la citación">
                    </div>

                    <div class="form-group">
                        <label for="reference">Referencias</label>
                        <input class="form-control" type="text" name="reference" id="reference"
                               placeholder="Referencias de la citación">
                    </div>

                    <div class="form-group">
                        <label for="reference">Pertenece a un archivo?</label>
                        <select name="file_id" id="file_id" class="form-control">
                            <option value="0" selected disabled>Seleccione...</option>
                            <option value="1">Opcion #1</option>
                            <option value="2">Opcion #2</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-cloud-upload-alt"></i>
                        Guardar
                    </button>
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
