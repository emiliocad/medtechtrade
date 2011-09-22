/* stadistic.equipo.js */
var chart;

$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            // Aquí definimos el nombre del Div que contendrá la gráfica
            renderTo: 'StadistictEquipos',
	        // Aquí el tipo de gráfica
            defaultSeriesType: 'column'
        },
        title: {
            // Titulo
            text: 'Equipos mas visitados'
        },
        subtitle: {
            // Subtitulo
            text: ''
        },
        xAxis: {
            // Categorias del eje X
            categories: [
                '1',
                '2',
                '3'
            ]
        },
        yAxis: {
            // En este caso no tiene valores pero configuro el titulo y el valor mínimo del eje
            min: 0,
            title: {
                text: 'Visitas'
            }
        },
        tooltip: {
            // Definimos el valor del tooltips, sustituimos 'visitas', por la medida que queramos
            formatter: function() {
                return ''+
                this.x +': '+ this.y +' visitas';
            }
        },
        plotOptions: {
            // Opciones de pintado. ver documentación
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            // Valores de las series
            name: 'Equipos mas rankeados',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }]
    });
})