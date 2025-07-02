<div class="card rounded mb-0">
    <div class="bg-info p-5 d-flex align-items-center justify-content-center">
        <img class="position-absolute rounded-circle shadow-sm" height="80" alt="logo" style="top: 14%;" data-te-vcard-image>
    </div>
    <div class="card-body bg-info2">

        <div class="text-center text-black py-4">
            <h5 class="mt-2 mb-4 text-black-50 font-size-16" data-te-vcard-customer></h5>
            <h4 data-te-vcard-header></h4>
            <dl class="row text-start text-black-50 mb-0 mt-3">
                <!--<dt class="col-sm-2">
                    <i class="fas fa-id-card fa-lg"></i>
                </dt>
                <dd class="col-sm-9" data-te-vcard-id></dd>-->
                
                <dt class="col-sm-2">
                    <i class="fas fa-mobile-alt fa-lg"></i>
                </dt>
                <dd class="col-sm-9" data-te-vcard-phone></dd>

                <!--<dt class="col-sm-2">
                    <i class="fas fa-link fa-lg"></i>
                </dt>
                <dd class="col-sm-9" data-te-vcard-link></dd>-->

                <dt class="col-sm-2">
                    <i class="fas fa-envelope fa-lg"></i>
                </dt>
                <dd class="col-sm-9" data-te-vcard-email></dd>
                
                <dt class="col-sm-2">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </dt>
                <dd class="col-sm-9" data-te-vcard-address></dd>
            </dl>
            @include('dashboard.membership.tamplate.vcard.social.list')
            
        </div>
        <div class="col text-center">
            <button id="contact-download" class="btn btn-sm btn-outline-dark" data-te-qr-name="">
                <i class="fas fa-download me-1"></i> Add to Phone Book
            </button>
            <button id="contact-share" class="btn btn-sm btn-outline-dark" data-te-qr-name="">
                <i class="fas fa-share me-1"></i> Share
            </button>
        </div>
        
    </div>
</div>
<script>
    $(document).on('click', '#contact-download', function () {
        var phoneNumber = $('[data-te-vcard-phone]').text();
        var isAndroid = /(android)/i.test(navigator.userAgent);
        
        if (isAndroid) {
            // For Android devices, prompt to save phone number only
            if (confirm("Save this phone number to contacts?")) {
                window.location.href = "tel:" + phoneNumber;
            }
        } else {
            // For iOS and other devices, create a VCard and trigger download
            var name = $('[data-te-vcard-customer]').text();
            var email = $('[data-te-vcard-email]').text();
            
            // Create a VCard data string
            var vcardData = "BEGIN:VCARD\n" +
                            "VERSION:3.0\n" +
                            "N:" + name + "\n" +
                            "TEL;TYPE=CELL:" + phoneNumber + "\n" +
                            "EMAIL;TYPE=INTERNET:" + email + "\n" +
                            "END:VCARD";
            
            // Create a blob of VCard data
            var blob = new Blob([vcardData], { type: 'text/vcard' });

            // Create a link element to trigger download
            var link = document.createElement("a");
            link.href = window.URL.createObjectURL(blob);
            link.download = name + ".vcf";
            link.click();
        }
    });
</script>