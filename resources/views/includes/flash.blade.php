<div class="row mb-3">
    <div class="col-12">
        @if ($message = Session::get('alert-success'))
        <div class="alert alert-success alert-block my-0">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('alert-error'))
        <div class="alert alert-danger alert-block my-0">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('alert-warning'))
        <div class="alert alert-warning alert-block my-0">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('alert-info'))
        <div class="alert alert-info alert-block my-0">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        {{-- @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                <li class="mb-1"><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
        @endif --}}
    </div>
</div>
