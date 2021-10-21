// $(document).on('submit', 'form#periodoForm', function (e) {
    
//     var startDate = $(this).find('input[name=startDate]').val();
//     var endDate = $(this).find('input[name=endDate]').val();

//     $.ajax({
//         type: 'GET',
//         dataType: 'html',
//         url: '/ticket/periodo',
//         data: {
//             startDate: startDate,
//             endDate: endDate
//         },
//         success: function (data) {
//             // Do some nice animation to show results
//             $('#searchdata').html(data);
//         }
//     });

//     e.preventDefault();
// });

function onChangeFilters(){
    // alert('opa');
    var startDate = document.getElementById('startDateInput').value;
    var endDate = document.getElementById('endDateInput').value;
    var selectRefeicao = document.getElementById('selectRefeicaoInput');

    var refeicao = selectRefeicao.options[selectRefeicao.selectedIndex].value;
    document.getElementById("periodoLink").href="/tickets?startDate=" + startDate + "&endDate=" + endDate + "&refeicaoID=" + refeicao;
    
};

function getStringDate(d){
    var dataFormatada = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).substr(-2) + "-" + ("0" + d.getDate()).substr(-2);
    return dataFormatada;
}

function fastFilterToday(){
    var today = new Date();
    document.getElementById('startDateInput').value = getStringDate(today);
    document.getElementById('endDateInput').value = getStringDate(today);
    onChangeFilters();
}

function fastFilterYesterday(){
    var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    document.getElementById('startDateInput').value = getStringDate(yesterday);
    document.getElementById('endDateInput').value = getStringDate(yesterday);
    onChangeFilters();
}

function fastFilterDaysBack(d){
    var today = new Date();
    var someDayBack = new Date();
    someDayBack.setDate(someDayBack.getDate() - d);
    document.getElementById('startDateInput').value = getStringDate(someDayBack);
    document.getElementById('endDateInput').value = getStringDate(today);
    onChangeFilters();
}

// $dates[$endDate->format('d/m/y')] = 0;
// $fields[$endDate->format('d/m/y')] = $endDate->format('d/m/y');
// $datesHas[$endDate->format('d/m/y')] = 0;