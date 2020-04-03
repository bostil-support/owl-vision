@if(is_array($breadcrumbs) && count($breadcrumbs))
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <h4>{{ $breadcrumbs[count($breadcrumbs) - 1] }}</h4>
            <div class="site-pagination">
                <a href="{{ route('page.main') }}">Home</a> /
                @foreach($breadcrumbs as $item)
                    <a href="javascript:void(0);">{{ $item }}</a> @if(!$loop->last) /@endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Page info end -->
@endif