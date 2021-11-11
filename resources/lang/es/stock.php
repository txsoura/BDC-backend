<?php

return [
    'receive_failed' => 'La recepción de stock falló',
    'received' => 'Stock recibido',
    'receive' => [
        'message' => 'No se puede recibir stock',
        'status' => [
            'error' => 'Solo se pueden recibir acciones pendientes'
        ],
        'flow' => [
            'error' => 'Solo se pueden recibir stock entrantes'
        ],
    ],
    'cancel_failed' => 'Cancelación de stock fallida',
    'canceled' => 'Stock cancelado',
    'cancel' => [
        'message' => 'No se puede cancelar el stock',
        'status' => [
            'error' => 'Solo se pueden cancelar acciones pendientes'
        ],
    ],
    'withdraw_failed' => 'La retirada de existencias falló',
    'withdrawn' => 'Stock retirado',
    'withdraw' => [
        'message' => 'No se puede retirar stock',
        'status' => [
            'error' => 'Solo se pueden retirar acciones pendientes'
        ],
        'flow' => [
            'error' => 'Solo se puede retirar el stock saliente'
        ],
    ],
];
