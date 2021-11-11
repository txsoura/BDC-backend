<?php

return [
    'receive_failed' => 'Stock receive failed',
    'received' => 'Stock received',
    'receive' => [
        'message' => 'Cannot receive stock',
        'status' => [
            'error' => 'Only pendent stock can be received'
        ],
        'flow' => [
            'error' => 'Only stock inbound can be received'
        ],
    ],
    'cancel_failed' => 'Stock cancel failed',
    'canceled' => 'Stock canceled',
    'cancel' => [
        'message' => 'Cannot cancel stock',
        'status' => [
            'error' => 'Only pendent stock can be canceled'
        ],
    ],
    'withdraw_failed' => 'Stock withdraw failed',
    'withdrawn' => 'Stock withdrawn',
    'withdraw' => [
        'message' => 'Cannot withdraw stock',
        'status' => [
            'error' => 'Only pendent stock can be withdrawn'
        ],
        'flow' => [
            'error' => 'Only outbound stock  can be withdrawn'
        ],
    ],
];
