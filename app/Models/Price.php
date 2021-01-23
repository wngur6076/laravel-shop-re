<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public $table = "price_list";

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}