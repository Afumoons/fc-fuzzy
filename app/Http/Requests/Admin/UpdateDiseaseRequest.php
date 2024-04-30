<?php

namespace App\Http\Requests\Admin;

use App\Models\Disease;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiseaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', function ($attribute, $value, $fail) {
                $disease = Disease::find($this->route('disease')->id);
                if ($value != $disease->code) {
                    $disease2 = Disease::where('code', $value)->get();
                    if (!empty($disease2[0])) {
                        $fail('Kode harus unik.');
                    }
                }
            }],
            'name' => ['required', 'string'],
            'cause' => ['sometimes', 'string'],
            'solution' => ['sometimes', 'string'],
        ];
    }
}
