<?php

return [
    [
        'method' => 'GET',
        'rule' => '|\/list$|',
        'route' => [App\Controller\ShoppingListController::class, 'index'],
        'view' => 'index'
    ],
    [
        'method' => 'POST',
        'rule' => '|\/add$|',
        'route' => [App\Controller\ShoppingListController::class, 'add'],
        'view' => 'index'
    ],
    [
        'method' => 'POST',
        'rule' => '|\/remove$|',
        'route' => [App\Controller\ShoppingListController::class, 'delete'],
        'view' => 'index'
    ],
];