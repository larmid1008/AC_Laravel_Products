<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'published',
        'deleted',
        'description',
        'price',
        'published',
        'created_at',
        'updated_at',
    ];
}
