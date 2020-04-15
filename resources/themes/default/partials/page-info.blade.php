@if(is_array($breadcrumbs) && count($breadcrumbs))
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <h4>{{ last($breadcrumbs) }}</h4>
            <div class="site-pagination">
                <a href="{{ route('page.main') }}">Home</a>
                @foreach($breadcrumbs as $permalink => $title)
                    / <a href="{{ is_numeric($permalink) ? 'javascript:void(0);' : $permalink }}">{{ $title }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Page info end -->
@endif