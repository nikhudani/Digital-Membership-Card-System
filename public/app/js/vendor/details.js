$(function () {
    
    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 30, 85, -1], [5, 30, 85, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [5] }
        ]
    });
    
    $('#details-vendor').on('show.bs.modal', function (e) {

        var button = $(e.relatedTarget);
        var key = button.data('te-edit');
        const data = datalist[key];
        $(`[name="id"]`).val(data.vendor.id).trigger('change');

        $('#vendor img').attr({
            src: `${assetUrl}/${data.vendor.details.image}`,
            alt: data.vendor.name,
        });

        $('#vendor h4').text(data.vendor.name);
        $('#organization').text(data.vendor.details.organization);

        const types = [];
        $.each(data.types, function (ind, val) { 
            types.push(val.id);
        });
        $(`#edit-Type`).val(types).trigger('change');

        const categories = [];
        $.each(data.categories, function (ind, val) { 
            categories.push(val.id);
        });
        $(`#edit-Category`).val(categories).trigger('change');

        const locations = [];
        $.each(data.locations, function (ind, val) { 
            locations.push(val.id);
        });
        $(`#edit-Location`).val(locations).trigger('change');

    });

    $(document).on('click', '[data-te-delete]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the vendor details!`,
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