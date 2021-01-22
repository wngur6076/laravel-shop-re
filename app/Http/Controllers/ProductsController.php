<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Tag;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $query = $slug
        ? Tag::whereSlug($slug)->firstOrFail()->products()
        : new Product;

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
            'data.tagsSelect' => 'required|array',
        ]);
        $filename = 'apple.jpg';
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = \Str::random() . filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
            $file->move(public_path('files'), $filename);
        }

        $data = array_merge($request->only('title', 'body', 'video'), [
            'image' => $filename,
            'price' => 6000
        ]);
        $product = $request->user()->products()->create($data);
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
