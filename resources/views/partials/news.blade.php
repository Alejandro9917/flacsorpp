<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="font-weight-bold mt-3 mb-3">Políticas Públicas</h3>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <table class="table table-bordered shadow-lg">
                <tbody id="table_collections"></tbody>
                <!--<tr>
                    <th class="bg-principal"></th>
                    <th>
                        <p class="font-weight-bold">Politicas publicas en Educacion</p>
                        <small>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis doloribus optio quod
                            sapiente voluptas. Assumenda doloremque facere molestiae odit rem.
                        </small>
                    </th>
                </tr>
                <tr>
                    <th class="bg-principal"></th>
                    <th>
                        <p class="font-weight-bold">Politicas publicas sobre Agua</p>
                        <small>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid assumenda enim id iure
                            maxime minima minus nihil repudiandae? Beatae, cum!
                        </small>
                    </th>
                </tr>-->
            </table>

        </div>


        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="font-weight-bold mt-3 mb-3">Busqueda por:</h3>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <table class="table shadow-lg">
                <th class="bg-principal table-head">
                    AUTOR
                </th>
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
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <table class="table table-bordered shadow-lg">
                <th class="bg-principal">
                    TAG
                </th>
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
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <table class="table table-bordered shadow-lg">
                <th class="bg-principal">
                    FECHA
                </th>
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

<script>
    $(document).ready(function(){
        getCollections();
    });

    function getCollections(){
        $.ajax({
                url: "http://127.0.0.1:8000/public/collection",
                method: "GET"

            }).done(function(res){
                var response = res;
                printCollection(response);
        });
    }

    function printCollection(collections){
        collections.map(function(collection){
            $("#table_collections").append(
                "<tr>" +
                "<th class='bg-principal'></th>" +
                "<th>" +
                "<p class='font-weight-bold'>" + collection.name + "</p>" +
                "<small>Descripciones sobre las colecciones</small>" +
                "</th>" +
                "</tr>"
            );
        });
    }
</script>