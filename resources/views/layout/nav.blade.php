

{{--De esta forma se incluyen archivos de estilos personalizados para cada vista sin afectar el resto--}}
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<!-- Bootstrap JS -->

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <img src="" class="img-circle mt-1">
            <h5 class="mt-3">{{ Auth::user()->first_name }} {{ Auth::user()->first_lastname }}</h5>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="#">Repositorio</a>
            </li>
            <li class="{{setActive('collection.create')}}">
                <a href="/collection/create">Comunidades</a>
            </li>
            <li class="{{setActive('file.create')}}">
                <a href="/file/create">Documentos</a>
            </li>
            <li>
                <a href="#">Datos</a>
            </li>
            <li class="{{setActive('author.create')}}">
                <a href="/author/create">Autores</a>
            </li>
            <li class="{{setActive('citation.create')}}">
                <a href="/citation/create">Citaciones</a>
            </li>
            <li class="{{setActive('tag.create')}}">
                <a href="/tag/create">Tags</a>
            </li>
            <li>
                <a href="#">Usuarios</a>
            </li>
            <li>
                <a href="#">Permisos</a>
            </li>
            <li>
                <a href="#">Roles</a>
            </li>
            <li class="{{setActive('')}}">
                <a href="/metadata/create" >Meta Data</a>
            </li>
            <li class="{{setActive('')}}">
                <a href="/file_types/create" >Tipos de Archivos</a>
            </li>
            <li>
                <a href="/logout">Cerrar sesión</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg bg-transparent" id="nav-private">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
