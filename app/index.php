<?php

session_start();

if(isset($_SESSION[sha1('dadosLogin')])){

?>

<!doctype html>
<html lang="en">

<head>
    <title>Exemplo de utilização de API</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <script>
    $(function() {

        var chartData = new Array();
        var dataInicial = '';
        var dataFinal = '';

        /* $.ajax({
            type: 'GET',
            url: 'http://localhost/rest/api/leituras/read.php',
            async:false,
            success: function(leituras) {
                $.each(leituras, function(index, leitura) {
                    leiturasDatas[index] = leitura.data_criada;
                    leiturasValores[index] = leitura.valor;
                    console.log(leiturasDatas[index]);
                    console.log(leiturasValores[index]);
                })
            }
        }); 

         function getData(){
            $.getJSON( "http://localhost/rest/api/leituras/read.php", function( data ) {
            
                Highcharts.each(data, function(leitura){
                    leitura.x = new Date(leitura.data_criada).getTime();
                  leitura.y = Number(leitura.valor);
                    chartData.push(leitura);
                });
                chartData.sort(function(a, b){
                    return a.x - b.x
                });
                  chart.series[0].setData(chartData);
            });
        } */

        // Pega dados da api_url utilizando função async, o async function espera o promise terminar
        // utilizando o prefixo await, esperando o json ser retornado, caso o promise não seja cumprida
        // nada é retornado

        async function getData() {
            if (dataInicial === '' && dataFinal === '') {
                var api_url = "http://localhost/rest/api/leituras/read.php";

            } else {
                var api_url = 'http://localhost/rest/api/leituras/read.php?dataInicial=' + 
                dataInicial + '&dataFinal=' + dataFinal;
            }

            const response = await fetch(api_url);
            const leituras = await response.json();
            
            // Insere dados no HighCharts para cada leitura encontrada
            Highcharts.each(leituras, function(leitura) {
                leitura.x = new Date(leitura.data + " " + leitura.hora);
                console.log(leitura.x);
                leitura.y = Number(leitura.valor);
                chartData.push(leitura);
            });
            chartData.sort(function(a, b) {
                return a.x - b.x
            });
            chart.series[0].setData(chartData);
            $("#periodoInicialAPI").html($.format.date(leituras[0].hora, "HH:mm:ss"));
            $("#periodoFinalAPI").html($.format.date(leituras[leituras.length - 1].hora, "HH:mm:ss"));
            $("#diaAPI").html($.format.date(leituras[leituras.length - 1].data + " " + leituras[leituras
                .length - 1].hora, "dd/MM/yyyy"));
        }

        var chart = Highcharts.chart('graficoLeituras', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },

            subtitle: {
                text: ''
            },

            yAxis: {
                title: {
                    text: 'Valores de leituras'
                }
            },

            xAxis: {
                title: {
                    text: 'Hora de leitura'
                },
                type: 'datetime',
                accessibility: {
                    rangeDescription: 'Range: 2010 to 2017'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2010
                }
            },

            series: [{
                name: 'Valores de leitura',
                data: []
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

        
        getData();

    });
    </script>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">SmartControlPRO</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active text-center">
                    <a class="nav-link" href="#">Dados 1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="#">Dados 2</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="#">Dados 3</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-4 text-left mt-2">
                <h3>Bem vindo, <?php echo($_SESSION[sha1('dadosLogin')]['pes_nome']);?>!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mt-4">Leitura diária da rede XXX</h1>
                    <small>Ultimos dados sincronizados do dia <span id="diaAPI"></span><br>
                        de <span id="periodoInicialAPI"></span> até <span id="periodoFinalAPI"></span>
                    </small>
            </div>
        </div>
        <figure class="highcharts-figure">
            <div id="graficoLeituras"></div>
            <p class="highcharts-description">

            </p>
        </figure>
        <div class="row">
            <div class="col-4 offset-8 mx-right text-right">
                <button type="button" class="btn btn-info btn-outline-white btn-sm" data-toggle="modal"
                    data-target="#modelId">
                    <span class="fas fa-search" aria-hidden="true"></span> Consultar por periodo
                </button>
            </div>
        </div>

        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insira período para consulta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="http://localhost/rest/api/leituras/read.php" method="get">
                            <div class="form-group my-2">
                                <label for="">Período inicial: </label>
                                <input type="date" class="form-control" name="dataInicial" id=""
                                    aria-describedby="helpId" placeholder="">

                                <div class="form-group my-2">
                                    <label for="">Período final: </label>
                                    <input type="date" class="form-control" name="dataFinal" id=""
                                        aria-describedby="helpId" placeholder="">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" value="Limpar campos"></input>
                        <button type="submit" class="btn btn-primary">Consultar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
}else{
    echo "Erro no login!";
    print_r($_SESSION['dadosLogin']);

}
?>
</html>