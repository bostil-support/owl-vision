@php
    /** @var \App\Models\Category $category */
@endphp

<li>
    <a href="{{ route('frontend.shop.category', $category->slug) }}">{{ $category->name }}</a>
    @if($category->children)
        <ul class="sub-menu">
            @foreach($category->children as $child)
                @include('partials.filter-category', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>