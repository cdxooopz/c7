<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_name','product_type','price','amount'];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
    public function orderDetail(): HasMany
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function scopeAccessories(Builder $query): void
    {
        $query->where('product_type', 1);
    }

    public function scopeTablet(Builder $query): void
    {
        $query->where('product_type', 2);
    }

    public function scopeComputer(Builder $query): void
    {
        $query->where('product_type', 3);
    }

    public function scopeNetworks(Builder $query): void
    {
        $query->where('product_type', 4);
    }

    public function scopeMobile(Builder $query): void
    {
        $query->where('product_type', 4);
    }
}
