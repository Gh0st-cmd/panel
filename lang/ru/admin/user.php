<?php

return [
    'exceptions' => [
        'user_has_servers' => 'Невозможно удалить пользователя с активными серверами, привязанными к его учетной записи. Пожалуйста, удалите его серверы, прежде чем продолжить.',
        'user_is_self' => 'Невозможно удалить свою учетную запись.',
    ],
    'notices' => [
        'account_created' => 'Учетная запись успешно создана!',
        'account_updated' => 'Аккаунт был успешно изменен.',
    ],
    'last_admin' => [
        'hint' => 'This is the last root administrator!',
        'helper_text' => 'You must have at least one root administrator in your system.',
    ],
    'root_admin' => 'Administrator (Root)',
    'language' => [
        'helper_text1' => 'Your language (:state) has not been translated yet!\nBut never fear, you can help fix that by',
        'helper_text2' => 'contributing directly here',
    ],
];
