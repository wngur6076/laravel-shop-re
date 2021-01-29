<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Price;
use App\Models\Product;
use App\Http\Utility\File;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isSelf')->only(['update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        if ($slug == 'favorites') {
            $user = User::find(auth()->id());
            $query = $user->favorites();
        } else {
            $query = $slug
            ? Tag::whereSlug($slug)->firstOrFail()->products()
            : new Product;
        }

        $products = $query->latest()->Paginate(4);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        // 파일객체가 존재하면 public/files/ 파일 생성
        $filename = File::BASENAME;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = File::upload($file);
        }

        $data = array_merge($request->only('title', 'body', 'video', 'file_link'), [
            'image' => $filename,
        ]);
        $product = $request->user()->products()->create($data);
        // 상품에 가격리스트 추가
        $product->priceList()->createMany($request->input('data.priceList'));
        // 상품에 태그추가
        $product->tags()->sync($request->input('data.tagsSelect'));

        return response()->json([
            'message' => '게시글이 등록되었습니다.',
            'product' => new ProductResource($product)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => new ProductDetailsResource($product)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, Product $product)
    {
        $filename = $product->image;
        if ($request->hasFile('photo')) {
            $filename == File::BASENAME ?: File::delete($filename);

            $file = $request->file('photo');
            $filename = File::upload($file);
        }
        $data = array_merge($request->only('title', 'body', 'video', 'file_link'), [
            'image' => $filename,
        ]);

        $priceList = [];
        $priceIds = [];
        foreach ($request->input('data.priceList') as $price) {
            if (isset($price['id'])) {
                Price::whereId($price['id'])
                    ->whereProductId($product->id)
                    ->update($price);
                $priceIds[] = $price['id'];
            } else {
                $priceList[] = new Price($price);
            }
        }

        $product->update($data);
        $product->tags()->sync($request->input('data.tagsSelect'));

        if (count($priceIds)) {
            Price::whereProductId($product->id)
                ->whereNotIn('id', $priceIds)
                ->delete();
        }

        if (count($priceList)) {
            $product->priceList()
                ->saveMany($priceList);
        }

        return response()->json([
            'message' => '게시글이 수정되었습니다.',
            'product' => new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (isset($product->image)) {
            $filename = $product->image;
            $filename == File::BASENAME ?: File::delete($filename);
        }

        $product->delete();

        return response()->json([
            'message' => "게시글이 삭제되었습니다."
        ]);
    }
}
