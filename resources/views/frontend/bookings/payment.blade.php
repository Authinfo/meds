@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Pembayaran
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url("frontend/post_payment") }}">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                                <div style="text-align: center">Anda telah melakukan booking hari ini <br> silahkan tentukan pilihan pembayaran dibawah ini :</div>                            
                                <input class="form-control" type="hidden" name="nomor_order" value="{{$data->nomor_order}}"/>                                                                                                                    
                            </div>
                        
                        <div class="form-group" style="text-align: center">
                            <button class="btn btn-primary" type="submit">
                                Bayar Di Tempat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
