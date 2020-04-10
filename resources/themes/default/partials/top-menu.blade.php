<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            <li><a href="{{ route('page.main') }}">Home</a></li>
            @if($categories->count())
                @foreach($categories as $category)
                    <li>
                        <a href="#">{{ $category->name }}
                            @if($loop->last)
                                <span class="new">New</span>
                            @endif
                        </a>
                        @if($category->children->count())
                            <ul class="sub-menu">
                                @foreach($category->children as $subcategory)
                                    <li><a href="#">{{ $subcategory->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
            <li><a href="#">Pages</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('page.product') }}">Product Page</a></li>
                    <li><a href="{{ route('page.category') }}">Category Page</a></li>
                    <li><a href="{{ route('page.cart') }}">Cart Page</a></li>
                    <li><a href="{{ route('page.checkout') }}">Checkout Page</a></li>
                    <li><a href="{{ route('page.contact') }}">Contact Page</a></li>
                </ul>
            </li>
            <li><a href="#">Blog</a></li>
        </ul>
    </div>
</nav>