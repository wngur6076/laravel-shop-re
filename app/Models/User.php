<?php

namespace App\Models;

use App\Http\Resources\TagResource;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Http\Resources\SalesDetailsResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'confirm_code',
        'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'confirm_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'activated' => 'boolean',
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

    public function salesDetails(Product $product)
    {
        $search_query = request()->get('searchTerm');

        $sort = request()->get('sort', 'deleted_at');
        $order = request()->get('order', 'desc');
        $perPage = request()->get('per_page');

        $from = date(request()->get('start')).' 00:00:00';
        $to = date(request()->get('end')).' 23:59:59';
        $period = request()->get('period');

        $query = $product->codeList()->onlyTrashed()->wherePeriod($period)
            ->whereBetween('deleted_at', [$from, $to]);

        if ($sort != 'purchaser') {
            $query = $query->where('code', 'LIKE', '%' . $search_query . '%');
            $query = $query->orderBy($sort, $order);
        } else {
            $query = $query->join('orders_code_list', 'code_list.id', '=', 'orders_code_list.code_id');
            $query = $query->join('orders', 'orders_code_list.order_id', '=', 'orders.id');
            $query = $query->join('users', 'orders.user_id', '=', 'users.id');
            $query = $query->select('name', 'code_list.*');
            $query = $query->orderBy('name', $order);
        }

        $salesCode = $query->paginate($perPage);

        if ($search_query) {
			$searchTerm = $search_query ?: '';
		} else {
			$searchTerm = $search_query ? null : '';
        }

        return SalesDetailsResource::collection($salesCode)->additional([
            'searchTerm' => $searchTerm,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    public function posts()
    {
        $products = $this->products;
        $data = collect();

        foreach ($products as $product) {
            $item = [
                'id' => $product->id,
                'title' => $product->title,
                'tags' => TagResource::collection($product->tags),
                'file_link' => $product->file_link,
                'created_at' => $product->created_at->format('Y-m-d h:i:s')
            ];
            $data->push($item);
        }

        return $data;
    }

    public function postsDetails(Product $product)
    {
        $codeList = $product->codeList;
        $data = collect();

        foreach ($codeList as $code) {
            $item = [
                'period' => $code->period == -1 ? 0xff : $code->period,
                'code' => $code->code,
                'price' => number_format($code->price),
                'created_at' => $code->created_at->format('Y-m-d h:i:s')
            ];
            $data->push($item);
        }

        return $data;
    }

    public function getCreditConvertAttribute()
    {
        $ret = 0;
        if ($this->id == 1)
            $ret = 3;
        else if ($this->role == 2)
            $ret = 2;
        else if ($this->role == 1 && $this->credit == 1)
            $ret = 1;

        return $ret;
    }
}
