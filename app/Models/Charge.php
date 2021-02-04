<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charge extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = ['pin_number', 'amount', 'type'];

    protected $casts = ['type' => 'boolean'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPinAttribute()
    {
        return $this->type ? $this->pinConvert() : $this->pin_number;
    }

    public function pinConvert()
    {
        $pin = wordwrap($this->pin_number, 4, '-', true);
        if (strlen($this->pin_number) == 18) {
            $pin = substr_replace($pin, \Str::substr($pin, 20, 21), 19);
        }

        return $pin;
    }

    public function getCreatedDateAttribute()
    {
        return  $this->created_at->format('Y-m-d H:i:s');
    }

    public function getTypeNameAttribute()
    {
        return $this->type ? '상품권' : '입금';
    }

    public function getAmountConvertAttribute()
    {
        return number_format($this->amount);
    }
}