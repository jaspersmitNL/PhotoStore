@if(\Illuminate\Support\Facades\Session::has('ok'))
    <div class="mb-5 mt-5">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{\Illuminate\Support\Facades\Session::get('ok')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

@endif

@if(\Illuminate\Support\Facades\Session::has('fail'))
    <div class="mb-5 mt-5">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{\Illuminate\Support\Facades\Session::get('fail')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
