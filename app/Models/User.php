<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function salesHistory()
    {
        $from = date(request()->get('start')).' 00:00:00';
        $to = date(request()->get('end')).' 23:59:59';
        
        $products = $this->products;
        $data = collect();

        foreach ($products as $product) {
            if ($product->codeList()->onlyTrashed()->whereBetween('deleted_at', [$from, $to])->count() <= 0)
                continue;

            $priceSum = 0;
            $QuantitySum = 0;
            $item = [
                'id' => $product->id,
                'title' => $product->title
            ];

            foreach ([1, 7, 15, 30, -1] as $period) {
                $salesCode = $product->codeList()->onlyTrashed()->wherePeriod($period)->whereBetween('deleted_at', [$from, $to]);
                if ($salesCode->count() <= 0)
                    continue;
                    
                $price = $salesCode->sum('price');
                $quantity = $salesCode->count();
                $item['children'][] = [
                    'title' => $period == -1 ? 0xff : $period,
                    'quantity' => $quantity,
                    'sales' => number_format($price)
                ];
                $priceSum += $price;
                $QuantitySum += $quantity;
            }
            $item['sales'] = number_format($priceSum);
            $item['quantity'] = $QuantitySum;
            $data->push($item);
        }
        return $data;
    }
}