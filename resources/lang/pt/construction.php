<?php

return [
    'pause_failed' => 'A pausa na construção falhou',
    'paused' => 'Construção pausada',
    'pause' => [
        'message' => 'Impossível pausar construção',
        'status' => [
            'error' => 'Apenas a construção iniciada pode ser pausada'
        ],
    ],
    'start_failed' => 'O início da construção falhou',
    'started' => 'Construção iniciada',
    'start' => [
        'message' => 'Impossível iniciar construção',
        'status' => [
            'error' => 'Apenas a construção pendente ou pausada pode ser iniciada'
        ],
    ],
    'finalize_failed' => 'A finalização da construção falhou',
    'finalized' => 'Construção finalizada',
    'finalize' => [
        'message' => 'Não é possível finalizar a construção',
        'status' => [
            'error' => 'Apenas a construção iniciada pode ser finalizada'
        ],
    ],
    'abandon_failed' => 'Falha no abandono da construção',
    'abandoned' => 'Construção abandonada',
    'abandon' => [
        'message' => 'Não pode abandonar a construção',
        'status' => [
            'error' => 'Apenas a construção iniciada ou pausada pode ser abandonada'
        ],
    ],
    'cancel_failed' => 'Falha no cancelamento da construção',
    'canceled' => 'Construção cancelada',
    'cancel' => [
        'message' => 'Não é possível cancelar a construção',
        'status' => [
            'error' => 'Apenas a construção pendente pode ser cancelada'
        ],
    ],
];
