@if (count($breadcrumbs))
    <div class="site-pagination">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a> /
            @else
                <span>{{ $breadcrumb->title }}</span>
            @endif

        @endforeach
    </div>
@endif
