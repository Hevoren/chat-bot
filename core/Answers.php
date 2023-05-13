<?php

require_once '../vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;

class Answers
{

    function answers($query)
    {
        $arr = [
            'Привет, чем могу помочь?' => ['привет', 'привед', 'прывет', 'превед', 'приэвед', 'бривед'],
            'Как дела' => ['как дла', 'каак дела', 'как дила', 'кок дила', 'как дола']
            ];
        $samples = [];
        $labels = [];
        foreach ($arr as $key => $values) {
            foreach ($values as $value) {
                $labels[] = $key;
                $chars = preg_split('//u', $value, 0, PREG_SPLIT_NO_EMPTY);
                $code = [];
                foreach ($chars as $char)
                    $code[] = IntlChar::ord($char);

                if (count($code) < 10) {
                    $i = count($code);
                    while ($i <= 10) {
                        $code[] = 0;
                        $i++;
                    }
                }

                $samples[] = $code;
            }

        }


        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        $str = $query;

        $chars = preg_split('//u', $str, 0, PREG_SPLIT_NO_EMPTY);
        $a = [];
        foreach ($chars as $char) {
            $a[] = IntlChar::ord($char);
        }
        if (count($a) < 10) {
            $i = count($a);
            while ($i <= 10) {
                $a[] = 0;
                $i++;
            }
        }

        return $classifier->predict($a);
    }


}