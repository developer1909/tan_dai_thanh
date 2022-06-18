@if(!empty($errors))
    @if ($errors->has('general'))
        <div class="alert alert-danger background-danger" style="margin-bottom: 15px !important;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled text-white"></i>
            </button>
            <strong>{{ implode('/', $errors->get('general')) }}!</strong>
        </div>
    @endif
@endif

@if (session()->get('success'))
    <div class="m-b-15 alert alert-success background-success" style="margin-bottom: 15px !important;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="icofont icofont-close-line-circled text-white"></i>
        </button>
        <strong>{{ session()->get('success') }}!</strong>
    </div>
@endif
