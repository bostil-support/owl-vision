@php
    /** @var \Illuminate\Support\Collection $categories */
    /** @var \App\Models\Category $category */
@endphp

<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            <li><a href="{{ route('page.main') }}">Home</a></li>
            @if($categories->count())
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('frontend.shop.category', $category->slug) }}">{{ $category->name }}
                            @if($loop->last)
                                <span class="new">New</span>
                            @endif
                        </a>
                        @if($category->children_count)
                            <ul class="sub-menu">
                                @foreach($category->children as $child)
                                    <li>
                                        <a href="{{ route('frontend.shop.category', $child->slug) }}">{{ $child->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
            <li><a href="javascript:void(0);">Pages</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('page.contact') }}">Contact Page</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Blog</a></li>
        </ul>
    </div>
</nav>