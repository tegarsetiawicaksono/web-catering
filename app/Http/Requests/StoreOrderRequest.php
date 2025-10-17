<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can place an order
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $today = now();
        $minDate = $today->addDays(7)->format('Y-m-d');

        return [
            'menu_id' => ['required', 'exists:menus,id'],
            'menu_name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'event_date' => ['required', 'date', 'after_or_equal:' . $minDate],
            'event_time' => ['required'],
            'venue' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:' . request('min_order', 100)],
            'payment_method' => ['required', 'in:transfer,cash'],
            'notes' => ['nullable', 'string'],
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
            'event_date.after_or_equal' => 'Tanggal acara harus minimal :min hari dari sekarang.',
            'quantity.min' => 'Minimal pemesanan adalah :min porsi.',
            'payment_method.in' => 'Metode pembayaran harus transfer bank atau tunai.',
        ];
    }
}