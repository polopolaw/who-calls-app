<header class="header pt-6 xl:pt-12">
    <div class="container">
        <div class="header-inner flex items-center justify-between lg:justify-start">
            <div class="header-logo shrink-0">
                <a href="{{ route('home') }}" rel="home">
                    <img src="{{ Vite::image('logo.png') }}"
                         class="w-[80px] xs:w-[90px] md:w-[100px]"
                         alt="{{ config('app.name') }}">
                </a>
            </div><!-- /.header-logo -->
            <div class="header-menu grow hidden lg:flex items-center ml-8 mr-8 gap-8">
                <nav class="hidden 2xl:flex gap-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-pink font-bold">Главная</a>
                    <a href="catalog.html" class="text-white hover:text-pink font-bold">Каталог товаров</a>
                    <a href="cart.html" class="text-white hover:text-pink font-bold">Корзина</a>
                </nav>
            </div><!-- /.header-menu -->
            <div class="header-actions flex items-center gap-3 md:gap-5">
                @auth
                    <x-profile.profile-dropdown/>
                @elseguest
                    <x-actions.login/>
                @endauth

                <button id="burgerMenu" class="flex 2xl:hidden text-white hover:text-pink transition">
                    <span class="sr-only">Меню</span>
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div><!-- /.header-actions -->
        </div><!-- /.header-inner -->
    </div><!-- /.container -->
</header>
