

<?php

    require_once( "model/people.php" );
    require_once ( "search.php" );

    $people =  new people();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['island'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $island = $_POST['island'];
            $people->setPeople($name, $email, $island);
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Web PHP</title>
    <meta charset="UTF-8">

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">


</head>


<body class="container">

    <h3>Formulario</h3>

    <form class="form-row" action="index.php" method="post">
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1">Usuario</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Nombre">
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlInput1">email</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>

        <div class="form-group col-md-12">
            <label for="exampleFormControlSelect1">Isla</label>
            <select name="island" class="form-control" id="exampleFormControlSelect1">
                <option selected>Isla</option>
                <option>La gomera</option>
                <option>La Palma</option>
                <option>El Hierro</option>
                <option>Tenerife</option>
                <option>Gran Canaria</option>
                <option>Lanzarote</option>
                <option>Fuenteventura</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>



    <div>


        <!------------------------------ BUSCADOR ------------------------------->

        <div class="search_content">
            <form role="search" method="get" id="search_form">
                <label id="search_label" for="input_search">
                    <i class="fa fa-search"></i>
                </label>
                <input type="text" name="input_search" id="input_search" placeholder="search" onkeyup="loadTable()" onautocomplete autofocus/>
            </form>
        </div>


        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th><th scope="col">Usuario</th><th scope="col">Correo electrónico</th><th scope="col">Isla</th>
                </tr>
            </thead>
            <tbody id = "content-table"> </tbody>

            <script>
                $(document).ready(loadTable());


                function loadTable() {


                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data:  $("#input_search").serialize(),
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        },
                        beforeSend:function(){

                        },
                        success: function (data) {
                            if (data == "") $( "#content-table" ).html( "<p>No se encuentran datos</p>" );
                            else  $( "#content-table" ).html(data);

                        }
                    });
                }
            </script>
        </table>



        </div>
    </div>
</body>
</html>