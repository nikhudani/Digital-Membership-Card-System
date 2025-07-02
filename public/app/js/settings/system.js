Dropzone.autoDiscover = false;
$(function () {
    
    let logo = new Dropzone("#logo", {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        paramName: "logo",
        uploadMultiple: false,
        // thumbnailWidth: 240,
        // thumbnailHeight: 70,
        thumbnailMethod: "contain",
        acceptedMimeTypes: ".png,.jpg,.jpeg,.svg",
        previewTemplate: document.querySelector('#logo-template').innerHTML,
        success: function(file, response){
           notify(response);
        }
    });
    
    let favicon = new Dropzone("#favicon", {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        paramName: "favicon",
        uploadMultiple: false,
        acceptedMimeTypes: "image/x-icon",
        // thumbnailWidth: 48,
        // thumbnailHeight: 48,
        thumbnailMethod: "contain",
        previewTemplate: document.querySelector('#favicon-template').innerHTML,
        success: function(file, response){
           notify(response);
        }
    });
    
    $('#load-gmail').click(function (e) { 
        e.preventDefault();
        $('#mail_mailer').val('smtp');
        $('#mail_host').val('smtp.gmail.com');
        $('#mail_port').val('465');
        $('#mail_encryption').val('ssl');
    });

    $('#mail_mailer, #mail_host, #mail_port, #mail_encryption').on('keyup', function (e) {
        var currentValue = $(this).val();
        $(this).val(currentValue.toLowerCase());
    });

    // $('#form-email-setup input').each(function (index, element) {
    //     console.log($(this).attr('name'));
    // });
});