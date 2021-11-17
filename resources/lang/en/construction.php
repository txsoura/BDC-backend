<?php

return [
    'pause_failed' => 'Construction pause failed',
    'paused' => 'Construction paused',
    'pause' => [
        'message' => 'Cannot pause construction',
        'status' => [
            'error' => 'Only started construction can be paused'
        ],
    ],
    'start_failed' => 'Construction start failed',
    'started' => 'Construction started',
    'start' => [
        'message' => 'Cannot start construction',
        'status' => [
            'error' => 'Only pendent or paused construction can be started'
        ],
    ],
    'finalize_failed' => 'Construction finalize failed',
    'finalized' => 'Construction finalized',
    'finalize' => [
        'message' => 'Cannot finalize construction',
        'status' => [
            'error' => 'Only started construction can be finalized'
        ],
    ],
    'abandon_failed' => 'Construction abandon failed',
    'abandoned' => 'Construction abandoned',
    'abandon' => [
        'message' => 'Cannot abandon construction',
        'status' => [
            'error' => 'Only started or paused construction can be abandoned'
        ],
    ],
    'cancel_failed' => 'Construction cancel failed',
    'canceled' => 'Construction canceled',
    'cancel' => [
        'message' => 'Cannot cancel construction',
        'status' => [
            'error' => 'Only pendent construction can be canceled'
        ],
    ],
];
