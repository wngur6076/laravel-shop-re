<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        if ($slug == 'favorites') {
            // $user = User::where('id', auth()->user()->id)->first();
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
    public function store(request $request)
    {
        $request['data'] = json_decode($request['data'], true);
        // Validate
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'file_link' => 'required',
            'data.tagsSelect' => 'required|array',
            'data.priceList' => 'required|array',
            'data.priceList.*.period' => 'required|int',
            'data.priceList.*.code' => 'required',
            'data.priceList.*.price' => 'required|int',
        ]);

        $filename = 'apple.jpg';
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = \Str::random() . filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
            $file->move(public_path('files'), $filename);
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
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}