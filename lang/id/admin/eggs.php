<?php

return [
    'notices' => [
        'imported' => 'Berhasil mengimport Egg dan variabel terkaitnya.',
        'updated_via_import' => 'Egg ini telah diperbarui menggunakan file yang disediakan.',
        'deleted' => 'Berhasil menghapus Egg dari Panel.',
        'updated' => 'Konfigurasi Egg ini telah berhasil diperbarui.',
        'script_updated' => 'Pemasangan Script Egg telah diperbarui dan akan dijalankan setiap kali server dipasang.',
        'egg_created' => 'A new egg was laid successfully. You will need to restart any running daemons to apply this new egg.',
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => 'The variable ":variable" has been deleted and will no longer be available to servers once rebuilt.',
            'variable_updated' => 'The variable ":variable" has been updated. You will need to rebuild any servers using this variable in order to apply changes.',
            'variable_created' => 'New variable has successfully been created and assigned to this egg.',
        ],
    ],
];
