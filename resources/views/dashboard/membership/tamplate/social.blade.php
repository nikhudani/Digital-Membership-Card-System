<form id="form-social" action="{{route('qr-social')}}" method="POST" class="g-3 needs-validation" novalidate>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-webaddress">
                    <i class="fas fa-globe fa-lg"></i>
                </span>
                <input type="text" name="website" class="form-control" placeholder="WebSite URL" aria-label="Edit-webaddress" aria-describedby="Edit-webaddress">
                <span class="invalid-feedback"></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-twitter">
                    <i class="fab fa-twitter fa-lg"></i>
                </span>
                <input type="text" name="twitter" class="form-control" placeholder="Twitter URL" aria-label="Edit-twitter" aria-describedby="Edit-twitter">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-facebook">
                    <i class="fab fa-facebook-square fa-lg"></i>
                </span>
                <input type="text" name="facebook" class="form-control" placeholder="Facebook URL" aria-label="Edit-facebook" aria-describedby="Edit-facebook">
                <span class="invalid-feedback"></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </span>
                <input type="text" name="instagram" class="form-control" placeholder="Instagram URL" aria-label="Edit-instagram" aria-describedby="Edit-instagram">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-reddit">
                    <i class="fab fa-reddit-alien fa-lg"></i>
                </span>
                <input type="text" name="reddit" class="form-control" placeholder="Reddit URL" aria-label="Edit-reddit" aria-describedby="Edit-reddit">
                <span class="invalid-feedback"></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-tumblr">
                    <i class="fab fa-tumblr-square fa-lg"></i>
                </span>
                <input type="text" name="tumblr" class="form-control" placeholder="Tumblr URL" aria-label="Edit-tumblr" aria-describedby="Edit-tumblr">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-youtube">
                    <i class="fab fa-youtube fa-lg"></i>
                </span>
                <input type="text" name="youtube" class="form-control" placeholder="Youtube URL" aria-label="Edit-youtube" aria-describedby="Edit-youtube">
                <span class="invalid-feedback"></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-linkedin">
                    <i class="fab fa-linkedin fa-lg"></i>
                </span>
                <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn URL" aria-label="Edit-linkedin" aria-describedby="Edit-linkedin">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-whatsapp">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </span>
                <input type="text" name="whatsapp" class="form-control" placeholder="WhatsApp URL" aria-label="Edit-whatsapp" aria-describedby="Edit-whatsapp">
                <span class="invalid-feedback"></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-pinterest">
                    <i class="fab fa-pinterest fa-lg"></i>
                </span>
                <input type="text" name="pinterest" class="form-control" placeholder="Pinterest URL" aria-label="Edit-pinterest" aria-describedby="Edit-pinterest">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="Edit-tiktok">
                    <i class="fab fa-tiktok fa-lg"></i>
                </span>
                <input type="text" name="tiktok" class="form-control" placeholder="Tiktok URL" aria-label="Edit-tiktok" aria-describedby="Edit-tiktok">
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>

    <!-- end col -->
    <input type="hidden" name="id">
    <div class="row align-items-center">
        <div class="col text-end">
            <button class="btn btn-warning" type="submit">Save</button>
        </div>
    </div>

</form>