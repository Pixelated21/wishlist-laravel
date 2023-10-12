<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    const PREFIX = 'products.';
    const ROUTE = [
        'index' => self::PREFIX . 'index', // List
        'show' => self::PREFIX . 'show', // Show
        'store' => self::PREFIX . 'store', // Store
        'destroy' => self::PREFIX . 'destroy', // Destroy
        'edit' => self::PREFIX . 'edit', // Edit
        'update' => self::PREFIX . 'update', // Update
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Stores the current request route
        $currentRouteName = $this->route()->getName();

        if ($currentRouteName === self::ROUTE['store']) {
            return [
                'name' => ['bail', 'required', 'string', 'max:150'],
                'price' => ['bail', 'required', 'numeric', 'min:0'],
                'description' => ['bail', 'required', 'string', 'max:150'],
                'wishlist_code' => ['bail', 'required', 'string', 'max:150', Rule::exists('wishlists', 'wishlist_code')],
                'image_url' => ['bail', 'required', 'string', 'max:265'],
            ];
        }

        if ($currentRouteName === self::ROUTE['update']) {
            return [
                'name' => ['bail', 'required', 'string', 'max:150'],
                'price' => ['bail', 'required', 'numeric', 'min:0'],
                'description' => ['bail', 'required', 'string', 'max:150'],
                'wishlist_code' => ['bail', 'required', 'string', 'max:150', Rule::exists('wishlists', 'wishlist_code')],
                'image_url' => ['bail', 'nullable', 'string', 'max:265'],
            ];
        }

        return [];
    }
}
