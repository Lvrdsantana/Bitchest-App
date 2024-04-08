<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotationController extends Controller
{
    public function generate()
    {
        $cryptoCurrencies = [
            'Bitcoin',
            'Ethereum',
            'Ripple',
            'Bitcoin Cash',
            'Cardano',
            'Litecoin',
            'NEM',
            'Stellar',
            'IOTA',
            'Dash'
        ];

        $citations = [];

        foreach ($cryptoCurrencies as $currency) {
            $firstCotation = getFirstCotation($currency);
            $citations[$currency] = [$firstCotation];

            for ($i = 0; $i < 29; $i++) {
                $citations[$currency][] = $citations[$currency][$i] + getCotationFor($currency);
            }
        }

        return view('UserAccount', compact('citations'));
    }
}