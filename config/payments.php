<?php

return [
    'default' => env('PAYMENT_DEFAULT_GATEWAY', 'fake_gateway'),
    'fake_auto_approve' => env('PAYMENT_FAKE_AUTO_APPROVE', true),
];
