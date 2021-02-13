<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Code;
use App\Models\Product;
use App\Http\Utility\File;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;
use Illuminate\Http\Request;

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
    public function index(Request $request, $slug = null)
    {
        if ($slug == 'favorites') {
            $user = User::find(auth()->id());
            $query = $user->favorites();
        } else {
            $query = $slug
            ? Tag::whereSlug($slug)->firstOrFail()->products()
            : new Product;
        }

        if ($keyword = $request->input('q')) {
            $raw = 'MATCH(title,body) AGAINST(? IN BOOLEAN MODE)';
            $query = $query->whereRaw($raw, [$keyword.'*']);
        }
        // 코드가 매진대면 보여주지 않기위해서
        $query = $query->has('codeList');

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
        $product->codeList()->createMany($request->input('data.codeList'));
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

        $codeList = [];
        $codeIds = [];
        foreach ($request->input('data.codeList') as $code) {
            if (isset($code['id'])) {
                Code::whereId($code['id'])
                    ->whereProductId($product->id)
                    ->update($code);
                $codeIds[] = $code['id'];
            } else {
                $codeList[] = new Code($code);
            }
        }

        $product->update($data);
        $product->tags()->sync($request->input('data.tagsSelect'));

        if (count($codeIds)) {
            Code::whereProductId($product->id)
                ->whereNotIn('id', $codeIds)
                ->delete();
        }

        if (count($codeList)) {
            $product->codeList()
                ->saveMany($codeList);
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

        foreach ($product->codeList as $code) {
            $code->forceDelete();
        }

        $product->delete();

        return response()->json([
            'message' => "게시글이 삭제되었습니다."
        ]);
    }
}
