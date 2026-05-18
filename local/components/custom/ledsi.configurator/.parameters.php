<?php
declare(strict_types=1);
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Заголовок блока',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Конфигуратор LED-экрана',
        ],
        'DESCRIPTION' => [
            'PARENT' => 'BASE',
            'NAME' => 'Описание под заголовком',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Рассчитайте ориентировочные параметры LED-экрана: разрешение, площадь, количество кабинетов и энергопотребление.',
        ],
        'DEFAULT_WIDTH' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Ширина экрана по умолчанию, м',
            'TYPE' => 'STRING',
            'DEFAULT' => '3',
        ],
        'DEFAULT_HEIGHT' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Высота экрана по умолчанию, м',
            'TYPE' => 'STRING',
            'DEFAULT' => '2',
        ],
        'DEFAULT_PITCH' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Шаг пикселя по умолчанию, мм',
            'TYPE' => 'LIST',
            'VALUES' => [
                '1.25' => 'P1.25',
                '1.53' => 'P1.53',
                '1.86' => 'P1.86',
                '2' => 'P2',
                '2.5' => 'P2.5',
                '3' => 'P3',
                '3.91' => 'P3.91',
                '4' => 'P4',
                '5' => 'P5',
                '6' => 'P6',
                '8' => 'P8',
                '10' => 'P10',
            ],
            'DEFAULT' => '2.5',
        ],
        'DEFAULT_CABINET_WIDTH' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Ширина кабинета по умолчанию, мм',
            'TYPE' => 'STRING',
            'DEFAULT' => '500',
        ],
        'DEFAULT_CABINET_HEIGHT' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Высота кабинета по умолчанию, мм',
            'TYPE' => 'STRING',
            'DEFAULT' => '500',
        ],
        'DEFAULT_POWER' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Среднее потребление, Вт/м²',
            'TYPE' => 'STRING',
            'DEFAULT' => '350',
        ],
        'SHOW_LEAD_FORM' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Показывать блок заявки',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'LEAD_BUTTON_TEXT' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Текст кнопки заявки',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Отправить расчёт менеджеру',
        ],
        'CSS_CLASS' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Дополнительный CSS-класс контейнера',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
