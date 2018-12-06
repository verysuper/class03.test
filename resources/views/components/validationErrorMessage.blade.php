
@if (count($errors) > 0)
    <div class="alert alert-warning" role="alert">
            <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
    </ul>
    </div>

@endif
