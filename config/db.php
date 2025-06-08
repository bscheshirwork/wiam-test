<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => sprintf(
        '%s:host=%s;port=%s;dbname=%s',
        env('DB_DRIVER', 'pgsql'),
        env('DB_HOST', 'postgres'),
        env('DB_PORT', 5432),
        env('DB_NAME', 'loans'),
    ),
    'username' => env('DB_USER', 'user'),
    'password' => env('DB_PASSWORD', 'password'),
    'charset' => 'utf8mb4',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];