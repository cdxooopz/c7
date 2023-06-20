<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ProductType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function product(): HasMany
    {
        return $this->hasOne(Product::class);
    }
}