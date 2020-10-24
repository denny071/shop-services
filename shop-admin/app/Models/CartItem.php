<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 购物车
 *
 * Class CartItem
 * @package App\Models
 */
class CartItem extends Model
{
    /**
     * 批量操作
     *
     * @var array
     */
    protected $fillable = ['user_id','product_sku_id','amount','checked'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getCheckedAttribute($value)
    {
        return $value==1?true:false;
    }
}
