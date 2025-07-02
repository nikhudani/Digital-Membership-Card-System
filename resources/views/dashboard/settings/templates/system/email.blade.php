<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="mt-n4 position-relative">
                    <label>Gmail</label>
                    <div class="text-start mb-2">
                        <button id="load-gmail" class="btn btn-outline-danger w-100">
                            Load configuration
                        </button>
                    </div>
                    <small>
                        <p class="mb-0">
                            <em>
                                Click to load gmail mail configuration.
                            </em>
                        </p>
                    </small>
                </div>
            </div> <!-- end card body -->
        </div>
    </div>

    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">System email</h4>
                <p class="card-title-desc">
                    Setup email for sending emails from system to users email, this setup is important for authentication propose!
                </p>
                <form id="form-email-setup" action="{{route('system-mail')}}" method="post">
                    <div class="row mb-3">
                        <label for="mail_mailer" class="col-sm-2 col-form-label">Mailer</label>
                        <div class="col-sm-10">
                            <input type="text" id="mail_mailer" name="mail_mailer" class="form-control" value="{{ config('mail.mailers.smtp.transport') }}" placeholder="smtp">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="mail_host" class="col-sm-2 col-form-label">Host</label>
                        <div class="col-sm-10">
                            <input type="text" id="mail_host" name="mail_host" class="form-control" value="{{config('mail.mailers.smtp.host')}}" placeholder="smtp.server.com">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mail_port" class="col-sm-2 col-form-label">Port</label>
                        <div class="col-sm-10">
                            <input type="number" id="mail_port" name="mail_port" class="form-control" value="{{config('mail.mailers.smtp.port')}}" placeholder="465">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mail_username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="email" id="mail_username" name="mail_username" class="form-control" value="{{config('mail.mailers.smtp.username')}}" placeholder="no-reply@example.com">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mail_password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" id="mail_password" name="mail_password" class="form-control" value="{{config('mail.mailers.smtp.password')}}">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mail_encryption" class="col-sm-2 col-form-label">Encryption</label>
                        <div class="col-sm-10">
                            <input type="text" id="mail_encryption" name="mail_encryption" class="form-control" value="{{config('mail.mailers.smtp.encryption')}}" placeholder="ssl">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mail_from_address" class="col-sm-2 col-form-label">From Address</label>
                        <div class="col-sm-10">
                            <input type="email" id="mail_from_address" name="mail_from_address" class="form-control" value="{{config('mail.from.address')}}" placeholder="contact@example.com">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>