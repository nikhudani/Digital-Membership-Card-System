<style>

    .dropzone {
        padding: 5px;
        min-height: auto;
    }

    .dropzone .dz-message {
        margin: 0;
    }

    #logo.dropzone .dz-preview .dz-image {
        overflow: unset !important;
        width: -webkit-fill-available !important;
        height: 70px !important;
    }

    #logo .dz-preview .dz-image img {
        height: 70px;
    }

    #logo .dz-preview {
        margin: 0;
        min-height: 100%
    }

    /* favicon */
    #favicon.dropzone .dz-preview .dz-image {
        overflow: unset !important;
        width: 48px !important;
        height: 48px !important;
    }

    #favicon .dz-preview .dz-image img {
        height: 48px;
    }

    #favicon .dz-preview {
        margin: 0;
        min-height: 100%
    }

</style>
<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="mt-n4 position-relative mb-3">
                    <label>Logo</label>
                    <div class="text-center">
                        <form id="logo" action="{{route('logo')}}" class="dropzone dz-clickable">
                            <div class="fallback">
                                <input type="file" name="logo" accept=".png,.jpg,.jpeg,.svg" hidden>
                            </div>
                            <div class="dz-message needsclick">
                                <img src="{{asset("images/brand")}}/{{TE::system('logo', 'logo.png')}}" style="width: -webkit-fill-available;" onerror="this.parentNode.replaceChild(document.createTextNode('240x70'), this);"/>
                                {{-- 240x70 --}}
                            </div>
                        </form>
                    </div>
                    <small>
                        <p class="mb-0 text-center">
                            <em>
                                <code>.png,.jpg,.jpeg,.svg</code>
                            </em>
                            
                        </p>
                    </small>
                </div>
            </div> <!-- end card body -->
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Favicon -->
                <div class="mt-n4 position-relative mb-3">
                    <label>Favicon</label>
                    <div class="text-center">
                        <form id="favicon" action="{{route('favicon')}}" class="dropzone dz-clickable">
                            <div class="fallback">
                                <input type="file" name="favicon" accept=".ico" hidden>
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-2 mt-2">
                                <img src="{{asset("images/brand/favicon.ico")}}" style="width: 48px;" onerror="this.parentNode.replaceChild(document.createTextNode('48x48'), this);"/>                                
                                </div>                                    
                            </div>
                        </form>
                    </div>
                    <small>
                        <p class="mb-0 text-center">
                            <em>
                                <code>.ico</code>
                            </em>
                        </p>
                    </small>
                </div>
            </div> <!-- end card body -->
        </div>
    </div>
    <!--  -->
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Branding</h4>
                <p class="card-title-desc">
                    You may able to branding the system here.
                </p>
                <form action="{{route('system-brand')}}" method="post">

                    <div class="row mb-3">
                        <label for="appname" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="appname" name="title" class="form-control" value="{{ config('app.name') }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="appname" class="col-sm-2 col-form-label">About</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" class="form-control" rows="8">{{ TE::system('about') }}</textarea>
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

<div id="logo-template" hidden>

    <div class="row justify-content-center">
        <div class="col">
            <img data-dz-thumbnail style="width: -webkit-fill-available;"/>
            <p class="mt-2 mb-0">
                <small data-dz-errormessage class="text-danger"></small>
            </p>
        </div>
    </div>
    
</div>

<div id="favicon-template" hidden>

    <div class="row justify-content-center">
        <div class="col">
            <img data-dz-thumbnail style="width: 48px;"/>
            <p class="mt-2 mb-0">
                <small data-dz-errormessage class="text-danger"></small>
            </p>
        </div>
    </div>
    
</div>

