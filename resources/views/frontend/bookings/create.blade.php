@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Booking Baru
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bookings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required"
                                for="tanggal_permintaan">{{ trans('cruds.booking.fields.tanggal_permintaan') }}</label>
                                <input class="form-control" type="hidden" name="nomor_order" value="MDCA-{{date('ymdhisu')}}"/>
                                <input class="form-control" type="hidden" name="user_names[]" value="{{auth()->id()}}"/>
                                <input class="form-control" type="hidden" name="status_booking" value="Belum Terbayar"/>
                            <input class="form-control date" type="text" name="tanggal_permintaan"
                                id="tanggal_permintaan" value="{{ old('tanggal_permintaan') }}" required>
                            @if($errors->has('tanggal_permintaan'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tanggal_permintaan') }}
                            </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.booking.fields.tanggal_permintaan_helper') }}</span>
                        </div>

                        <label for="">Layanan</label>
                        <div class="form-group">
                            @foreach ($categories as $item)
                            <input type="radio" id="{{$item->name}}" data-name_categorie="{{$item->name}}" name="categories[]" value="{{$item->id}}">
                            <label for="{{$item->name}}">{{$item->name}}</label><br>
                            @endforeach
                            {{-- <input type="radio" id="layanan1" name="layanan" value="layanan1" {{ old('layanan1') != "layanan1" ? 'checked' : 'checked' }}>
                            <label for="layanan1"> Perawatan Cegah Dini Covid-19</label><br>
                            <input type="radio" id="layanan2" name="layanan" value="layanan2">
                            <label for="layanan2"> Perawatan Isoman Covid-19</label><br>
                            <input type="radio" id="layanan3" name="layanan" value="layanan3">
                            <label for="layanan3"> Rawat Jalan</label><br><br> --}}
                            @if($errors->has('categories'))
                            <div class="invalid-feedback">
                                {{ $errors->first('categories') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.category_helper') }}</span>
                        </div>

                        {{-- Layanan 3 --}}
                        <div>
                            <div id="judul_layanan" class="judul_layanan">

                            </div>
                            <div class="form-group list_product" id="list_product">

                            </div>
                        </div>



                        <label for="">Jenis Booking</label>
                        <div class="form-group">
                            <input type="radio" id="saya_sendiri" name="jenis_booking" value="Saya Sendiri"
                                {{ old('layanan1') != "layanan1" ? 'checked' : 'checked' }}>
                            <label for="saya_sendiri">Saya Sendiri</label><br>
                            <input type="radio" id="orang_lain" name="jenis_booking" value="Orang Lain">
                            <label for="orang_lain">Orang Lain</label><br>
                            @if($errors->has('categories'))
                            <div class="invalid-feedback">
                                {{ $errors->first('categories') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.category_helper') }}</span>
                        </div>

                        <div class="orang_lain">
                            <div class="form-group">
                                <label
                                    for="email_orang_lain">{{ trans('cruds.booking.fields.email_orang_lain') }}</label>
                                <input class="form-control" type="email" name="email_orang_lain" id="email_orang_lain"
                                    value="{{ old('email_orang_lain') }}">
                                @if($errors->has('email_orang_lain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_orang_lain') }}
                                </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.booking.fields.email_orang_lain_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="nama_orang_lain">{{ trans('cruds.booking.fields.nama_orang_lain') }}</label>
                                <input class="form-control" type="text" name="nama_orang_lain"
                                    id="nama_orang_lain" value="{{ old('nama_orang_lain', '') }}">
                                @if($errors->has('nama_orang_lain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_orang_lain') }}
                                </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.booking.fields.nomor_identitas_orang_lain_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="nomor_identitas_orang_lain">{{ trans('cruds.booking.fields.nomor_identitas_orang_lain') }}</label>
                                <input class="form-control" type="text" name="nomor_identitas_orang_lain"
                                    id="nomor_identitas_orang_lain" value="{{ old('nomor_identitas_orang_lain', '') }}">
                                @if($errors->has('nomor_identitas_orang_lain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nomor_identitas_orang_lain') }}
                                </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.booking.fields.nomor_identitas_orang_lain_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="dob_orang_lain">{{ trans('cruds.booking.fields.dob_orang_lain') }}</label>
                                <input class="form-control date" type="text" name="dob_orang_lain" id="dob_orang_lain"
                                    value="{{ old('dob_orang_lain') }}">
                                @if($errors->has('dob_orang_lain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dob_orang_lain') }}
                                </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.booking.fields.dob_orang_lain_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("div.layanan3").hide();
        $("div.orang_lain").hide();
        $('input[name$="categories[]"]').click(function () {
            var selected_Id = $('input[name="categories[]"]:checked').val();
            var nama_kategori = $('input[name="categories[]"]:checked').data('name_categorie');
            $.ajax({
                url: '/ajax_get_product/' + selected_Id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.hasil_layanan').remove();
                    var res = '<label for="" id="hasil_layanan" class="hasil_layanan">'+nama_kategori+'</label>';
                    $('#judul_layanan').append(res);
                    // $.each(data, function(index, value){
                    //     alert(value.product_id);
                    // });
                    console.log(data);
                    $('.product').remove();
                    $.each(data[1], function (index, value) {
                        var res =
                            '<div class="product"><input type="radio" name="product_names[]" value="'+value[0].id+'" ><label for="tindakan_medis_minor">' +
                            value[0].name + '</label></div>'
                        $('#list_product').append(res);
                    });
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $("#orang_lain").click(function () {
            var test = $(this).val();
            $("div.orang_lain").show();
        });

        $("#saya_sendiri").click(function () {
            var test = $(this).val();
            $("div.orang_lain").hide();
        });
    });

</script>
@endsection
