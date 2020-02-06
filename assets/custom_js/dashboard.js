$(document).ready(function () {  

    let current_year = (new Date).getFullYear();
    
    // Invoca a la función encargada de generar el gráfico
    grafico_inscripciones_mes(base_url, current_year);
    
    $('#parametro_de_grafico').on('change', function() {
        
        let selected_year = $this.val();

        // Invoca a la función encargada de generar el gráfico
        grafico_inscripciones_mes(base_url, selected_year);
    });

});

// Highcharts user-declared functions

/**
 * Renderiza el gráfico correspondiente al monto geneardo por mes
 * a lo largo de un año.
 * 
 * @param {string} base_url 
 * @param {integer} year 
 */
function grafico_inscripciones_mes(base_url, year)
{
    // Array de meses
    let nombres_mes = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'];

    $.ajax({
        url: base_url + "dashboard/get_informacion",
        type: 'POST',
        data: {year_inscripcion: year},
        dataType: 'json',
        success: function(data)
        {
            let meses_inscripciones = new Array(),
            montos_generados = new Array();

            $.each(data, function(key, value) {
                meses_inscripciones.push(nombres_mes[value.mes_inscripcion - 1]);
                let valor = Number(value.monto_generado);
                montos_generados.push(valor);
            });
            graficar(meses_inscripciones, montos_generados, year);
        }
    })
}

function graficar(meses_inscripciones, montos_generados, year)
{
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Inscripciones por mes'
        },
        subtitle: {
            text: 'Inscripciones ' + year
        },
        xAxis: {
            categories: meses_inscripciones,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Dinero (Bs.)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Bs.</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 2)
                    }
                }
            }
        },
        series: [{
            name: 'Ingresos Por Mes',
            data: montos_generados

        }]
    });
}
