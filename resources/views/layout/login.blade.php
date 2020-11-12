@extends('partials.master')

@section('public-content')


    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mx-auto mb-5">
        <div class="login-content">
            <h3 class="text-center text-login">Iniciar Sesión</h3>
            <div class="text-center">
                <img src="{{ asset('img/logo.png') }}" class="img-login">
            </div>
            <form>
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="email" class="form-control" id="username" placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Contraseña" id="password">
                </div>
                <button type="submit" class="btn bg-principal btn-login">Entrar</button>
                <a href="#" class="ml-2 link-ayuda">¿Necesitas ayuda?</a>
            </form>

            <a href="#" class="link-ayuda">¿Te gustaria formar parte del repositorio?</a>
        </div>

    </div>


@endsection
