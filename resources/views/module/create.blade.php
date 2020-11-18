@section('content')

    @extends('partials.app')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h3 class="font-weight-bold mt-3 mb-3">Administración de modulos</h3>
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


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h3 class="font-weight-bold mt-3 mb-3">Crear nuevo modulo</h3>
            </div>

            <div class="col-12 col-sm-12">
                <form action="{{route('module.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-4 col-form-label">Route regex</label>
                        <div class="col-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                </div>
                                <input id="route_regex" name="route_regex" placeholder="module/*" type="text" class="form-control"
                            required="required" value="{{old('route_regex')}}" />
                            </div>
                        </div>
                    </div>
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
