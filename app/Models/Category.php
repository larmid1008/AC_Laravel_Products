<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
