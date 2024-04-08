<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/bitchest_logo.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link href="https://db.onlinewebfonts.com/c/3081542a3ac5021d39ca997a127b3109?family=Celias+W05+Regular" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <title> Bitchest  </title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">
                    <img src="{{ asset('img/bitchest_logo.png') }}" alt="" class="nav__logo-img"> 
                </a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="#cryptos" class="nav__link">Cryptos</a>
                        </li>
                        @if (Route::has('login'))
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Account
                                    </a>
                                
                        <li class="nav__item">
                        @else
                            <a href="{{ route('login') }}" class="nav__link">Login</a>
                            </li>
                        <li class="nav__item">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav__link">Register</a>
                            @endif
                                @endauth
                        </li>
                        @endif
                        </li>
                    </ul>
                    
                    <div class="nav__close" id="nav-close">
                        <i class='bx bx-x' ></i>
                    </div>

                    <img src="assets/img/nav-light.png" alt="" class="nav__img">
                </div>
                <div class="nav__btns">
                    <!-- Toggle button -->
                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-grid-alt' ></i>
                    </div>
                </div>

            </nav>
        </header>

        <main class="main">
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                <div class="home__container container grid">
                    <img src="https://i.ibb.co/3mxdfjc/Untitled-design-6.png" alt="" class="home__img">

                <div class="home__data">
                <h1 class="home__title">Discover the world of cryptos in just a few minutes</h1>
                <p class="home__description">Sign up today and buy over 50 cryptocurrencies in minutes. Start with as little as $10.</p>
                    <a href="{{ route('register') }}" class="button">Register</a>
                    </div>
                </div>
            </section>


            <section class="giving section container">
                <h2 class="section__title">
                Discover crypto market trends
                </h2>

                <div class="giving__container grid">
                <div class="giving__wrapper">
                    <div class="giving__content">
                        <img src="https://cdn.pixabay.com/photo/2017/03/12/02/57/bitcoin-2136339_1280.png" alt="" class="giving__img">
                        <h3 class="giving__title">Bitcoin</h3>
                    </div>

                    <div class="giving__content">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Ethereum-icon-purple.svg/800px-Ethereum-icon-purple.svg.png" alt="" class="giving__img">
                        <h3 class="giving__title">Lithcoint</h3>
                    </div>

                    <div class="giving__content">
                        <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/256/Bitcoin-Cash-BCH-icon.png" alt="" class="giving__img">
                        <h3 class="giving__title">Bitcoincash</h3>
                    </div>

                    
                    <div class="giving__content">
                        <img src="https://i.ibb.co/km75KwK/Aigle-Logo-3-removebg-preview.png" alt="" class="giving__img">
                        <h3 class="giving__title">Aiglecoin</h3>
                    </div>

                   
                    </div>
                    </div>

                </div>
            </section>

            <!--==================== Découv ====================-->
            <section class="celebrate section container" id="achetez">
                <div class="celebrate__container grid">
                    <div class="celebrate__data">
                        <h2 class="section__title celebrate__title">
                        You are new <br>on  Bitchest ? 
                        </h2>
                        <p class="celebrate__description">
                        No problem. We make buying and selling cryptocurrencies safe and simple.
                        </p>
                        <a href="#" class="button">Buy</a>
                    </div>

                    <img src="https://i.pinimg.com/564x/52/93/8d/52938da389e57c58841861d4b9f9791f.jpg" alt="" class="celebrate__img">
                </div>
            </section>

            <!--==================== CRY ====================-->
            <section class="gift section container" id="cryptos">
                <h2 class="section__title">Buy a cryptocurrency</h2>

                <div class="gift__container grid">
                    <article class="gift__card">
                        <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/256/Bitcoin-Cash-BCH-icon.png" alt="" class="gift__img">
                        <i class='bx bx-heart gift__icon'></i>
                        
                        <h3 class="gift__price">$150</h3>
                        <span class="gift__title">Linger</span>
                        <a href="#" class="button1">Buy Now</a>
                    </article>

                    <article class="gift__card">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Ethereum-icon-purple.svg/800px-Ethereum-icon-purple.svg.png" alt="" class="gift__img">
                        <i class='bx bx-heart gift__icon'></i>
                        
                        <h3 class="gift__price">$220</h3>
                        <span class="gift__title">Lith</span>
                        <a href="#" class="button1">Buy Now</a>
                    </article>

                    <article class="gift__card">
                        <img src="https://cdn.pixabay.com/photo/2017/03/12/02/57/bitcoin-2136339_1280.png" alt="" class="gift__img">
                        <i class='bx bx-heart gift__icon'></i>
                        
                        <h3 class="gift__price">$480.000</h3>
                        <span class="gift__title">Notcoin</span>
                        <a href="#" class="button1">Buy Now</a>
                    </article>

                    </article>
                    
                </div>
            </section>

            <!--==================== MESSAGE ====================-->

            <section class="message section container" id="Référence">
                <div class="message__container grid">
                    <form action="" class="message__form">
                        <input type="email" placeholder="E-mail" class="message__input">
                        <button class="button message__button">Sending</button>
                    </form>
                </div>
            </section>
        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div>
                    <a href="#" class="footer__logo">
                        <img src="{{ asset('img/bitchest_logo.png') }}" alt="" class="footer__logo-img"> 
                     BITCHEST
                    </a>

                    <p class="footer__description">
                    Best platform <br>of cryptorency.
                    </p>
                </div>

                <div>
                    <h3 class="footer__title">Our services</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Price</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Discounts</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Shipping method</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Support</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">FAQs</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Support</a>
                        </li>
                        <li>
                            <a href="#" class="footer__link">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Available on</h3>

                    <div class="footer__aviables">
                        <img src="https://img.freepik.com/psd-gratuit/isoler-main-psd-tenant-modele-smartphone_1409-3399.jpg?w=1380&t=st=1712595024~exp=1712595624~hmac=824f6416ff44190d4fb69d1e8b60db344bd29df732b3604189a06432da0a547d" alt="" class="footer__aviable-img">
                        <img src="https://img.freepik.com/psd-gratuit/conception-informatique-realiste_1310-687.jpg?w=1480" alt="" class="footer__aviable-img">
                    </div>
                </div>
            </div>
        </footer>
      
        <a href="#" class="scrollup" id="scroll-up"> 
            <i class='bx bx-up-arrow-alt scrollup__icon' ></i>
        </a>
        <script src="{{ asset('js/home.js') }}"></script>
    </body>
</html>