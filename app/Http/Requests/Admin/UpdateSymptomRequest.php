<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Symptom;

class UpdateSymptomRequest extends FormRequest
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
                $symptom = Symptom::find($this->route('symptom')->id);
                if ($value != $symptom->code) {
                    $symptom2 = Symptom::where('code', $value)->get();
                    if (!empty($symptom2[0])) {
                        $fail('Kode harus unik.');
                    }
                }
            }],
            'name' => ['required', 'string'],
        ];
    }
}
