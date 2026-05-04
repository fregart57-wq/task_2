## Тестовое задание №2

### Видео 1: (Сдать тесты в кусах)

<video src="https://github.com/user-attachments/assets/99503bcf-ae42-48e1-b8a4-0631fb2e01cb" controls width="100%" style="max-width: 600px;">
  Ваш браузер не поддерживает видео.
</video>

## Описание

Используется компонент `multiline:ml2webforms.form.display` для отображения формы обратной связи.

## Использование компонента

### Вставка формы обратной связи

Чтобы добавить форму с ID `feedback`, вставьте следующий код в нужное место шаблона:

```php
<?$APPLICATION->IncludeComponent(
    "multiline:ml2webforms.form.display",
    ".default",
    Array(
        "ID" => "feedback"
    )
);?>
```

### Видео 2: (Форма)

<video src="https://github.com/user-attachments/assets/ddec4704-14a6-41b1-b13d-5b37625149b1" controls width="100%" style="max-width: 600px;">
  Ваш браузер не поддерживает видео.
</video>
