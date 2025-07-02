$(function () {
    
    $('#qr-code').qrcode({
        render: 'canvas',
    });

    const divW = $('#qr-code').width();
    // const divH = $('#qr-code').height();
    // $('#div-size').text(`${divW} x ${divH}`);
    $('#qr-code').height(divW);
    
    $(".qr_box").ionRangeSlider({
        skin: "modern",
        grid: !0,
        min: 100,
        max: divW,
        from: 100,
        prefix: "Size ",
        step: 50,
        max_postfix: "px",
    });

    $(".min_version").ionRangeSlider({
        skin: "modern",
        grid: !0,
        min: 1,
        max: 10,
        from: 1,
        prefix: "Version ",
    });

    $(".quiet_zone").ionRangeSlider({
        skin: "modern",
        grid: !0,
        min: 0,
        max: 4,
        from: 0,
        prefix: "Zone ",
    });

    $(".qr_border").ionRangeSlider({
        skin: "modern",
        grid: !0,
        min: 0,
        max: 50,
        from: 0,
        step: 10,
        prefix: "Radius ",
    });

});