<?php
// TransactionController.php
// Dans votre fichier de contrôleur

use App\Models\Transaction;
use App\Models\User;

function buyCurrency ($amount, $currency) {
    $cost = $amount * $currency->value;
    $user = auth()->user();

    // Vérifier si l'utilisateur a assez de fonds
    if ($user->balance_eur >= $cost) {
        // Déduire le coût de l'achat du solde de l'utilisateur
        $user->balance_eur -= $cost;
        $user->save();

        // Enregistrer la transaction dans la base de données
        Transaction::create([
            'user_id' => $user->id,
            'crypto_id' => $currency->id,
            'transaction_type' => 'achat',
            'quantity' => $amount,
            'transaction_price_eur' => $cost
        ]);

        // Mettre à jour les crypto-monnaies possédées par l'utilisateur
        if (isset($user->ownedCurrencies[$currency->name])) {
            $user->ownedCurrencies[$currency->name] += $amount;
        } else {
            $user->ownedCurrencies[$currency->name] = $amount;
        }

        // Mettre à jour l'affichage et la base de données
        updateWalletDisplay();
        updateOwnedCurrenciesDisplay();
        selectCurrency($currency);
    } else {
        // Gérer le cas où l'utilisateur n'a pas assez de fonds
        alert("Fonds insuffisants pour acheter !");
    }
}

function sellCurrency($amount, $currency) {
    $user = auth()->user();

    // Vérifier si l'utilisateur possède suffisamment de la crypto-monnaie à vendre
    if (isset($user->ownedCurrencies[$currency->name]) && $user->ownedCurrencies[$currency->name] >= $amount) {
        // Calculer le montant de la vente
        $saleAmount = $amount * $currency->value * 0.9; // 10% de frais

        // Ajouter le montant de la vente au solde de l'utilisateur
        $user->balance_eur += $saleAmount;
        $user->save();

        // Enregistrer la transaction dans la base de données
        Transaction::create([
            'user_id' => $user->id,
            'crypto_id' => $currency->id,
            'transaction_type' => 'vente',
            'quantity' => $amount,
            'transaction_price_eur' => $saleAmount
        ]);

        // Mettre à jour les crypto-monnaies possédées par l'utilisateur
        $user->ownedCurrencies[$currency->name] -= $amount;
        if ($user->ownedCurrencies[$currency->name] === 0) {
            unset($user->ownedCurrencies[$currency->name]);
        }

        // Mettre à jour l'affichage et la base de données
        updateWalletDisplay();
        updateOwnedCurrenciesDisplay();
        selectCurrency($currency);
    } else {
        // Gérer le cas où l'utilisateur ne possède pas suffisamment de la crypto-monnaie à vendre
        alert("Vous ne possédez pas assez de cette crypto-monnaie pour vendre !");
    }

}
