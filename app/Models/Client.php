<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'email',
        'telephone',
        'cep',
        'address',
        'city',
        'neighborhood',
        'state',
        'address_number',
        'avatar'
    ];
}
