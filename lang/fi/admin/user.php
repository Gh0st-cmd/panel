<?php

return [
    'exceptions' => [
        'user_has_servers' => 'Ei voida poistaa käyttäjää, jolla on aktiivisia palvelimia heidän tililleen. Poista heidän palvelimensa ennen jatkamista.',
        'user_is_self' => 'Omaa käyttäjätiliä ei voi poistaa.',
    ],
    'notices' => [
        'account_created' => 'Tili on luotu onnistuneesti.',
        'account_updated' => 'Tili on päivitetty onnistuneesti.',
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
