var tmpdata = [/** {parent: parent element or make false, target: target selector, text: target text} */];
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('select').select2();

    $('.modal select').select2({
        dropdownParent: $('.modal')
    });

    $('form').submit(function (e) { 
        e.preventDefault();
        const thisForm = this;
        $(thisForm).block({ 
            theme: false,
            overlayCSS:  { 
                backgroundColor: '#fff', 
                opacity:         0.6, 
                cursor:          'wait' 
            },
            css: { 
                border: 'none',
                backgroundColor: false, 
            },
            message: '<div class="spinner-border text-primary" role="status"></div>'
        }); 
        $(this).closest('form')
            .find('span.invalid-feedback').empty();
        $(this).closest('form')
            .find('.is-invalid').removeClass('is-invalid');

        const formUrl = $(this).attr('action');
        const fData = $(this).attr('enctype') ? new FormData(this):$(this).serialize();

        $.ajax({
            type: "POST",
            url: formUrl,
            data: fData,
            processData: false,
            contentType: $(this).attr('enctype') ? false:'application/x-www-form-urlencoded',
            complete: function (resp) {
                $(thisForm).unblock();
                const res = resp.responseJSON;
                if (res) {
                    notify(res);
                } else {
                    // window.location.reload();
                }
            }
        });

    });

    $('[type="reset"]').click(function (e) {
        $(this).closest('form')
        .find('span.invalid-feedback').empty();
        $(this).closest('form')
        .find('.is-invalid').removeClass('is-invalid');
        if (tmpdata.length > 0) {
            $.each(tmpdata, function (key, val) { 
                $(val.parent).find(val.target).text(val.text);
            });
        }
    });

    $(document).on('change', '[type="checkbox"]', function () {
        const is_checked = $(this).prop('checked') ? 'on':'off';
        $(this).next().val(is_checked);
    }).trigger('change');

    $(document).on('keyup', 'input', function () {
        $(this).hasClass('is-invalid') && $(this).removeClass('is-invalid');
    });

    $('#logout').click(function (e) { 
        e.preventDefault();
        const url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: "Your about to logout!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    });

    $('[data-toggle="tooltip"], [data-tooltip]').tooltip();

    $('[data-te="genpassword"]').click(function (e) { 
        e.preventDefault();
        $(this).parent().find('input').val(genpassword());
    }).trigger('click');

    $('.sub-menu.mm-show').removeAttr('style'); // #side-menu
    
    $('[type="file"]').on("change", function() {
        var fileName = $(this).val().split('\\').pop();
        const label = $(this).parent().find('label');
        tmpdata.push({
            parent: $(this).parent(),
            target: 'label',
            text: label.text()
        });
        label.text(fileName);
    });

    $('.modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('te-edit');
        $.each(datalist[key], function (ind, val) { 
            $(`[name="update_${ind}"]`).val(val).trigger('change');
            if (ind == 'id') {
                $(`[name="id"]`).val(val).trigger('change');
            }            
            $('[name="update_password"]').val('');
        });
    });

    $('.modal').on('hidden.bs.modal', function (event) {
        const form = $(this).find('form');
        form.find('span.invalid-feedback').empty();
        form.find('.is-invalid').removeClass('is-invalid');
    });

    $(document).on('change', '[data-te-status]', function () {
        const isChecked = $(this).prop('checked');
        const id = $(this).data('te-status');
        const tooltip = isChecked ? 'Activated':'Deactivated';
        $(this).parent().attr('data-original-title', tooltip);
        $.ajax({
            type: "POST",
            url: is_activeUrl,
            data: {id: id},
            success: function (res) {
                Toast.fire({
                    icon: res.toast.icon,
                    title: res.toast.message
                });
            }
        });
    });

    $('select').on('change', function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    $('[data-bs-toggle="tab"]').on('show.bs.tab', event => {
        const tabId = event.target.href.split('#')[1];
        sessionStorage.setItem('activeTab', tabId);
    });

    const activeTab = sessionStorage.getItem('activeTab');

    if (activeTab) {
        $(`[data-bs-toggle="tab"]a[href="#${activeTab}"]`).tab('show');
    }

});

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

const dangerForm = (errors) =>
{
    $.each(errors, function (key, val) { 
        const input = $(`[name="${key}"]`);
        input.addClass('is-invalid')
        .parent().find('span.invalid-feedback').text(val);

        if (val === '') {
            input.removeClass('is-invalid');
        }
    });
}

const genpassword = () =>
{
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let password = '';
  
    for (let i = 0; i < 8; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      password += characters.charAt(randomIndex);
    }

    return password;
}

const notify = res =>
{
    if (res.alert) {
        Swal.fire(
            res.alert.title,
            res.alert.message,
            res.alert.icon
        ).then(() => {
            if (res.alert.redirect) {
                window.location.href = res.alert.redirect;
            } else {
                window.location.reload();
            }
        });
        if (res.errors) {
            dangerForm(res.errors);
        }
    } else if (res.toast){
        Toast.fire({
            icon: res.toast.icon,
            title: res.toast.message
        }).then(() => {
            if (res.toast.redirect) {
                window.location.href = res.alert.redirect;
            }
        });
        if (!res.toast.redirect) {
            window.location.reload();
        }
    } else if (res.errors){
        dangerForm(res.errors);
    } else {
        // window.location.reload();
    }
}
