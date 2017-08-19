
function calculateIndicator(){
    $('#indicator-values-conteiner').empty();
    var id = window.location.href.split("/")[4];
    var data = {};
    data.company = id;
    data.period = $('#indicatorPeriod').val();

    $.ajax({
        url: '/api/indicatorEvaluate',
        type: 'post',
        dataType: 'json',
        data: data,
        success: function ( obj ) {
            obj.forEach(function (value) {
                $('#indicator-values-conteiner').append('<tr><td>'+
                    value.indicator +
                    '</td><td>'+
                    value.value +
                    '</td></tr>');
            })
        }
    });
}

$(document).ready(function() {
    $('.dataTable').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "{{asset('js/plugins/dataTables/swf/copy_csv_xls_pdf.swf')}}"
        }
    });
    calculateIndicator();
    $('#indicatorPeriod').change(function(){
        calculateIndicator();
    });
});
