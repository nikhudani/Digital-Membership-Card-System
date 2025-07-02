var defaultOpt = '';
$(document).ready(function () {
    
    defaultOpt = $('<option>', {
        value: '',
        selected: true,
        disabled: true,
        text: '--Select--',
    });

    $('#add select').select2({
        dropdownParent: $('#add')
    });

    $('#vendor').on('change', function () {
        const vendorId = $(this).val();
        clearOpts();
        loadOptions(vendorId, 'add');
    });
    
    $('#update, #add').on('hide.bs.modal', function (e) {

        if (!is_vendor) {
            $('#Edit-vendor').off('change');
            $(`#Type, #Location, #Category, #Edit-Type, #Edit-Location, #Edit-Category`)
            .empty()
            .attr('disabled', true);
            $('#Type, #Location, #Edit-Type, #Edit-Location').append(defaultOpt);
        }

    });

    $('#update').on('show.bs.modal', function (e) {
        
        const id = $('.fas.fa-spinner.fa-pulse')
        .parent().data('te-update');

        $('.fas.fa-spinner.fa-pulse')
        .removeClass()
        .addClass('fas fa-pencil-alt');

        const reqdata = datalist.find(function (purchase) {
            return purchase.id === id;
        });
        $(`[name="id"]`).val(reqdata.id).trigger('change');
        $('#Edit-vendor').val(reqdata.vendor_id).trigger('change');
        $(`#Edit-Sub-Total`).val(reqdata.subtotal).trigger('change');
        $(`#Edit-Discount`).val(reqdata.discount).trigger('change');

        $('#Edit-Type').val(reqdata.type).trigger('change');
        $(`#Edit-Location`).val(reqdata.location).trigger('change');

        let categories = [];
        $.each(reqdata.categories, function (ind, val) { 
            categories.push(val.id);
        });
        $(`#Edit-Category`).val(categories).trigger('change');
        
        $('#Edit-vendor').on('change', function () {
            const vendorId = $(this).val();
            loadOptions(vendorId, 'update');
        });

        $(`#Edit-vendor`).select2({
            dropdownParent: $(`#update`)
        });
    });

    $(document).on('click', '[data-te-update]', function () {
        clearOpts();
        $(this).find('i').removeClass()
        .addClass('fas fa-spinner fa-pulse');
        const id = $(this).data('te-update');
        const data = datalist.find(function (purchase) {
            return purchase.id === id;
        });
        loadOptions(data.vendor_id, 'update');
    });
    
    $(document).on('click', '[data-te-delete]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the purchase history!`,
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

const clearOpts = () =>
{
    $(`#Type, #Location, #Edit-Type, #Edit-Location`)
    .empty()
    .append(defaultOpt);
    $('#Category, #Edit-Category').empty();
}

const loadOptions = (vendorId, modalId) =>
{
    clearOpts();
    const modelSelect = modalId == 'update' ? 'Edit-':'';
    $(`#${modelSelect}Type, #${modelSelect}Location, #${modelSelect}Category`)
    .removeAttr('disabled');
    // $(`#${modelSelect}Type, #${modelSelect}Location`).append(defaultOpt);
    $.ajax({
        type: "POST",
        url: vendetails,
        data: { id: vendorId },
        success: function (res) {
            const types = [];
            const locations = [];
            const categories = [];
            $(res[0].types).each(function (ind, elem) {
                types.push({
                    id: elem.id,
                    text: elem.name,
                });
                $(`#${modelSelect}Type`).select2({
                    data: types,
                    dropdownParent: $(`#${modalId}`)
                });
            });
            
            $(res[0].locations).each(function (ind, elem) {
                locations.push({
                    id: elem.id,
                    text: elem.name,
                });
                $(`#${modelSelect}Location`).select2({
                    data: locations,
                    dropdownParent: $(`#${modalId}`)
                });
            });
            
            $(res[0].categories).each(function (ind, elem) {
                categories.push({
                    id: elem.id,
                    text: elem.name,
                });
                $(`#${modelSelect}Category`).select2({
                    data: categories,
                    dropdownParent: $(`#${modalId}`)
                });
            });
            
        },
        complete: function (res) {
            if (modalId == 'update') {
                $('#update').modal('show');
            }
        }
    });
}