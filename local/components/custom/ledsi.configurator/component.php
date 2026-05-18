<?php
declare(strict_types=1);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$floatParam = static function (mixed $value, float $default, float $min, float $max): float {
    $normalized = str_replace(',', '.', trim((string)$value));

    if (!is_numeric($normalized)) {
        return $default;
    }

    $number = (float)$normalized;
    if (!is_finite($number) || $number < $min || $number > $max) {
        return $default;
    }

    return $number;
};

$stringParam = static function (mixed $value): string {
    return trim((string)$value);
};

$arResult = [
    'TITLE' => $stringParam($arParams['TITLE'] ?? 'Конфигуратор LED-экрана'),
    'DESCRIPTION' => $stringParam($arParams['DESCRIPTION'] ?? ''),
    'DEFAULT_WIDTH' => $floatParam($arParams['DEFAULT_WIDTH'] ?? 3, 3.0, 0.1, 100.0),
    'DEFAULT_HEIGHT' => $floatParam($arParams['DEFAULT_HEIGHT'] ?? 2, 2.0, 0.1, 100.0),
    'DEFAULT_PITCH' => $floatParam($arParams['DEFAULT_PITCH'] ?? 2.5, 2.5, 0.5, 50.0),
    'DEFAULT_CABINET_WIDTH' => $floatParam($arParams['DEFAULT_CABINET_WIDTH'] ?? 500, 500.0, 100.0, 2000.0),
    'DEFAULT_CABINET_HEIGHT' => $floatParam($arParams['DEFAULT_CABINET_HEIGHT'] ?? 500, 500.0, 100.0, 2000.0),
    'DEFAULT_POWER' => $floatParam($arParams['DEFAULT_POWER'] ?? 350, 350.0, 1.0, 2000.0),
    'SHOW_LEAD_FORM' => (($arParams['SHOW_LEAD_FORM'] ?? 'Y') === 'Y'),
    'LEAD_BUTTON_TEXT' => $stringParam($arParams['LEAD_BUTTON_TEXT'] ?? 'Отправить расчёт менеджеру'),
    'CSS_CLASS' => preg_replace('/[^a-zA-Z0-9_\-\s]/', '', (string)($arParams['CSS_CLASS'] ?? '')) ?? '',
    'PITCH_OPTIONS' => [1.25, 1.53, 1.86, 2.0, 2.5, 3.0, 3.91, 4.0, 5.0, 6.0, 8.0, 10.0],
    'CABINET_OPTIONS' => [
        ['WIDTH' => 500.0, 'HEIGHT' => 500.0, 'NAME' => '500 × 500 мм'],
        ['WIDTH' => 500.0, 'HEIGHT' => 1000.0, 'NAME' => '500 × 1000 мм'],
        ['WIDTH' => 640.0, 'HEIGHT' => 480.0, 'NAME' => '640 × 480 мм'],
        ['WIDTH' => 960.0, 'HEIGHT' => 960.0, 'NAME' => '960 × 960 мм'],
    ],
];

$this->IncludeComponentTemplate();
