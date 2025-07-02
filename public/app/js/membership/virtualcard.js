$(function () {
    
    var qrOptions = {
        render: 'canvas',
        minVersion: 1,
        ecLevel: 'H',
        radius: 0.5,
        quiet: 1,
        size: 100
    };

    $('#update-vcard select').select2({
        dropdownParent: $('#update-vcard')
    });

    $('table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, 'All']],
        columnDefs: [
            { "orderable": false, "targets": [-1] }
        ]
    });
    
    $(document).on('input', '#Slugurl, #Edit-Slugurl', function () {
        var str = $(this).val();
        // str = str.replace(/^\s+|\s+$/g, '');
        str = str.toLowerCase();
        str = str.replace(/\s+/g, '-');
        str = str.replace(/[^\w-]+/g, '');
        $(this).val(str);
    });

    $(document).on('click', '[data-te-delete]', function (e) { 
        e.preventDefault();
        const user = $(this).data('te-delete');
        Swal.fire({
            title: 'Are you sure?',
            text: `Your about to delete the virtual card!`,
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

    $('#email-vcard').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('te-email');
        const data = datalist[key];
        $('[name="id"]').val(data.customer_id);
    });

    $('#update-vcard').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('te-edit');
        const data = datalist[key];
        $('[name="id"]').val(data.customer_id);
        const qrSize =  data.plan.qr_size;
        qrOptions['size'] = qrSize;
        qrOptions['text'] = `${slugUrl}/${data.slugurl}`;

        $('[data-te-qr="code"]').empty().qrcode(qrOptions);
        $('[name="qr_size"]').val(qrSize);

        $('[data-te-qr="box"]').ionRangeSlider({
            skin: "modern",
            grid: !0,
            min: 100,
            max: 300,
            from: qrSize,
            prefix: "Size ",
            step: 10,
            max_postfix: "px",
            onChange: function (data) {
                qrOptions['size'] = data.from;
                $('[data-te-qr="code"]').empty().qrcode(qrOptions);
                $('[name="qr_size"]').val(data.from);
            }
        });
    
        /** Contact */
        $('[name="ic_number"]').val(data.customer.details.ic_number);
        $('[name="phone_number"]').val(data.customer.details.phone_number);
        $('[name="email"]').val(data.customer.email);
        $('[name="address"]').val(data.customer.details.address);

        /** Social Links */
        $.each(data.social, function (ind, val) { 
            $(`#form-social [name="${ind}"]`).val(val);
        });

        /** vCard Template */
        $('[data-te-vcard-image]').attr('src', `${assetUrl}/user/${data.customer.details.image}`);
        $('[data-te-vcard-customer]').text(data.customer.name);
        $('[data-te-vcard-header]').text(data.plan.member_id);

        $('[data-te-vcard-color]').removeClass('rounded-top-4');
        $('[data-te-vcard-color]').css('background-image', `linear-gradient(to bottom right, ${data.plan.plan.color}, var(--bs-body-bg))`);
        var txtColor = textcolor(data.plan.plan.color);
        $('.text-color').css('color', txtColor);
        $('.vcard-head-color').removeClass('rounded-top-4').css('background-color', data.plan.plan.color);

        $('[data-te-vcard-id]').text(data.customer.details.ic_number);
        $('[data-te-vcard-phone]').text(data.customer.details.phone_number);
        $('[data-te-vcard-email]').text(data.customer.email);
        if (data.social) {
            $('[data-te-vcard-link]').text(data.social.website);            
        }
        $('[data-te-vcard-address]').text(data.customer.details.address);
        var theme = data.plan.theme ? data.plan.theme:'default';
        $(`#theme-${theme}`).trigger('change');
        
        /** Membership Card */
        $('[data-te-vcard-memberid]').text(data.plan.member_id);
        $('[data-te-vcard-exp]').text(formatDate(data.plan.expiring_at));
        const plan = data.plan.plan.name;
        $(`#plan-${plan}`).trigger('change');
    });

    $('[data-te-qr="code"]').css({
        "width": '350px',
        "height": '350px',
        "max-width": '350px',
        "max-height": '350px',
    });

    $(document).on('change', '[name="theme"]', function () {
        $(this).closest('.row').find('label')
            .addClass('border border-3 border-success rounded')
            .not('[for="' + this.id + '"]')
        .removeClass('border border-3 border-success rounded');
    });
    
    $(document).on('change', '[name="plan_id"]', function () {
        $(this).closest('.row').find('label')
            .addClass('border border-3 border-success rounded')
            .not('[for="' + this.id + '"]')
        .removeClass('border border-3 border-success rounded');
    });
    
});

function formatDate(inputDate) {
    // Parse the input date string
    const parsedDate = new Date(inputDate);

    // Check if the parsed date is valid
    if (isNaN(parsedDate.getTime())) {
        return "Invalid Date";
    }

    // Format the date as "MM/yy"
    const formattedDate = parsedDate.toLocaleDateString('en-US', {
        month: '2-digit',
        year: '2-digit'
    });

    return formattedDate;
}

function textcolor(color) {
    let output = 0;
    if (color.charAt(0) === '#') {
        const hex = color.substring(1, 7);
        const r = parseInt(hex.substring(0, 2), 16) / 255;
        const g = parseInt(hex.substring(2, 4), 16) / 255;
        const b = parseInt(hex.substring(4, 6), 16) / 255;
        output = (0.2126 * r + 0.7152 * g + 0.0722 * b).toFixed(1);
    } else {
        const match = color.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        if (match) {
            const r = parseInt(match[1], 10) / 255;
            const g = parseInt(match[2], 10) / 255;
            const b = parseInt(match[3], 10) / 255;
            output = (0.2126 * r + 0.7152 * g + 0.0722 * b).toFixed(1);
        }
    }
    return output > 0.5 ? '#000' : '#fff';
}
