$(function () {
    // console.log(socials);

    $.each(socials, function (ind, val) {

        if (val && !['created_at','updated_at','customer_id'].includes(ind)) {
            $('[data-te-vcard-social]').removeAttr('hidden');

            var icon = '';
            if (ind == 'website') {
                icon = 'fas fa-globe';
            } else {
                icon = `fab fa-${ind}`;
            }

            const aTag = $('<a>', {
                href: val,
                target: 'blank',
                html: $('<i>', {
                    class: `${icon} fa-2x text-color`,
                }),
            });

            $('[data-te-vcard-social]').append(aTag);

        }
        
    });

    // Function to open share dialog
    function shareLink(url) {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: url
            }).then(() => {
                console.log('Link shared successfully');
            }).catch((error) => {
                console.error('Error sharing link:', error);
            });
        } else {
            // Fallback for browsers that do not support Web Share API
            alert('Share functionality is not supported on this browser.');
        }
    }
    

    $('[data-te-qr="code"]').empty().qrcode(qrOptions);

    $(document).on('click', '#qr-download', function () {
        var canvas = $("#qrcode canvas")[0];
        var link = document.createElement("a");
        link.download = $(this).data('te-qr-name') + ".png";
        link.href = canvas.toDataURL("image/png");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

});

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
