<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validator($factory)
    {
        return $factory->make(
            $this->sanitize(), $this->container->call([$this, 'rules']), $this->messages()
        );
    }

    public function sanitize()
    {
        $this->merge([
            'data' => json_decode($this->input('data'), true)
        ]);
        return $this->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'file_link' => 'required',
            'data.tagsSelect' => 'required|array',
            'data.priceList' => 'required|array',
            'data.priceList.*.period' => 'required|int',
            'data.priceList.*.code' => 'required',
            'data.priceList.*.price' => 'required|int',
        ];
    }
}