<?php

namespace App\Services;

use Carbon\Carbon;

trait DateFormatService
{

    /**
     * Formata a data 2016-01-22 15:07:41 para 22-01-2016 15:07:41
     *
     * @param        $date
     *
     * @param string $format
     *
     * @return string
     */
    public function formatDate($date, $format = 'd/m/Y H:i:s')
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
        } else {
            return null;
        }
    }


    public function formatCurrencyValue($string){
        return "R$ " . str_replace('.',',',$string);
    }
}
