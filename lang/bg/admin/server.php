<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => 'Опитваш се да изтриеш алокацията по подразбиране за този сървър но няма резервна алокация да се използва.',
        'marked_as_failed' => 'This server was marked as having failed a previous installation. Current status cannot be toggled in this state.',
        'bad_variable' => 'There was a validation error with the :name variable.',
        'daemon_exception' => 'Имаше изключение при опит на комуникация с daemon-a, което доведе до код HTTP/:code. Това изключение бе записано. (request id: :request_id)',
        'default_allocation_not_found' => 'Поисканата алокация по подразбиране не бе намерена в алокациите на този сървър.',
    ],
    'alerts' => [
        'startup_changed' => 'Стартиращата конфигурация за този сървър бе актуализирана. Ако egg-а на този сървър бе променен, сега ще се прави реинсталация.',
        'server_deleted' => 'Този сървър успешно бе изтрит от системата.',
        'server_created' => 'Този съръв успешно бе направен на панела. Моля дайте няколко минути на daemon-a да инсталира сървъра напълно',
        'build_updated' => 'The build details for this server have been updated. Some changes may require a restart to take effect.',
        'suspension_toggled' => 'Статуса на прекъсване на този сървър бе променен на :status.',
        'rebuild_on_boot' => 'Този сървър бе маркиран като нуждаещ се от Docker контейнер преправка. Това ще се случи следващият път когато се стартира сървъра.',
        'install_toggled' => 'Статуса за инсталация на този сървър бе променен.',
        'server_reinstalled' => 'Този сървър бе поставен за реинсталация.',
        'details_updated' => 'Детайлите на сървъра бяха успешно актуализирани.',
        'docker_image_updated' => 'Успешно промени Docker image-а по подразбиране за този сървър. Нужен е рестарт за да се приложат промените.',
        'node_required' => 'Трябва да имаш поне един node конфигуриран преди да добавиш сървър на този панел.',
        'transfer_nodes_required' => 'Трябва да имаш поне два node-а конфигурирани преди да прехвърляш сървъри',
        'transfer_started' => 'Прехвърлянето на сървъра бе стартирано.',
        'transfer_not_viable' => 'Node-а който избра няма достатъчно пространство или памет, за да поеме този сървър.',
    ],
];
