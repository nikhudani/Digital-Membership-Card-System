$(function () {
    
    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 30, 85, -1], [5, 30, 85, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [2] }
        ]
    });
    
    $('#add').on('show.bs.modal', function (e) {
        var path = $(e.relatedTarget).data('te-vendor');
        $('.modal-title').text(`Add new ${path}`);
        $('[name="name"]').attr('placeholder', `Name of ${path}`);
        $('[name="vendor"]').val(path);
        $('[type="submit"]').text(`Add new ${path}`);
    });

    $('#update').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var key = button.data('te-edit');
        var path = $(e.relatedTarget).data('te-vendor');
        $('.modal-title').text(`Update ${path}`);
        $('[name="update_name"]').attr('placeholder', `Name of ${path}`);
        $('[name="vendor"]').val(path);
        $('[type="submit"]').text(`Update ${path}`);
        $.each(datalist[path][key], function (ind, val) {
            if (ind == 'id') {
                $(`[name="id"]`).val(val).trigger('change');
            }
            if (ind == 'name') {
                $(`[name="update_name"]`).val(val).trigger('change');
            }
        });
    });

    $(document).on('click', '[data-te-delete]', function () {
        const path = $(this).data('te-vendor');
        const destroy = { vendor: path, id: $(this).data('te-delete') };
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the ${path}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, Delete`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: is_deleteUrl,
                    data: destroy,
                    success: function (res) {
                        notify(res);
                    }
                });
            }
        })
    });

});
