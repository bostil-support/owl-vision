@php
    /** @var \App\Models\Category $category */
@endphp

<li>
    <a href="{{ route('frontend.shop.category', $category->slug) }}">
        {{ $category->name }}
        @if(isset($count))
            <span>({{ $count }})</span>
        @endif
    </a>
    @if($category->children)
        <ul class="sub-menu">
            @foreach($category->children as $child)
                @include('partials.filter-category', ['category' => $child, 'count' => $child->products->count()])
            @endforeach
        </ul>
    @endif
</li>