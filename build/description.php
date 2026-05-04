<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('.description.php');

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
    'NAME'        => 'Форма обратной связи',
    'DESCRIPTION' => 'Контактная форма «Связаться»',
    'ICON'        => '',
    'SORT'        => 100,
    'CACHE_PATH'  => 'Y',
    'PATH'        => [
        'ID'   => 'multiline',
        'NAME' => 'Multiline компоненты',
    ],
];

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';