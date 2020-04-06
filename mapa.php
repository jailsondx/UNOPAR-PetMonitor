<?php
include 'conexao.php';
include 'functions.php';
?>

<html>

<head>
    <title>Cadê meu PET?</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <style>
        /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    //echo $id;
    echo "Latitude= " . LatJS($id, $conn) . "<br>";
    echo "Longitude= " . LonJS($id, $conn) . "<br>";
    ?>
    <div id="map"></div>
    <script>
        //função de configuração do mapa
        function initMap() {
            //define a latitude inicial
            var lat_ini = <?php $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                            echo LatJS($id, $conn); ?>;
            //define a longetude inicial
            var lng_ini = <?php $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                            echo LonJS($id, $conn); ?>;
            var mapOptions = {
                zoom: 18,
                center: new google.maps.LatLng(lat_ini, lng_ini),
                mapTypeId: 'roadmap'
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            //Configuração da Polyline
            var flightPlanCoordinates = [{
                    lat: lat_ini,
                    lng: lng_ini
                },
                {
                    lat: <?php $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING) - 1; //Pega posição do dia anterior
                            echo LatJS($id, $conn); ?>,
                    lng: <?php $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING) - 1; //Pega posição do dia anterior
                            echo LonJS($id, $conn); ?>
                }
            ];

            var flightPath = new google.maps.Polyline({
                path: flightPlanCoordinates,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            flightPath.setMap(map);

            //configuração do marcador
            var icon_mark = {
                lat: lat_ini,
                lng: lng_ini
            };
            var marker = new google.maps.Marker({
                position: icon_mark,
                map: map,
                title: 'PET hoje'
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_YFU7lU9TQ3MXChF5u7uSqjPqbRrLyC4&callback=initMap" async defer>
    </script>
</body>

</html>