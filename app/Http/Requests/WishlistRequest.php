<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
{

    const PREFIX = 'wishlists.';
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
                'description' => ['bail', 'required', 'string', 'max:150'],
                'user_id' => ['bail', 'required', 'string', 'max:150'],
            ];
        }

        if ($currentRouteName === self::ROUTE['update']) {
            return [
                'name' => ['bail', 'string', 'max:150'],
                'description' => ['bail', 'string', 'max:150'],
            ];
        }
        return [];
    }
}
