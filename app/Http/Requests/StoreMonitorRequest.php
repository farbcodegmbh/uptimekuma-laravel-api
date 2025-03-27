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
            'type' => 'required|string|in:http,push,group',
            'push_token' => 'required_if:type,push|string|max:32',
            'parent' => 'sometimes|integer',
        ];
    }
}
