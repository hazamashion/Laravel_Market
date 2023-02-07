<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class ItemEditRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = DB::table('categories')->latest('id')->first();
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'category_id' => 'required|integer|min:1|max:{$max}',
            'price' => ['required', 'regex:/[1-9]{1}[0-9]{0,5}|1000000/'],//入力必須で1以上1000000以下の整数のみ受け付ける
        ];
    }
}
