@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar documentos...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fas fa-file-alt"></i> Crear Documento
                </button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo de documento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        <tr>
                            <th scope="row">926454</th>
                            <td>Lorem ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum.</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">6473</th>
                            <td>Lorem ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum.</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">02974</th>
                            <td>Lorem ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Registro de Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Nombre del documento">


                        <label for="type">Tipo de documento</label>
                        <input class="form-control" type="text" name="type" id="type" placeholder="Tipo de documento">


                        <label for="status">Estado</label>
                        <input class="form-control" type="text" name="status" id="status" placeholder="Estado">
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
