<?php

return [
    'title' => 'Aperçu du compte',
    'email' => [
        'title' => "Mettre à jour l'adresse email",
        'button' => "Mettre à jour l'e-mail",
        'updated' => 'Votre email principal a été mis à jour.',
    ],
    'password' => [
        'title' => 'Mettre à jour le mot de passe',
        'bouton' => 'Mettre à jour le mot de passe',
        'requirements' => 'Votre nouveau mot de passe doit comporter au moins 8 caractères et être unique à ce site Web.',
        'validation' => [
            'account_password' => 'Vous devez fournir le mot de passe de votre compte.',
            'current_password' => 'Vous devez fournir votre mot de passe actuel.',
            'password_confirmation' => 'La confirmation du mot de passe ne correspond pas au mot de passe que vous avez saisi.',
         ],
        'updated' => 'Votre mot de passe a été mis à jour.',
    ],
    'two_factor' => [
        'title' => 'Vérification en deux étapes',
        'button' => "Configurer l'authentification à 2 facteurs",
        'disabled' => "L'authentification à deux facteurs a été désactivée sur votre compte. Vous ne serez plus invité à fournir un token lors de votre connexion.",
        'enabled' => "L'authentification à deux facteurs a été activée sur votre compte ! Désormais, lors de votre connexion, il vous sera demandé de fournir le code généré par votre appareil.",
        'invalid' => "Le jeton fourni n'était pas valide.",
        'activer' => [
            'help' => "La vérification en deux étapes n'est actuellement pas activée sur votre compte. Cliquez sur le bouton ci-dessous pour commencer à le configurer.",
            'button' => 'Activer deux étapes',
        ],
        'disable' => [
            'help' => 'La vérification en deux étapes est actuellement activée sur votre compte.',
            'title' => "Désactiver l'authentification à deux facteurs",
            'field' => 'Entrer le jeton',
            'button' => 'Désactiver deux étapes',
        ],
        'setup' => [
            'title' => 'Activer la vérification en deux étapes',
            'subtitle' => "Aidez à protéger votre compte contre tout accès non autorisé. Un code de vérification vous sera demandé à chaque fois que vous vous connectez.",
            'help' => "Scannez le code QR ci-dessus à l'aide de l'application d'authentification en deux étapes de votre choix. Ensuite, saisissez le code à 6 chiffres généré dans le champ ci-dessous.",
        ],

        'required' => [
            'title' => '2 facteurs requis',
            'description' => "Votre compte doit avoir l'authentification à deux facteurs activée pour pouvoir continuer.",
        ],
    ],
];
