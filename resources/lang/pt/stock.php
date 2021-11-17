<?php

return [
    'receive_failed' => 'Recebimento de estoque falhou',
    'received' => 'Estoque recebido',
    'receive' => [
        'message' => 'Não pode receber estoque',
        'status' => [
            'error' => 'Apenas estoque pendente pode ser recebido'
        ],
        'flow' => [
            'error' => 'Somente entrada de estoque pode ser recebida'
        ],
    ],
    'cancel_failed' => 'O cancelamento do estoque falhou',
    'canceled' => 'Estoque cancelado',
    'cancel' => [
        'message' => 'Não é possível cancelar estoque',
        'status' => [
            'error' => 'Apenas estoque pendente pode ser cancelado'
        ],
    ],
    'withdraw_failed' => 'Retirada de estoque falhou',
    'withdrawn' => 'Estoque retirado',
    'withdraw' => [
        'message' => 'Não é possível retirar estoque',
        'status' => [
            'error' => 'Apenas estoque pendente pode ser retirado'
        ],
        'flow' => [
            'error' => 'Apenas o estoque de saída pode ser retirado'
        ],
    ],
];
