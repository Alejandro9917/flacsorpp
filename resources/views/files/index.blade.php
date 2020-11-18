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
                            <th scope="col">Vincular</th>
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
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Autores">
                                    <i class="fas fa-address-book" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Citaciones">
                                    <i class="fas fa-calendar-plus" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Tags">
                                    <i class="fas fa-clipboard" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>
                            
                            </td>
                            <td><button type="submit" class="btn btn-info">Editar <i class="fa fa-pencil-alt"></i></button></td>
                        </tr>
                        <tr>
                            <th scope="row">6473</th>
                            <td>Lorem ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum.</td>
                            <td>
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Autores">
                                    <i class="fas fa-address-book" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Citaciones">
                                    <i class="fas fa-calendar-plus" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Tags">
                                    <i class="fas fa-clipboard" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>
                            
                            </td>
                            <td><button type="submit" class="btn btn-info">Editar <i class="fa fa-pencil-alt"></i></button></td>
                        </tr>
                        <tr>
                            <th scope="row">02974</th>
                            <td>Lorem ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Autores">
                                    <i class="fas fa-address-book" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Citaciones">
                                    <i class="fas fa-calendar-plus" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>

                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" 
                                    data-placement="bottom" title="Vincular Tags">
                                    <i class="fas fa-clipboard" data-toggle="modal"
                                        data-target="#exampleModalLink"></i>
                                </button>
                            
                            </td>
                            <td><button type="submit" class="btn btn-info">Editar <i class="fa fa-pencil-alt"></i></button></td>
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


{{-- Modal para los links dentro de las opciones de Documentos --}}
<!-- Modal -->
<div class="modal fade shadow-sm" id="exampleModalLink" tabindex="-1" role="dialog"
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
                <button type="button" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>
                    Crear Nuevo
                </button>
                <div class="table-responsive">
                    <table class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
