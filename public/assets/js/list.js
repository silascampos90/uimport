
$(document).ready(function () {   

    var table = $('#example2').DataTable({
        lengthChange: false,
        "bPaginate": false,
        "bInfo" : false
    });

    table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
});
