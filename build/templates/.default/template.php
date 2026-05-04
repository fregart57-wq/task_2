<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @global CMain $APPLICATION */

$APPLICATION->SetAdditionalCSS('/style.css');

?>

<div class="contact-form">

    <?php if ($arResult['SUCCESS']): ?>
        <div class="success-message">
            Спасибо! Ваша заявка успешно отправлена.<br>
            Мы свяжемся с вами в ближайшее время.
        </div>

    <?php else: ?>

        <?php if ($arResult['ERROR']): ?>
            <div class="error-message">
                <?= htmlspecialcharsbx($arResult['ERROR']) ?>
            </div>
        <?php endif; ?>

        <div class="contact-form__head">
            <div class="contact-form__head-title">Напишите нам</div>
            <div class="contact-form__head-text">
                Наши специалисты ответят на все ваши вопросы в&nbsp;течение 1–2 дней
            </div>
        </div>

        <form class="contact-form__form" action="<?= POST_FORM_ACTION_URI ?>" method="POST">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="FORM_ID" value="<?= htmlspecialcharsbx($arResult['ID']) ?>">

            <!-- Поля формы -->
            <div class="contact-form__form-inputs">
                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text">Ваше имя*</div>
                        <input
                                class="input__input"
                                type="text"
                                name="NAME"
                                value="<?= htmlspecialcharsbx($_POST['NAME'] ?? '') ?>"
                                required
                        >
                    </label>
                </div>

                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text">Компания/организация*</div>
                        <input
                                class="input__input"
                                type="text"
                                name="COMPANY"
                                value="<?= htmlspecialcharsbx($_POST['COMPANY'] ?? '') ?>"
                                required
                        >
                    </label>
                </div>

                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text">Email*</div>
                        <input
                                class="input__input"
                                type="email"
                                name="EMAIL"
                                value="<?= htmlspecialcharsbx($_POST['EMAIL'] ?? '') ?>"
                                required
                        >
                    </label>
                </div>

                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text">Номер телефона*</div>
                        <input
                                class="input__input"
                                type="tel"
                                name="PHONE"
                                value="<?= htmlspecialcharsbx($_POST['PHONE'] ?? '') ?>"
                                required
                        >
                    </label>
                </div>
            </div>

            <div class="contact-form__form-message">
                <label class="input__label">
                    <div class="input__label-text">Сообщение</div>
                    <textarea
                            class="input__input"
                            name="MESSAGE"
                            rows="5"
                    ><?= htmlspecialcharsbx($_POST['MESSAGE'] ?? '') ?></textarea>
                </label>
            </div>

            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">
                    Нажимая кнопку «Отправить заявку», вы соглашаетесь с&nbsp;политикой
                    конфиденциальности и&nbsp;условиями обработки персональных данных.
                </div>

                <button type="submit" class="form-button contact-form__bottom-button">
                    Отправить заявку
                </button>
            </div>
        </form>

    <?php endif; ?>

</div>