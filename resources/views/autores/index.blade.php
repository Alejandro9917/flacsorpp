
@extends('partials.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <input type="search" class="form-control" placeholder="Buscar autores...">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <button type="submit" class="btn btn-info btn-tags" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-file-alt"></i> Crear Autor</button>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                <div class="table-responsive-md ">
                    <table class="table bg-success table-active table-hover">
                        <caption>List of Tags</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Cumpleaños</th>
                            <th scope="col">Email</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        <tr>
                            <th scope="row">1</th>
                            <td>Lyan Miller</td>
                            <td>Raynolds Raynolds</td>
                            <td>20-03-1997</td>
                            <td>ryan@testing.com</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Cristiano</td>
                            <td>Ronaldo</td>
                            <td>21-09-1992</td>
                            <td>cr7@gmail.com</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Carlos</td>
                            <td>Azaustre</td>
                            <td>09-12-1987</td>
                            <td>carlosazaustre@gmail.com</td>
                            <td>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</button>
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
<div class="modal fade shadow-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Registro de Autores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="first_name">Primer Nombre</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Primer Nombre">
                        </div>

                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="last_name">Segundo Nombre</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="first_lastname">Primer Apellido</label>
                            <input class="form-control" type="text" name="first_lastname" id="first_lastname" placeholder="Primer Apellido">
                        </div>

                        <div class="form-group col-lg-6 col-xl-6">
                            <label for="last_lastname">Segundo Apellido</label>
                            <input class="form-control" type="text" name="last_lastname" id="last_lastname" placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group  col-lg-6 col-xl-5">
                            <label for="birthday">Cumpleaños</label>
                            <input class="form-control" type="date" name="birthday" id="birthday">
                        </div>

                        <div class="form-group col-lg-6 col-xl-7">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-cloud-upload-alt"></i> Guardar</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
