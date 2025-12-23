<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class Step1Request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,13}$/'],
            'email' => ['required', 'email', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama lengkap wajib diisi',
            'customer_name.max' => 'Nama lengkap maksimal 255 karakter',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.regex' => 'Format nomor telepon tidak valid (10-13 digit)',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'province.required' => 'Provinsi wajib diisi',
            'city.required' => 'Kabupaten wajib diisi',
            'district.required' => 'Kecamatan wajib diisi',
            'street_address.required' => 'Alamat lengkap wajib diisi',
            'street_address.max' => 'Alamat lengkap maksimal 1000 karakter',
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array<string, mixed>
     */
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        // Format phone number untuk konsistensi
        if (isset($data['phone'])) {
            $data['phone'] = $this->formatPhoneNumber($data['phone']);
        }

        return $data;
    }

    /**
     * Format phone number untuk konsistensi.
     *
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Hapus spasi dan karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Tambahkan +62 jika belum ada
        if (!str_starts_with($phone, '62')) {
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            } else {
                $phone = '62' . $phone;
            }
        }

        return $phone;
    }
}
