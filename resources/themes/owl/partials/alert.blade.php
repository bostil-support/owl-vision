@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp

@if($errors->any())
    <div class="alert alert-danger">
        @if(count($errors->all()) > 1)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @else
            {!! $errors->first() !!}
        @endif

    </div>
@endif
@if(Session::has('success_message'))
    <div class="alert alert-success" role="alert">{!! Session::get('success_message') !!}</div>
@endif