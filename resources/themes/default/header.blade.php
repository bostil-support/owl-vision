<!-- Header section -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="{{ route('page.main') }}" class="site-logo">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <form class="header-search-form">
                        <input type="text" placeholder="Search on divisima ....">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">
                        <div class="up-item">
                            <i class="flaticon-profile"></i>
                            @guest
                                <a href="{{ route('login') }}">Sign In</a> or <a href="{{ route('register') }}">Create Account</a>
                            @else
                                <a href="{{ route('frontend.profile') }}">Profile</a> or <a href="javascript:document.getElementById('logout').submit();">Logout</a>
                                <form id="logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @auth('customer')
                                        <input type="hidden" name="_guard" value="customer">
                                    @endauth
                                </form>
                            @endauth
                        </div>
                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                                <span>0</span>
                            </div>
                            <a href="{{ route('page.cart') }}">Shopping Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.top-menu')
</header>
<!-- Header section end -->