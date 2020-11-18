@section('content')

    @extends('partials.app')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h3 class="font-weight-bold mt-3 mb-3">Administración de roles</h3>
            </div>
        </div>
        @if (session('messageErr'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session('messageErr'))
            <div class="alert alert-danger">
                {{ session('messageErr') }}
            </div>
        @endif


        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h3 class="font-weight-bold mt-3 mb-3">Busqueda por:</h3>
            </div>

            <div class="col-12 col-sm-12">
                <h4 class="text-uppercase">
                <a class="btn btn-success" href="role/create">Crear</a>
                <table class="table table-bordered">
                    @foreach ($all_roles as $single_role)
                    <tr>
                        <td>{{$single_role->name}}</td>
                        <td><a href="role/{{$single_role->id}}/permisos">Permisos</a></td>
                        <td><a href="role/{{$single_role->id}}/edit">Edit</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>

@endsection
