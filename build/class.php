<?php

declare(strict_types=1);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

class ml2webformsFormDisplay extends CBitrixComponent
{
    public function executeComponent(): void
    {
        $this->arResult['ID']      = $this->arParams['ID'] ?? 'feedback';
        $this->arResult['SUCCESS'] = false;
        $this->arResult['ERROR']   = '';
        $this->arResult['ERRORS']  = [];

        // Обработка формы
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_bitrix_sessid()) {
            $this->processForm();
        }

        $this->includeComponentTemplate();
    }

    private function processForm(): void
    {
        try {
            if (!Loader::includeModule('multiline.ml2webforms')) {
                throw new \Exception('Модуль multiline.ml2webforms не подключен');
            }

            $formFile = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/multiline.ml2webforms/lib/forms/feedback/class.php';

            if (!file_exists($formFile)) {
                throw new \Exception('Файл формы не найден: ' . $formFile);
            }

            require_once $formFile;

            $formClass = 'Ml2WebForms\\FeedbackWebForm';

            if (!class_exists($formClass)) {
                throw new \Exception('Класс ' . $formClass . ' не найден');
            }

            /** @var \Ml2WebForms\WebForm $form */
            $form = new $formClass();

            $fields = [
                'NAME'    => trim($_POST['NAME']    ?? ''),
                'COMPANY' => trim($_POST['COMPANY'] ?? ''),
                'EMAIL'   => trim($_POST['EMAIL']   ?? ''),
                'PHONE'   => trim($_POST['PHONE']   ?? ''),
                'MESSAGE' => trim($_POST['MESSAGE'] ?? ''),
            ];

            if (method_exists($form, 'setFields')) {
                $form->setFields($fields);
            } elseif (method_exists($form, 'setField')) {
                foreach ($fields as $code => $value) {
                    $form->setField($code, $value);
                }
            } else {
                $form->arFields = $fields; // fallback
            }

            $form->validateRequest();

            if (mb_strlen($fields['NAME']) < 2) {
                $form->arResult['ERROR'] = 'Укажите ваше имя';
            } elseif (mb_strlen($fields['EMAIL']) < 5 || !filter_var($fields['EMAIL'], FILTER_VALIDATE_EMAIL)) {
                $form->arResult['ERROR'] = 'Укажите корректный Email';
            } elseif (mb_strlen($fields['PHONE']) < 10) {
                $form->arResult['ERROR'] = 'Укажите корректный телефон';
            }

            if (empty($form->arResult['ERROR'])) {
                $success = $form->addResult();
                $result  = $form->getProcessResult();

                if ($success || ($result['status'] ?? '') === 'success') {
                    $this->arResult['SUCCESS'] = true;
                } else {
                    $this->arResult['ERROR']  = $result['message'] ?? 'Ошибка при отправке формы';
                    $this->arResult['ERRORS'] = $result['errors'] ?? [];
                }
            } else {
                $this->arResult['ERROR'] = $form->arResult['ERROR'];
            }
        } catch (\Exception $e) {
            $this->arResult['ERROR'] = $e->getMessage();
        }
    }
}