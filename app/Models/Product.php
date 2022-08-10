<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'enable',
        'deleted',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];
}
