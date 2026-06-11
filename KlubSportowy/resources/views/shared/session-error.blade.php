@if(($errors->any()))
    <div class="alert alert-danger justify-content-center d-flex align-content-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="list-unstyled">{{ $error }}</li>
             @endforeach
        </ul>
    </div>
@endif
