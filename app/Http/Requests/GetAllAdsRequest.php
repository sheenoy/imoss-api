<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Models\Ads;

class GetAllAdsRequest extends FormRequest
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
        $ad_table = new Ads;
        $ad_table_retrieve = $ad_table->getTable();
        $all_valid_column_names = \Schema::getColumnListing($ad_table_retrieve);
        return [
            'page' => 'nullable|numeric',
            'per_page' => 'nullable|numeric',
            'ad_type' => ['required',Rule::in(['sale', 'rent'])],
            'rooms' => 'nullable|numeric',
            'budget_min' => 'nullable|numeric',
            'budget_max' => 'nullable|numeric',
            'sort_by' => ['nullable', Rule::in($all_valid_column_names)],
            'order_by' => ['nullable', Rule::in(['', 'ASC', 'DESC'])],
        ];
    }



    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ad_type.required' => 'Please select Ad type (rent/sale)',
            'ad_type.in' => 'The Ad type is invalid, should be only "sale" or "rent"',
        ];
    }

}
