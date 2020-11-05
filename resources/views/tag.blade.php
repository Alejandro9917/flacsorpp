@extends('partials.app')

@section('content')

    <div class="container">
        <div class="row">
            <!--<form method="POST" action="{{ url('tag') }}">-->
            <form id="tag_form" method="PUT">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="cod_tag">Cod tag</label>
                    <input type="text" class="form-control" id="cod_tag" name="cod_tag" placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Another input placeholder">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Another input placeholder">
                </div>
                <button class="btn btn-primary" id="send">Enviar</button>
            </form>
        </div>
    </div>

    @foreach ($tags as $tag)
        <p>{{ $tag->name }}</p>
    @endforeach

    <script>
        $("#send").click(function(e){
            e.preventDefault();
            $.ajax({            
                url: "{{ url('tag/1') }}",
                method: 'PATCH',
                data: $("#tag_form").serialize()
            }).done(function(res){
                var response = JSON.parse(res);
                console.log(response);
            });
        });
    </script>

@endsection