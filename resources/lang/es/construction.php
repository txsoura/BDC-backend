<?php

return [
    'pause_failed' => 'Falló la pausa de construcción',
    'paused' => 'Construcción en pausa',
    'pause' => [
        'message' => 'No se puede pausar la construcción',
        'status' => [
            'error' => 'Solo se puede pausar la construcción iniciada'
        ],
    ],
    'start_failed' => 'El inicio de la construcción falló',
    'started' => 'Comenzó la construcción',
    'start' => [
        'message' => 'No se puede iniciar la construcción',
        'status' => [
            'error' => 'Solo se puede iniciar la construcción pendiente o en pausa'
        ],
    ],
    'finalize_failed' => 'La finalización de la construcción falló',
    'finalized' => 'Construcción finalizada',
    'finalize' => [
        'message' => 'No se puede finalizar la construcción',
        'status' => [
            'error' => 'Solo se puede finalizar la construcción iniciada'
        ],
    ],
    'abandon_failed' => 'Falló el abandono de la construcción',
    'abandoned' => 'Construcción abandonada',
    'abandon' => [
        'message' => 'No se puede abandonar la construcción',
        'status' => [
            'error' => 'Solo se puede abandonar la construcción iniciada o en pausa'
        ],
    ],
    'cancel_failed' => 'La cancelación de la construcción falló',
    'canceled' => 'Construcción cancelada',
    'cancel' => [
        'message' => 'No se puede cancelar la construcción',
        'status' => [
            'error' => 'Solo se puede cancelar la construcción colgante'
        ],
    ],
];
