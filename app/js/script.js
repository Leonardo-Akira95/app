    
    $(function() {

        var chartData = [];

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

    var api_url = "http://localhost/rest/api/leituras/read.php";

    async function getData() {
        const response = await fetch(api_url);
        const leituras = await response.json();
        console.log(leituras);

        /* Highcharts.each(leituras, function(leitura) {
            leitura.x = new Date(leitura.data_criada).getTime();
            leitura.y = Number(leitura.valor);
            chartData.push(leitura);
        });
        chartData.sort(function(a, b) {
            return a.x - b.x
        });
        //$("#periodoInicial")
        chart.series[0].setData(chartData); */
    }

        var chart = Highcharts.chart('container', {
            chart: {type: 'spline'},
            title: {
                text: ''
            },
        
            subtitle: {
                text: 'Source: SmartControl API'
            },
        
            yAxis: {
                title: {
                    text: 'Valores de leituras'
                }
            },
        
            xAxis: {
                title: {
                    text: 'Data de leitura'
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
                name: 'Datas de leitura',
                data: []
            }, {
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

    
