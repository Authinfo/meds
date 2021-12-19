<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_edit');
    }

    public function rules()
    {
        return [
            'nomor_order' => [
                'string',
                'required',
            ],
            'tanggal_permintaan' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_names.*' => [
                'integer',
            ],
            'user_names' => [
                'required',
                'array',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'product_names.*' => [
                'integer',
            ],
            'product_names' => [
                'required',
                'array',
            ],
            'jenis_booking' => [
                'string',
                'required',
            ],
            'nama_orang_lain' => [
                'string',
                'nullable',
            ],
            'nomor_identitas_orang_lain' => [
                'string',
                'min:15',
                'max:15',
                'nullable',
            ],
            'dob_orang_lain' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
