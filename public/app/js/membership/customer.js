$(function () {
    // $('table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: dataUrl,
    // });

    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [4] }
        ]
    });
    
    $(document).on('click', '[data-te-ban]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-ban');
        const is_ban = $(this).data('bs-original-title');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to ${is_ban} the customer!`,
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
            text: `Your about to delete the user!`,
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
                        });
                        window.location.reload();
                    }
                });
            }
        })
    });

    $('#update-user').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var key = button.data('te-edit');
        const data = datalist[key];
        $(`[name="update_name"]`).val(data.customer.name);
        $(`[name="update_email"]`).val(data.customer.email);
        $(`[name="update_plan"]`).val(data.plan.id).trigger('change');
        $(`[name="update_is_active"]`).val(data.customer.is_active).trigger('change');
        $(`[name="update_phone_number"]`).val(data.customer.details.phone_number);
        $(`[name="update_expiring_at"]`).val(data.expiring_at);
        $(`[name="id"]`).val(data.customer.id).trigger('change');
        // $.each(datalist[key], function (ind, val) { 
        //     $(`[name="update_${ind}"]`).val(val).trigger('change');
        //     if (ind == 'id') {
        //         $(`[name="id"]`).val(val).trigger('change');
        //     }            
        //     $('[name="update_password"]').val('');
        //     console.log(ind, val);
        // });
    });

});