<?php

return [
    [
        'method' => 'GET',
        'rule' => '|\/list$|',
        'route' => [App\Controller\ShoppingListController::class, 'index'],
    ],
    [
        'method' => 'POST',
        'rule' => '|\/add$|',
        'route' => [App\Controller\ShoppingListController::class, 'add'],
    ],
    [
        'method' => 'POST',
        'rule' => '|\/remove$|',
        'route' => [App\Controller\ShoppingListController::class, 'delete'],
    ],
    [
        'method' => 'POST',
        'rule' => '|\/edit$|',
        'route' => [App\Controller\ShoppingListController::class, 'edit'],
    ],
    [
        'method' => 'POST',
        'rule' => '|\/check$|',
        'route' => [App\Controller\ShoppingListController::class, 'check'],
    ],
];