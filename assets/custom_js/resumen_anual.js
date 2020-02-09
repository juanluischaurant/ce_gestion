$(document).ready(function () {  

    // let current_year = (new Date).getFullYear();
    let current_year = $('#parametro_de_grafico').val();
    
    // Invoca a la función encargada de generar el gráfico
    grafico_resumen_generos(base_url, current_year);

    grafico_cursos_periodo(base_url, current_year);
    
    grafico_participantes_mes(base_url, current_year);

    // $('#parametro_de_grafico').on('change', function() {
        
    //     let selected_year = $this.val();

    //     // Invoca a la función encargada de generar el gráfico
    //     grafico_inscripciones_mes(base_url, selected_year);
    // });

});

// Highcharts user-declared functions

/**
 * Renderiza el gráfico correspondiente al monto geneardo por mes
 * a lo largo de un año.
 * 
 * @param {string} base_url 
 * @param {integer} year 
 */
function grafico_resumen_generos(base_url, year)
{
    $.ajax({
        url: base_url + "reportes/resumen_anual/get_resumen_generos",
        type: 'POST',
        data: {year_periodo: year},
        dataType: 'json',
        success: function(data)
        {
            let periodos = new Array(),
            conteo_masculino = new Array(),
            conteo_femenino = new Array(),
            menores_al_inscribirse = new Array(),
            mayores_al_inscribirse = new Array();

            $.each(data, function(key, value) {
                periodos.push(value.periodo_academico)
                // meses_inscripciones.push(nombres_mes[value.mes_inscripcion - 1]);

                conteo_masculino.push(Number(value.conteo_masculino));
                conteo_femenino.push(Number(value.conteo_femenino));
                menores_al_inscribirse.push(Number(value.menores_al_inscribirse));
                mayores_al_inscribirse.push(Number(value.mayores_al_inscribirse));
            });
            graficar_resumen_generos(periodos, conteo_masculino, conteo_femenino, menores_al_inscribirse, mayores_al_inscribirse, year);
        }
    });
}

function graficar_resumen_generos(periodos, conteo_masculino, conteo_femenino, menores_al_inscribirse, mayores_al_inscribirse, year)
{
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            height: 65 + '%'
        },
        title: {
            text: 'Distribución de Participantes'
        },
        subtitle: {
            text: 'Períodos ' + year
        },
        xAxis: {
            categories: periodos,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:8px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            },
            series: {
                dataLabels: {
                    enabled: true,
                    // formatter: function() {
                    //     return Highcharts.numberFormat(this.y, 2)
                    // }
                }
            }
        },
        series: [{
            name: 'Participantes Masculinos',
            data: conteo_masculino
        },
        {
            name: 'Participantes Femeninos',
            data: conteo_femenino
        },
        {
            name: 'Menores al inscribirse',
            data: menores_al_inscribirse
        },
        {
            name: 'Mayores al inscribirse',
            data: mayores_al_inscribirse
        }]
    });
}

function grafico_cursos_periodo(base_url, year) {
    $.ajax({
        url: base_url + "reportes/resumen_anual/get_resumen_periodos",
        type: 'POST',
        data: {year_periodo: year},
        dataType: 'json',
        success: function(data)
        {
            let periodos = new Array(),
            cursos_dictados = new Array(),
            inscripciones = new Array();

            $.each(data, function(key, value) {
                periodos.push(value.periodo_academico);
                cursos_dictados.push(Number(value.conteo_cursos_dictados));
                inscripciones.push(Number(value.conteo_inscripciones));
            });
            graficar_cursos_periodo(periodos, cursos_dictados, inscripciones);
        }
    });
}

function graficar_cursos_periodo(periodos, cursos_dictados, inscripciones) {
    Highcharts.chart('container_lineas', {

        chart: {
            type: 'area',
            height: 45 + '%'
        },
        title: {
            text: 'Distribución de Cursos'
        },
        xAxis: {
            categories: periodos
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Inscripciones',
            data: inscripciones
        },
        {
            name: 'Cursos Dictados',
            data: cursos_dictados
        }]
    
    });
}

function grafico_participantes_mes(base_url, year) {
    $.ajax({
        url: base_url + "reportes/resumen_anual/get_conteo_participantes",
        type: 'POST',
        data: {year_periodo: year},
        dataType: 'json',
        success: function(data)
        {
            let meses = new Array(),
            participantes_inscritos = new Array();

            $.each(data, function(key, value) {
                meses.push(value.mes_registro);
                participantes_inscritos.push(Number(value.conteo_participantes_mes));
            });
            graficar_participantes_mes(meses, participantes_inscritos);
        }
    });
}

function graficar_participantes_mes(meses, participantes_inscritos) {
    Highcharts.chart('container_personas', {

        chart: {
            type: 'area',
            height: 35 + '%'
        },
        title: {
            text: 'Registrados como Participante'
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Participantes',
            data: participantes_inscritos
        }]
    
    });


}

// jQuery print
$(document).on("click", ".btn-print", function() {
    $(".invoice").print();
});


    

		

