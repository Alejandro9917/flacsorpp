@extends('partials.master')

@section('public-content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 ">

                <form>
                    <div class="form-group form-inline">
                        <label class="col-xs-2 control-label font-weight-bold">Buscando dentro de la comunidad: </label>
                        <div class="col-xs-10">
                            <input type="search" class="form-control input-xs" placeholder="Buscar..">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-xs-2 control-label font-weight-bold">Por:</label>
                        <div class="col-xs-3">
                            <input type="search" class="form-control input-xs" placeholder="Buscar...">
                        </div>
                        <div class="col-xs-7 ">
                            <button class="btn bg-principal">Ir</button>
                        </div>
                        <div class="col-12">
                            <span class="badge badge-pill badge-secondary">Autor01</span>
                            <span class="badge badge-pill badge-secondary">Autor01</span>
                            <span class="badge badge-pill badge-secondary">Autor01</span>
                            <span class="badge badge-pill badge-secondary">Autor01</span>
                            <span class="badge badge-pill badge-secondary">Autor01</span>
                        </div>

                    </div>
                </form>


            </div>
        </div>


        <div class="row">

            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <input type="text" readonly class="form-control mb-3 mt-3" placeholder="Resultados 1-10 de 100">
            </div>


            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">

                <div class="limiter">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <div class="table100">
                                <table class="shadow-lg table-hover search-table">
                                    <thead>
                                    <tr class="table100-head">
                                        <th class="column1">Fecha de publicacion</th>
                                        <th class="column2">Titulo/Nombre</th>
                                        <th class="column3">Autor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>
                                    <tr>
                                        <td class="column1">jun-2020</td>
                                        <td class="column2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Aperiam, nostrum.
                                        </td>
                                        <td class="column3">Lorem ipsum dolor sit amet,</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 m-1">
                <h4 class="text-uppercase">
                    AUTOR >
                </h4>
                <table class="table table-bordered shadow-lg">
                    <tr>
                        <td>Jorge P. <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Jorge P. <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Jorge P. <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Jorge P. <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                </table>

                <h4 class="text-uppercase">
                    TAG >
                </h4>
                <table class="table table-bordered shadow-lg">
                    <tr>
                        <td>Teoria <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Teoria <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Teoria <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                    <tr>
                        <td>Teoria <span class="badge badge-pill badge-secondary ml-5">OO</span></td>
                    </tr>
                </table>
                <h4 class="text-uppercase">
                    FECHA >
                </h4>
                <table class="table table-bordered shadow-lg">
                    <tr>
                        <td>2010 - 2020 <span class="badge badge-pill badge-secondary ml-3">OO</span></td>
                    </tr>
                    <tr>
                        <td>2010 - 2020 <span class="badge badge-pill badge-secondary ml-3">OO</span></td>
                    </tr>
                    <tr>
                        <td>2010 - 2020 <span class="badge badge-pill badge-secondary ml-3">OO</span></td>
                    </tr>
                    <tr>
                        <td>2010 - 2020 <span class="badge badge-pill badge-secondary ml-3">OO</span></td>
                    </tr>
                </table>

            </div>


        </div>
    </div>

@endsection
