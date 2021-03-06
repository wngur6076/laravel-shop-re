<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    public $table = "code_list";

    protected $fillable = ['period', 'code', 'price', 'disabled', 'product_id'];

    protected $casts = ['disabled' => 'boolean',];

    protected $dates = ['deleted_at'];

    public $quantity = null;

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_code_list');
    }

    public function getPeriodConvertAttribute()
    {
        return $this->period == -1 ? 0xff : $this->period;
    }

    public function getPriceConvertAttribute()
    {
        return number_format($this->price);
    }

    public function getDeletedDateAttribute()
    {
        return  $this->deleted_at->format('Y-m-d h:i:s');
    }
}