<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['hash', 'total', 'title', 'file_link'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function codeList()
    {
        return $this->belongsToMany(Code::class, 'orders_code_list');
    }

    public function payment()
    {
        $user = User::find(auth()->user()->id);
        $user->money = $user->money - $this->total;
        $user->credit = 1;
        $user->save();
    }

    public function getCreatedDateAttribute()
    {
        return  $this->created_at->format('Y-m-d h:i:s');
    }

    public function getTotalConvertAttribute()
    {
        return number_format($this->total);
    }
}