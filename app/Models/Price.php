<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public $table = "price_list";

    protected $fillable = ['period', 'code', 'price', 'disabled'];

    protected $casts = ['disabled' => 'boolean',];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}