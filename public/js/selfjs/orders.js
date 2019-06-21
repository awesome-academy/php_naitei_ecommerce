$(document).ready(function () {
    $('#orders_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/admin/orders/getdata",
        "columns": [
            { "data": "slug" },
            { "data": "address" },
            { "data": "order_total" },
            { "data": "status" },
            { "data": "startday" },
            { "data": "user_name" },
            { "data": "action", orderable: false, searchable: false }
        ]
    });
    $(document).on('click', '.accept_order', function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        if (confirm("Are you sure you want to ACCEPT this order?")) {
            var id = $(this).attr('id');
            $.ajax({
                url: '/admin/orders/handle',
                method: 'POST',
                data: {
                    id: id,
                    handlestatus: 1,
                    _token: token,
                },
                success: function (response) {
                    alert(response.alert);
                    $('#orders_table').DataTable().ajax.reload();
                }
            })
        }
        else {
            return false;
        }
    });
    $(document).on('click', '.reject_order', function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        if (confirm("Are you sure you want to REJECT this order?")) {
            var id = $(this).attr('id');
            $.ajax({
                url: '/admin/orders/handle',
                method: 'POST',
                data: {
                    id: id,
                    handlestatus: 2,
                    _token: token,
                },
                success: function (response) {
                    alert(response.alert);
                    $('#orders_table').DataTable().ajax.reload();
                }
            })
        }
        else {
            return false;
        }
    });
});
