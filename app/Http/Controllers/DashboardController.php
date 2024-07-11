<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Visit;
//use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{
    public function insertdata(Request $request){
        $validator = Validator::make($request->all(), [
            'cust_name' => 'required|string|max:255',
            'cust_hp' => 'required|string|max:20',
            'species' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'age' => 'required|integer|max:99',
            'lifestyle' => 'required|string|max:255',
            'special_need' => 'required|string|max:255',
            'brand_before' => 'required|string|max:255',
            'know_brand_rc' => 'required|boolean',
            'before_buy' => 'required|string|max:255',
            'information' => 'required|string|max:255',
            'buy' => 'required|boolean',
            'product_buy' => 'required|string|max:255',
            'qty_recomend' => 'required|integer|max:9999',
            'quantity' => 'required|integer|max:9999',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $customer = Customer::create([
            'id_user' => Auth::id(), // Mengambil ID user dari autentikasi
            'cust_name' => $request->cust_name,
            'cust_hp' => $request->cust_hp,
            'species' => $request->species,
            'ras' => $request->ras,
            'age' => $request->age,
            'lifestyle' => $request->lifestyle,
            'special_need' => $request->special_need,
            'brand_before' => $request->brand_before,
            'know_brand_rc' => $request->know_brand_rc,
            'before_buy' => $request->before_buy,
            'information' => $request->information,
            'buy' => $request->buy,
            'product_buy' => $request->product_buy,
            'qty_recomend' => $request->qty_recomend,
            'quantity' => $request->quantity,
        ]);

        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $customer, 'access_token' => $token, 'token_type' => 'Bearer']);
    }
    public function getdata()
    {
        // Ambil id_user dari pengguna yang sedang login
        $id_user = Auth::id();

        // Ambil data customer berdasarkan id_user
        $customers = Customer::where('id_user', $id_user)->get();

        if ($customers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $customers,
        ]);
    }
    public function postdatavisit(Request $request)
{
    // Validasi hanya untuk location, image, dan information
    $validator = Validator::make($request->all(), [
        'location' => 'required|string', // Validasi teks panjang
        'image' => 'required|string|max:100', // Validasi string dengan panjang maksimum 100 karakter
        'information' => 'required|string', // Validasi teks panjang
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Ada Kesalahan',
            'data' => $validator->errors()
        ]);
    }

    // Simpan data dengan mengisi time_visit dan date_visit secara otomatis
    $visit = Visit::create([
        'id_user' => Auth::id(),
        'time_visit' => Carbon::now()->format('H:i'), // Mengambil waktu saat ini dalam format H:i:s
        'date_visit' => Carbon::now()->toDateString(), // Mengambil tanggal saat ini dalam format YYYY-MM-DD
        'location' => $request->location,
        'image' => $request->image,
        'information' => $request->information,
    ]);

    $token = $visit->createToken('auth_token')->plainTextToken;

    return response()->json([
        'data' => $visit,
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
}

    }

