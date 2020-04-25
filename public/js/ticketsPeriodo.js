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

function onChangeDates(){
    // alert('opa');
    var startDate = document.getElementById('startDateInput').value;
    var endDate = document.getElementById('endDateInput').value;
    // console.log(startDate);
    document.getElementById("periodoLink").href="/ticket/periodo?startDate=" + startDate + "&endDate=" + endDate; 

};