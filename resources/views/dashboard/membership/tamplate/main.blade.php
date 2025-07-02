<div class="row">
    <div class="col m-3">
        <div class="d-flex align-items-start">

            <div class="nav flex-column nav-pills me-3 w-25" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                <button class="nav-link text-start active" id="v-pills-card-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-card-details" type="button" role="tab" aria-controls="v-pills-card-details" aria-selected="true">Card Details</button>

                @cannot('roleHas', ['customer'])
                    <button class="nav-link text-start" id="v-pills-vcard-tamplate-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vcard-tamplate" type="button" role="tab" aria-controls="v-pills-vcard-tamplate" aria-selected="false">vCard Templates</button>
                @endcannot

                <button class="nav-link text-start" id="v-pills-contact-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact-details" type="button" role="tab" aria-controls="v-pills-contact-details" aria-selected="false">Contact Details</button>

                <button class="nav-link text-start" id="v-pills-social-links-tab" data-bs-toggle="pill" data-bs-target="#v-pills-social-links" type="button" role="tab" aria-controls="v-pills-social-links" aria-selected="false">Social Links</button>
                
                @cannot('roleHas', ['customer'])
                    <button class="nav-link text-start" id="v-pills-membership-card-tab" data-bs-toggle="pill" data-bs-target="#v-pills-membership-card" type="button" role="tab" aria-controls="v-pills-membership-card" aria-selected="false">Membership Card</button>
                @endcannot

                <button class="nav-link text-start" id="v-pills-qr-code-tab" data-bs-toggle="pill" data-bs-target="#v-pills-qr-code" type="button" role="tab" aria-controls="v-pills-qr-code" aria-selected="false">QR Code</button>

            </div>

            {{--  --}}

            <div class="tab-content w-100 ms-4" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-card-details" role="tabpanel" aria-labelledby="v-pills-card-details-tab" tabindex="0">
                    @include('dashboard.membership.tamplate.carddetail')
                </div>

                @cannot('roleHas', ['customer'])
                    <div class="tab-pane fade" id="v-pills-vcard-tamplate" role="tabpanel" aria-labelledby="v-pills-vcard-tamplate-tab" tabindex="0">
                        @include('dashboard.membership.tamplate.vcardtemplate')
                    </div>
                @endcannot

                <div class="tab-pane fade" id="v-pills-contact-details" role="tabpanel" aria-labelledby="v-pills-contact-details-tab" tabindex="0">
                    @include('dashboard.membership.tamplate.contact')
                </div>
                <div class="tab-pane fade" id="v-pills-social-links" role="tabpanel" aria-labelledby="v-pills-social-links-tab" tabindex="0">
                    @include('dashboard.membership.tamplate.social')
                </div>
                                            
                @cannot('roleHas', ['customer'])
                    <div class="tab-pane fade" id="v-pills-membership-card" role="tabpanel" aria-labelledby="v-pills-membership-card-tab" tabindex="0">
                        @include('dashboard.membership.tamplate.membership')
                    </div>
                @endcannot

                <div class="tab-pane fade" id="v-pills-qr-code" role="tabpanel" aria-labelledby="v-pills-qr-code-tab" tabindex="0">
                    @include('dashboard.membership.tamplate.qrcode')
                </div>
            </div>

        </div>
    </div>
</div>