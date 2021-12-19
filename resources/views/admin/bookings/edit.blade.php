@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.update", [$booking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nomor_order">{{ trans('cruds.booking.fields.nomor_order') }}</label>
                <input class="form-control {{ $errors->has('nomor_order') ? 'is-invalid' : '' }}" type="text" name="nomor_order" id="nomor_order" value="{{ old('nomor_order', $booking->nomor_order) }}" required>
                @if($errors->has('nomor_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nomor_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.nomor_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_permintaan">{{ trans('cruds.booking.fields.tanggal_permintaan') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_permintaan') ? 'is-invalid' : '' }}" type="text" name="tanggal_permintaan" id="tanggal_permintaan" value="{{ old('tanggal_permintaan', $booking->tanggal_permintaan) }}" required>
                @if($errors->has('tanggal_permintaan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggal_permintaan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.tanggal_permintaan_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.booking.fields.status_booking') }}</label>
                @foreach(App\Models\Booking::STATUS_BOOKING_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status_booking') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_booking_{{ $key }}" name="status_booking" value="{{ $key }}" {{ old('status_booking', $booking->status_booking) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_booking_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status_booking'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_booking') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.status_booking_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_names">{{ trans('cruds.booking.fields.user_name') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('user_names') ? 'is-invalid' : '' }}" name="user_names[]" id="user_names" multiple required>
                    @foreach($user_names as $id => $user_name)
                        <option value="{{ $id }}" {{ (in_array($id, old('user_names', [])) || $booking->user_names->contains($id)) ? 'selected' : '' }}>{{ $user_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_names'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_names') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.user_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.booking.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $booking->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_names">{{ trans('cruds.booking.fields.product_name') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('product_names') ? 'is-invalid' : '' }}" name="product_names[]" id="product_names" multiple required>
                    @foreach($product_names as $id => $product_name)
                        <option value="{{ $id }}" {{ (in_array($id, old('product_names', [])) || $booking->product_names->contains($id)) ? 'selected' : '' }}>{{ $product_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_names'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_names') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.product_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jenis_booking">{{ trans('cruds.booking.fields.jenis_booking') }}</label>
                <input class="form-control {{ $errors->has('jenis_booking') ? 'is-invalid' : '' }}" type="text" name="jenis_booking" id="jenis_booking" value="{{ old('jenis_booking', $booking->jenis_booking) }}" required>
                @if($errors->has('jenis_booking'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_booking') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.jenis_booking_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
