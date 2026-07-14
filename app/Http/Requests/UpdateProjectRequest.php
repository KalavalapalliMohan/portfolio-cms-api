<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $project = $this->route('project'); // Get the project ID from the route parameter
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id, // Ensure the slug is unique except for the current project
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'image' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ];
    }
}
