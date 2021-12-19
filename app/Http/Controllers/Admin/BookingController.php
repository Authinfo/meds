<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookingRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Income;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookings = Booking::with(['user_names', 'categories', 'product_names'])->get();

        $users = User::get();

        $product_categories = ProductCategory::get();

        $products = Product::get();

        return view('admin.bookings.index', compact('bookings', 'users', 'product_categories', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id');

        $categories = ProductCategory::pluck('name', 'id');

        $product_names = Product::pluck('name', 'id');

        return view('admin.bookings.create', compact('user_names', 'categories', 'product_names'));
    }

    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->all());
        $booking->user_names()->sync($request->input('user_names', []));
        $booking->categories()->sync($request->input('categories', []));
        $booking->product_names()->sync($request->input('product_names', []));

        return redirect()->route('admin.bookings.index');
    }

    public function edit(Booking $booking)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id');

        $categories = ProductCategory::pluck('name', 'id');

        $product_names = Product::pluck('name', 'id');

        $booking->load('user_names', 'categories', 'product_names');

        return view('admin.bookings.edit', compact('user_names', 'categories', 'product_names', 'booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());
        $booking->user_names()->sync($request->input('user_names', []));
        $booking->categories()->sync($request->input('categories', []));
        $booking->product_names()->sync($request->input('product_names', []));

        return redirect()->route('admin.bookings.index');
    }

    public function show(Booking $booking)
    {
        abort_if(Gate::denies('booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->load('user_names', 'categories', 'product_names');

        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingRequest $request)
    {
        Booking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function post_admin_payment(Request $request, $nomor_order)
    {
        $nomor_order = DB::table('bookings')->where('nomor_order', $nomor_order)->first();
        $categories = ProductCategory::pluck('name', 'id');
        $product_names = Product::pluck('name', 'id');
        $harga = Product::pluck('name', 'price');


        //   dd($nomor_order);
        if($nomor_order->status_booking == "0"){
            //User belum bayar
            DB::table('bookings')->where('nomor_order', $nomor_order->nomor_order)->update([
                'status_booking' => '1',
            ]);


            // dd($categories, $product_names, $harga);
            $income = Income::create($request->all());
            //$income->amount()->sync($request->get('amount'));
            $categories->description()->sync($request->get('products', 'nanme'));
            dd($income);
            // Income::create($request->all());



        }else{
            //User sudah bayar
            DB::table('bookings')->where('nomor_order', $nomor_order->nomor_order)->update([
                "status_booking" => "0"
            ]);
        }
        return redirect()->back();
    }

}
