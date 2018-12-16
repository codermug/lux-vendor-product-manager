<?php

namespace App\Inc;

class CurrencyManager { 

    function get_current_currency() {

        global $WOOCS;
        return $WOOCS->current_currency;
       //echo get_woocommerce_currency();
       //return get_woocommerce_currency();
    }

    function get_current_currency_rate() {
        global $WOOCS;
        $currencies = $WOOCS->get_currencies();
        return $currencies[$WOOCS->current_currency]['rate'];
    }


} 