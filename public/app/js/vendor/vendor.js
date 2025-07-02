$(function () {
    
    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 30, 85, -1], [5, 30, 85, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [4] }
        ]
    });
    
    $('#update-vendor').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var key = button.data('te-edit');
        const data = datalist[key];
        $(`[name="id"]`).val(data.id).trigger('change');
        $(`[name="update_organization"]`).val(data.details.organization).trigger('change');
        $(`[name="update_phone_number"]`).val(data.details.phone_number).trigger('change');
    });

    $(document).on('click', '[data-te-ban]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-ban');
        const is_ban = $(this).data('bs-original-title');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to ${is_ban} the vendor!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${is_ban}`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: is_banUrl,
                    data: {id: user},
                    success: function (res) {
                        Swal.fire(
                            res.alert.title,
                            res.alert.message,
                            res.alert.icon,
                        ).then(() => {
                            if (res.alert.redirect) {
                                window.location.href = res.alert.redirect;
                            } else {
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        })
    });
    
    $(document).on('click', '[data-te-delete]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the vendor!`,
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
                    data: {id: user},
                    success: function (res) {
                        Toast.fire({
                            icon: res.toast.icon,
                            title: res.toast.message
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            }
        })
    });

});