@extends('partials.app')

@section('content')


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner container">
            <div class="carousel-item active carouselItem">
                <h3>Actividades recientes</h3>
                <div class="row">
                    <div class="col-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid aut cum eveniet,
                            explicabo iste iure labore magnam necessitatibus numquam porro possimus quam repellat
                            temporibus vel! Aliquid aut consectetur culpa delectus doloribus eaque et eum fugiat
                            inventore labore nemo nobis numquam quis sequi sit tempore, unde veniam veritatis. Officiis,
                            recusandae.</p>
                    </div>
                    <div class="col-3 offset-7 col-sm-3 offset-sm-8">
                        <button type="button" class="btn btn-light textButtonCarousel">LEER MÁS</button>
                    </div>
                </div>
            </div>

            <div class="carousel-item carouselItem">
                <h3>Actividades recientes</h3>
                <div class="row">
                    <div class="col-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi atque, cum debitis
                            distinctio dolorum ducimus eligendi excepturi explicabo fugiat harum impedit in labore
                            laudantium magnam minima modi molestiae nam necessitatibus neque non nulla numquam odit
                            placeat quae quo ratione repellendus reprehenderit rerum saepe sequi tenetur unde veniam
                            voluptas voluptates.</p>
                    </div>
                    <div class="col-3 offset-7 col-sm-3 offset-sm-8">
                        <button type="button" class="btn btn-light textButtonCarousel">LEER MÁS</button>
                    </div>
                </div>
            </div>

            <div class="carousel-item carouselItem">
                <h3>Actividades recientes</h3>
                <div class="row">
                    <div class="col-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur earum nulla qui
                            quisquam sequi, temporibus totam? Atque eius natus officiis perferendis placeat. A dolores,
                            incidunt iusto magnam natus perferendis soluta voluptates. Amet architecto blanditiis
                            consectetur debitis ducimus earum eligendi eveniet fugiat impedit ipsam ipsum, laudantium
                            possimus quas qui tempora voluptas.</p>
                    </div>
                    <div class="col-3 offset-7 col-sm-3 offset-sm-8">
                        <button type="button" class="btn btn-light textButtonCarousel">LEER MÁS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.news')

@endsection
