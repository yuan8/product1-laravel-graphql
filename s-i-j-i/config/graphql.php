<?php


use App\Http\Controllers\Api\v1\Query\UserQuery;
use App\Http\Controllers\Api\v1\Type\UserType;


return [
    'prefix' => 'api/v1',
    'routes' => '{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    // register query  
    'schemas' => [
        'default' => [
            'query' => [
                'users' => UserQuery::class,
            ],
            'mutation' => [
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        
        'users'  => UserType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params'
];
