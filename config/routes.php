<?php

return [
    [
        'method' => 'GET',
        'rule' => '|\/list$|',
        'route' => [App\Controller\ShoppingListController::class, 'index'],
        'view' => 'index'
    ],
];