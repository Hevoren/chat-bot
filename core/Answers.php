<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;

class Answers
{
    private $classifier;

    public function __construct()
    {
        $this->trainClassifier();
    }

    private function trainClassifier()
    {
        $privetstvie = ['Привет, чем могу помочь?', 'Привет!', 'Привет, мое Бот', 'Приветствую', 'И вам добра', ];
        $randomGreeting = $privetstvie[array_rand($privetstvie)];

        $normalno = ['Хорошо!', 'Пойдет...', 'Нормально', 'Отлично!', 'У меня хорошо, у вас как?', 'Потихоньку...'];
        $randomNormalno = $normalno[array_rand($normalno)];

        $whatIsYourName = ['Я - Бот Робот', 'Бот Робот', 'Бот'];
        $randomWhtYName = $whatIsYourName[array_rand($whatIsYourName)];

        $currentDateTime = date('j F Y года H:i');

        $arr = [
            $randomGreeting => ['Привит', 'Привэт', 'Приветт', 'Прывет', 'Привет', 'Привет', 'Привет', 'Привееет', 'Привеет', 'Привет',
                'Привэт!', 'Привет', 'Приветь', 'Приветики', 'Прифет', 'Пирвет,', 'Приветтт', 'Приивет', 'Приивэт'],
            $randomNormalno => ['Как дeла?', 'Как дола?', 'Как дила?', 'Как дэлa?', 'Как дела.', 'Как дало?', 'Как деля?', 'Как делаа?', 'Как дэла?', 'Как долаа'],
            $randomWhtYName => ['Как тебя зоваут?', 'Как тебы зовут?', 'Как тибя зовут?', 'Как теба зовут?', 'Как тебя зовёт?', 'Как тебя зовутт?', 'Как тя зовут?', 'Как тебя зовють?', 'Как тебэ зовут?', 'Как тебя зовут?',
                'Как тебе зовут?', 'Как тебья зовут?', 'Как тебе зоваут?', 'Как тебя зовот?', 'Как тебя зовоут?', 'Как тебя звет?', 'Как тебя зовуту?', 'Как тебя зоват?', 'Как тебя зову?', 'Как теби зовут?'],
            $currentDateTime => ['Сколько времени', 'скольк времени', 'сколька вермини', 'сколько вримини', 'скольк временаи', 'скоолко времени',
                'скажи время', 'скаж время', 'скаже време', 'скожи время', 'скажж времи', 'скаже вримя', 'скажи вримя',
                'время', 'вримя', 'времяя', 'време', 'времья', 'времени'],
        ];

        $samples = [];
        $labels = [];

        foreach ($arr as $key => $values) {
            foreach ($values as $value) {
                $labels[] = $key;
                $chars = preg_split('//u', $value, 0, PREG_SPLIT_NO_EMPTY);
                $code = array_map('IntlChar::ord', $chars);
                $code = array_pad($code, 20, 0);
                $samples[] = $code;
            }
        }

        $this->classifier = new KNearestNeighbors();
        $this->classifier->train($samples, $labels);
    }

    public function answers($query)
    {
        if (empty($query)) {
            return 'Пожалуйста, задайте вопрос';
        }

        $chars = preg_split('//u', $query, 0, PREG_SPLIT_NO_EMPTY);
        $code = array_map('IntlChar::ord', $chars);

        if (count($code) > 20) {
            return 'Вопрос слишком длинный';
        }

        $code = array_pad($code, 20, 0);

        try {
            $result = $this->classifier->predict($code);
        } catch (Exception $e) {
            return 'Произошла ошибка: ' . $e->getMessage();
        }

        return $result;
    }
}