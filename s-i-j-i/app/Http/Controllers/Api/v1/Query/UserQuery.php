<?php

namespace App\Http\Controllers\Api\v1\Query;

//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserQuery extends Query
{
    //
    
    protected $attributes = [
        'name' => 'Users Query',
        'description' => 'A query of users'
    ];
    public function type()
    {
        // result of query with pagination laravel
        return GraphQL::paginate('users');
    }
    
    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ]
        ];
    }
    
    
    public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
            if (isset($args['email'])) {
                $query->where('email',$args['email']);
            }
        };
        
        $user = User::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $user;
    }


    
    
}
