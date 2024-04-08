<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UserAccount</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Userdashboard.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <nav>
        <div class="container">
            <img src="{{ asset('img/bitchest_logo.png') }}" class="logo" alt="logo">
            <div class="profile-area">
                <div class="theme-btn">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <!-- navbar -->
                <nav x-data="{ open: false }" class="bg-darkreader border-b border-gray-100">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">


                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-responsive-nav-link>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <x-responsive-nav-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- main -->
    <main>

        <!-- aside -->
        <aside>
            <button id="close-btn">
                <span class="material-icons-sharp">close</span>
            </button>
            <div class="sidebar">
                <a href="#" class="active">
                    <span class="material-icons-sharp">dashboard</span>
                    <h4>Dashboard</h4>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">account_balance_wallet</span>
                    <h4>Wallet</h4>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">payment</span>
                    <h4>Transactions</h4>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">pie_chart</span>
                    <h4>Analytics</h4>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">insert_comment</span>
                    <h4>Messages</h4>
                </a>
            </div>
        </aside>

        <!-- section middle -->
        <section class="middle">
            <div class="header">
                <h1>Overview</h1>
                <input type="date">
            </div>
            <div class="cards">
                <!-- card-->
                <div class="card">
                    <div class="top">
                        <div class="left">
                            <img src="img/USDT.png" alt="card3-1">
                            <h2>Wallet</h2>
                        </div>
                        <img src="img/master card.png" class="right" alt="card3-2">
                    </div>
                    <div class="middle">
                        <h1> {{ $balance_eur }} EURO</h1> <!-- Afficher le solde de l'utilisateur -->
                        <div class="chip">
                            <img src="img/card chip.png" class="chip" alt="card-chip">
                        </div>
                    </div>

                </div>
            </div>
            <br><br>

            <div id="wallet">Money: {{ $balance_eur }}</div>
            <input type="text" id="searchBar" placeholder="Search Currency...">

            <div id="currencyContainer">
                <div id="currencyButtons" bis_skin_checked="1">
                    <button>Bitcoin</button><button>Ethereum</button><button>Ripple</button><button>Bitcoin Cash</button><button>Cardano</button><button>Litecoin</button><button>NEM</button><button>Stellar</button><button>IOTA</button><button>Dash</button>
                </div>
            </div>
            </div>
            </div>

            <div id="selectedCurrencyInfo">
                <div id="selectedCurrency"></div>
                <div id="selectedCurrencyValue"></div>
                <div id="selectedCurrencyBoughtValue"></div>
                <div id="selectedCurrencyPotentialValue"></div>
            </div>

            <div id="ownedCurrencies"></div>

            <div id="transactionMessage"></div>

            <div id="graphContainer">
                <div id="graph">Graph: <span id="graphValues"></span></div>
                <button id="clearGraphBtn">Clear Graph</button>
            </div>

            <form action="{{ route('acheter-crypto') }}" method="post">
                @csrf
                <input type="number" name="quantity" placeholder="Quantité à acheter" min="1">
                <button type="submit">Acheter</button>
            </form>

            <form action="{{ route('vendre-crypto') }}" method="post">
                @csrf
                <input type="number" name="quantity" placeholder="Quantité à vendre" min="1">
                <button type="submit">Vendre</button>
            </form>

            <form action="{{ route('vendre-crypto') }}" method="post">
                @csrf
                <input type="hidden" name="quantity" value="all">
                <button type="submit">Tout vendre</button>
            </form>


            <div id="topCurrencies">
                <h3>Top 3 Valued Currencies:</h3>
                <ul id="topValuedCurrencies"></ul>
            </div>



            <!-- canvas -->
            <canvas id="myChart"></canvas>

            <script>
                // Création du graphique
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({
                            length: 30
                        }, (_, i) => 'Days ' + (i + 1)),
                        datasets: []
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        }
                    }
                });

                // Fonction pour obtenir une couleur aléatoire
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

                // Appel AJAX pour obtenir les données des cotations depuis le script PHP
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'cotation_generator.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var citations = JSON.parse(xhr.responseText);

                            // Ajouter les données des crypto-monnaies au graphique
                            Object.keys(citations).forEach(function(currency) {
                                myChart.data.datasets.push({
                                    label: currency,
                                    data: citations[currency],
                                    fill: false,
                                    borderColor: getRandomColor(),
                                    tension: 0.1
                                });
                            });

                            myChart.update();
                        } else {
                            console.error('Erreur lors de la récupération des données de cotation:', xhr.status);
                        }
                    }
                };
                xhr.send();
            </script>

            <canvas id="chart"></canvas>



        </section>

        <!-- section right -->
        <section class="right">

            <!-- recent transaction -->
            <div class="recent-transactions">
                <div class="header">
                    <h2>Recent Transactions</h2>
                    <a href="#">More <span class="material-icons-sharp">chevron_right</span></a>
                </div>

                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-purple-light">
                            <span class="material-icons-sharp purple">headset</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Music</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-danger">
                            <img src="img/visa.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*3034</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$8</h4>
                </div>
                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-purple-light">
                            <span class="material-icons-sharp purple">shopping_bag</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Shopping</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-primary">
                            <img src="img/visa.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*4473</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$58</h4>
                </div>
                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-success-light">
                            <span class="material-icons-sharp success">restaurant</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Restaurant</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-dark">
                            <img src="img/master card.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*1618</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$20</h4>
                </div>
                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-danger-light">
                            <span class="material-icons-sharp danger">sports_esports</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Games</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-danger">
                            <img src="img/visa.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*2488</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$31</h4>
                </div>
                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-danger-light">
                            <span class="material-icons-sharp danger">medication</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Pharmacy</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-primary">
                            <img src="img/visa.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*2757</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$44</h4>
                </div>
                <div class="transaction">
                    <div class="service">
                        <div class="icon bg-success-light">
                            <span class="material-icons-sharp success">fitness_center</span>
                        </div>
                    </div>
                    <div class="details">
                        <h4>Fitness</h4>
                        <p>07.02.2023</p>
                    </div>
                    <div class="card-details">
                        <div class="card bg-dark">
                            <img src="img/master card.png" alt="card1">
                        </div>
                        <div class="details">
                            <p>*0765</p>
                            <small class="text-muted">Credit Card</small>
                        </div>
                    </div>
                    <h4>-$19</h4>
                </div>

            </div>
        </section>
    </main>
    <script src="{{ asset('js/userdashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>

</body>

</html>