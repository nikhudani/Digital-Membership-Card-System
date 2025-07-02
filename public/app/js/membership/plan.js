$(function () {
    
    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [3] }
        ]
    });
    
    $("#theme-color").spectrum();
    $("#edit-theme-color").spectrum();
    var currentStyle = $("#edit-theme-color").parent().find('.sp-colorize-container.sp-add-on').attr("style");
    var updatedStyle = currentStyle.replace(/width[^;]+;?/g, '');
    $("#edit-theme-color").parent().find('.sp-colorize-container.sp-add-on').attr("style", updatedStyle);

    $(document).on('click', '[data-te-delete]', function (e) { 
        e.preventDefault();
        const plan = $(this).data('te-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the plan!`,
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
                    data: {id: plan},
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

    $('#update-plan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('te-edit');
        const data = datalist[key];
        $(this).find('img').attr({
            src: `${assetUrl}/${data.name}.png`,
            alt: data.name,
        });
    });

});