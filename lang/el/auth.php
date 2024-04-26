<?php

return [
    'return_to_login' => 'Return to Login',
    'failed' => 'Δεν βρέθηκε λογαριασμός που να ταιριάζει με αυτά τα στοιχεία.',

    'login' => [
        'title' => 'Login to Continue',
        'button' => 'Log In',
        'required' => [
            'username_or_email' => 'A username or email must be provided.',
            'password' => 'Please enter your account password.',
        ],
    ],

    'forgot_password' => [
        'title' => 'Request Password Reset',
        'label' => 'Ξεχάσατε το κωδικό σας;',
        'label_help' => 'Εισάγετε τη διεύθυνση ηλεκτρονικού ταχυδρομείου σας και θα σας στείλουμε οδηγίες για να επαναφέρετε τον κωδικό πρόσβασης σας.',
        'button' => 'Send Email',
        'required' => [
            'email' => 'A valid email address must be provided to continue.',
        ],
    ],

    'reset_password' => [
        'title' => 'Reset Password',
        'button' => 'Reset Password',
        'new_password' => 'New Password',
        'confirm_new_password' => 'Confirm New Password',
        'requirement' => [
            'password' => 'Passwords must be at least 8 characters in length.',
        ],
        'required' => [
            'password' => 'A new password is required.',
            'password_confirmation' => 'Your new password does not match.',
        ],
        'validation' => [
            'password' => 'Your new password should be at least 8 characters in length.',
            'password_confirmation' => 'Your new password does not match.',
        ],
    ],

    'checkpoint' => [
        'title' => 'Device Checkpoint',
        'recovery_code' => 'Recovery Code',
        'recovery_code_description' => 'Enter one of the recovery codes generated when you setup 2-Factor authentication on this account in order to continue.',
        'authentication_code' => 'Authentication Code',
        'authentication_code_description' => 'Enter the two-factor token generated by your device.',
        'button' => 'Continue',
        'lost_device' => "I've Lost My Device",
        'have_device' => 'I Have My Device',
    ],

    'two_factor' => [
        'label' => 'Διακριτικό 2 Παραγόντων',
        'label_help' => 'Αυτός ο λογαριασμός απαιτεί ένα δεύτερο επίπεδο ελέγχου ταυτότητας για να συνεχίσετε. Παρακαλώ εισάγετε τον κωδικό που δημιουργήθηκε από τη συσκευή σας για να ολοκληρώσετε αυτήν τη σύνδεση.',
        'checkpoint_failed' => 'Το διακριτικό ελέγχου ταυτότητας δύο παραγόντων δεν ήταν έγκυρο.',
    ],

    'throttle' => 'Πάρα πολλές προσπάθειες σύνδεσης. Παρακαλώ δοκιμάστε ξανά σε :seconds δευτερόλεπτα.',
    'password_requirements' => 'Ο κωδικός πρόσβασης πρέπει να είναι τουλάχιστον 8 χαρακτήρες σε μήκος και θα πρέπει να είναι μοναδικός σε αυτό τη σελίδα.',
    '2fa_must_be_enabled' => 'Ο διαχειριστής απαιτεί την ενεργοποίηση του ελέγχου ταυτότητας δύο παραγόντων για τον λογαριασμό σας ώστε να χρησιμοποιήσετε τον πίνακα ελέγχου.',
];
