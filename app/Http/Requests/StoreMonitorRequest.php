<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonitorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'interval' => 'sometimes|integer|min:1',
            'url' => 'sometimes|url|max:255',
            'type' => 'required|string|in:http,push',
            'push_token' => 'sometimes|string|max:32',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
