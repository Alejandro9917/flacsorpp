@section('content')

    @extends('partials.app')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h3 class="font-weight-bold mt-3 mb-3">Administración de permisos de rol {{$rol->name}}</h3>
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


            <div class="col-12 col-sm-12">
                <h4 class="text-uppercase">

                <form action="actualizar_permisos" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <td>Modulo</td>
                            @foreach ($scopes as $scope)
                            <td> {{$scope}} </td>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($all_modules as $single_module)
                            @php
                                $current_permison = $single_module->permisons->where("role_id","=",$rol->id)->first();
                            @endphp
                        <tr>
                        <td>{{$single_module->route_regex}} </td>
                            @foreach ($scopes as $scope)
                                @php
                                    if($current_permison != null){
                                        $active = ($current_permison->$scope==1)? "checked":"";
                                    }else{
                                        $active = "";
                                    }
                                    
                                @endphp
                            <td> <input name="{{$scope}}_{{$single_module->id}}" type="checkbox" {{$active}}></td>
                            @endforeach
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">
                                Crear
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
