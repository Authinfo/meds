<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookingRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Income;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
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

        return view('frontend.bookings.index', compact('bookings', 'users', 'product_categories', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_names = User::pluck('name', 'id');

        $categories = ProductCategory::get();

        $product_names = Product::pluck('name', 'id');

        return view('frontend.bookings.create', compact('user_names', 'categories', 'product_names'));
    }

    public function store(StoreBookingRequest $request)
    {

        $booking = Booking::create($request->all());
        $booking->user_names()->sync($request->input('user_names', []));
        $booking->categories()->sync($request->input('categories', []));
        $booking->product_names()->sync($request->input('product_names', []));

        //$income = new Income();
        //$income->

        return redirect('frontend/payment/'.$request->nomor_order);
        // return redirect()->route('frontend.bookings.index');
    }

    public function edit(Booking $booking)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id');

        $categories = ProductCategory::pluck('name', 'id');

        $product_names = Product::pluck('name', 'id');

        $booking->load('user_names', 'categories', 'product_names');

        return view('frontend.bookings.edit', compact('user_names', 'categories', 'product_names', 'booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());
        $booking->user_names()->sync($request->input('user_names', []));
        $booking->categories()->sync($request->input('categories', []));
        $booking->product_names()->sync($request->input('product_names', []));

        return redirect()->route('frontend.bookings.index');
    }

    public function show(Booking $booking)
    {
        abort_if(Gate::denies('booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->load('user_names', 'categories', 'product_names');

        return view('frontend.bookings.show', compact('booking'));
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

    public function ajax_get_product($id)
    {
        $id_kategori = DB::table('product_product_category')->where('product_category_id', $id)->get();
        foreach($id_kategori as $value)
        {
            $product[] = Product::where('id', $value->product_id)->get();
        }
        $data = array($id_kategori, $product);
        return $data;
    }

    public function payment($nomor_order)
    {
        $data = DB::table('bookings')->where('nomor_order', $nomor_order)->first();
        return view('frontend/bookings/payment', compact('data'));
    }

    public function post_payment(Request $request)
    {
        DB::table('bookings')->where('nomor_order', $request->nomor_order)->update([
            "status_booking" => "0",
        ]);
        return redirect()->route('frontend.bookings.index');
    }


}
