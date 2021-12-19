@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.booking.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bookings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $booking->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.nomor_order') }}
                                    </th>
                                    <td>
                                        {{ $booking->nomor_order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.tanggal_permintaan') }}
                                    </th>
                                    <td>
                                        {{ $booking->tanggal_permintaan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.status_booking') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Booking::STATUS_BOOKING_RADIO[$booking->status_booking] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.user_name') }}
                                    </th>
                                    <td>
                                        @foreach($booking->user_names as $key => $user_name)
                                            <span class="label label-info">{{ $user_name->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.category') }}
                                    </th>
                                    <td>
                                        @foreach($booking->categories as $key => $category)
                                            <span class="label label-info">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.product_name') }}
                                    </th>
                                    <td>
                                        @foreach($booking->product_names as $key => $product_name)
                                            <span class="label label-info">{{ $product_name->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.jenis_booking') }}
                                    </th>
                                    <td>
                                        {{ $booking->jenis_booking }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.nama_orang_lain') }}
                                    </th>
                                    <td>
                                        {{ $booking->nama_orang_lain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.email_orang_lain') }}
                                    </th>
                                    <td>
                                        {{ $booking->email_orang_lain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.nomor_identitas_orang_lain') }}
                                    </th>
                                    <td>
                                        {{ $booking->nomor_identitas_orang_lain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.booking.fields.dob_orang_lain') }}
                                    </th>
                                    <td>
                                        {{ $booking->dob_orang_lain }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bookings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection