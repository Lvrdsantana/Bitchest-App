

// show or hide sidebar //

const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const sidebar = document.querySelector('aside');

menuBtn.addEventListener('click', () => {
    sidebar.style.display = 'block';
})
closeBtn.addEventListener('click', () => {
    sidebar.style.display = 'none';
})

// change theme //
const themeBtn = document.querySelector('.theme-btn');

themeBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');

    themeBtn.querySelector('span:first-child').classList.toggle('active');
    themeBtn.querySelector('span:last-child').classList.toggle('active');
})

// trade





document.addEventListener('DOMContentLoaded', () => {
  
    let selectedCurrency = null;
    let ownedCurrencies = {};
    const graphData = {};
    const currencyElements = {};
    const currencies = [
        { name: 'Bitcoin', value: 800, luckPercent: 40 },
        { name: 'Ethereum', value: 5, luckPercent: 20 },
        { name: 'Ripple', value: 600, luckPercent: 30 },
        { name: 'Bitcoin Cash', value: 600, luckPercent: 15 },
        { name: 'Cardano', value: 20, luckPercent: 50 },
        { name: 'Litecoin', value: 15, luckPercent: 70 },
        { name: 'NEM', value: 140, luckPercent: 65 },
        { name: 'Stellar', value: 500, luckPercent: 55 },
        { name: 'IOTA', value: 5, luckPercent: 40 },
        { name: 'Dash', value: 80, luckPercent: 5 }
    ];                                   

    // DOM Elements
    const walletDisplay = document.getElementById('wallet');
    const currencyButtonsDiv = document.getElementById('currencyButtons');
    const selectedCurrencyDiv = document.getElementById('selectedCurrency');
    const selectedCurrencyValueDiv = document.getElementById('selectedCurrencyValue');
    const selectedCurrencyBoughtValueDiv = document.getElementById('selectedCurrencyBoughtValue');
    const selectedCurrencyPotentialValueDiv = document.getElementById('selectedCurrencyPotentialValue');
    const ownedCurrenciesDiv = document.getElementById('ownedCurrencies');
    const graphDiv = document.getElementById('graphValues');
    const topValuedCurrenciesUl = document.getElementById('topValuedCurrencies');

    function updateWalletDisplay() {
        walletDisplay.textContent = `Money: $${money.toFixed(2)}`;
    }

    function updateOwnedCurrenciesDisplay() {
        ownedCurrenciesDiv.textContent = 'Owned Currencies: ' + Object.keys(ownedCurrencies).join(', ');
    }

    function updateGraphDisplay() {
        graphDiv.textContent = graphData[selectedCurrency.name].join(', ');
    }

    function updateTopValuedCurrenciesDisplay() {
        const topCurrencies = [...currencies].sort((a, b) => b.value - a.value).slice(0, 3);
        topValuedCurrenciesUl.innerHTML = topCurrencies.map(currency => `<li>${currency.name} - $${currency.value.toFixed(2)}</li>`).join('');
    }

    function selectCurrency(currency) {
        selectedCurrency = currency;
        selectedCurrencyDiv.textContent = `Selected Currency: ${currency.name}`;
        selectedCurrencyValueDiv.textContent = `Current Value: $${currency.value.toFixed(2)}`;
        selectedCurrencyBoughtValueDiv.textContent = `Bought Value: $${(ownedCurrencies[currency.name] || 0).toFixed(2)}`;

        const potentialValue = (ownedCurrencies[currency.name] || 0) * currency.value * 0.9;
        selectedCurrencyPotentialValueDiv.textContent = `Potential Sell Value (after 10% fee): $${potentialValue.toFixed(2)}`;

        if (!graphData[currency.name]) {
            graphData[currency.name] = [];
        }
        updateGraphDisplay();
    }

    function buyCurrency(amount, currency) {
        const cost = amount * currency.value;
        if (money >= cost) {
            money -= cost;
            ownedCurrencies[currency.name] = (ownedCurrencies[currency.name] || 0) + amount;
            updateWalletDisplay();
            updateOwnedCurrenciesDisplay();
            selectCurrency(currency); // Update the potential value and bought value
        } else {
            alert("Not enough funds to buy!");
        }
    }

    function sellCurrency(amount, currency) {
        if (ownedCurrencies[currency.name] >= amount) {
            money += amount * currency.value * 0.9; // 10% fee
            ownedCurrencies[currency.name] -= amount;
            if (ownedCurrencies[currency.name] === 0) {
                delete ownedCurrencies[currency.name];
            }
            updateWalletDisplay();
            updateOwnedCurrenciesDisplay();
            selectCurrency(currency); // Update the potential value and bought value
        } else {
            alert("You do not own enough of this currency to sell!");
        }
    }

    function sellAll(currency) {
        if (ownedCurrencies[currency.name]) {
            sellCurrency(ownedCurrencies[currency.name], currency);
        }
    }

    function clearGraph(currency) {
        graphData[currency.name] = [];
        updateGraphDisplay();
    }

    function createCurrencyButtons() {
        currencyButtonsDiv.innerHTML = '';
        currencies.forEach(currency => {
            const button = document.createElement('button');
            button.textContent = currency.name;
            button.onclick = () => selectCurrency(currency);
            currencyButtonsDiv.appendChild(button);
            currencyElements[currency.name] = button;
        });
    }

    createCurrencyButtons();
    updateWalletDisplay();
    updateTopValuedCurrenciesDisplay();

    // Interval to update currency values
    setInterval(() => {
        currencies.forEach(currency => {
            const randomChange = (Math.random() - 0.5) * 2;
            const luckImpact = (currency.luckPercent / 100) - 0.5;
            currency.value *= 1 + (randomChange + luckImpact) * 0.01;

            currency.value = Math.max(currency.value, 1); // Prevent currency from dropping below $1

            // Update the graph with new values
            if (!graphData[currency.name]) {
                graphData[currency.name] = [];
            }
            graphData[currency.name].push(currency.value.toFixed(2));
            if (graphData[currency.name].length > 20) {
                graphData[currency.name].shift(); // Keep only the last 20 data points
            }

            // Update the display for the selected currency
            if (selectedCurrency && currency.name === selectedCurrency.name) {
                updateGraphDisplay();
                selectedCurrencyValueDiv.textContent = `Current Value: $${currency.value.toFixed(2)}`;
                const potentialValue = (ownedCurrencies[currency.name] || 0) * currency.value * 0.9;
                selectedCurrencyPotentialValueDiv.textContent = `Potential Sell Value (after 10% fee): $${potentialValue.toFixed(2)}`;
            }
        });

        updateTopValuedCurrenciesDisplay();
        updateWalletDisplay();
    }, 1000);

    // Button event listeners
    document.getElementById('buyBtn').addEventListener('click', () => {
        const amount = parseFloat(document.getElementById('buyAmount').value);
        if (selectedCurrency && amount > 0) {
            buyCurrency(amount, selectedCurrency);
        }
    });

    document.getElementById('sellBtn').addEventListener('click', () => {
        const amount = parseFloat(document.getElementById('sellAmount').value);
        if (selectedCurrency && amount > 0) {
            sellCurrency(amount, selectedCurrency);
        }
    });

    document.getElementById('sellAllBtn').addEventListener('click', () => {
        if (selectedCurrency) {
            sellAll(selectedCurrency);
        }
    });

    document.getElementById('clearGraphBtn').addEventListener('click', () => {
        if (selectedCurrency) {
            clearGraph(selectedCurrency);
        }
    });
});
