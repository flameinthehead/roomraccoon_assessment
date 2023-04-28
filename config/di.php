<?php
return [
    App\Validator\ValidatorInterface::class => DI\create(App\Validator\ShopItemValidator::class),
    App\Storage\StorageInterface::class => DI\create(App\Storage\RedisStorage::class),
];