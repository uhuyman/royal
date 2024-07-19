<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
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
            'age' => 'required|string|max:255',
            'lifestyle' => 'required|string|max:255',
            'special_need' => 'required|string|max:255',
            'brand_before' => 'required|string|max:255',
            'know_brand_rc' => 'required|boolean',
            'before_buy' => 'required|string|max:255',
            'information' => 'required|string|max:255',
            'buy' => 'required|boolean',
            'product_buy' => 'required|string|max:255',
            'qty_recomend' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }
        date_default_timezone_set('Asia/Jakarta');

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
            'jam' => date('H:i:s'), // Waktu saat ini
            'tanggal' => now(), // Tanggal saat ini
        ]);


        return response()->json(['data' => $customer]);
    }
    public function getdata()
    {
        $id_user = Auth::id();
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
        $validator = Validator::make($request->all(), [
            'information' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }

        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = Carbon::now();
        $dateVisit = $currentDateTime->toDateString();
        $timeVisit = $currentDateTime->format('H:i');

        // Proses file gambar yang diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'visit_' . $currentDateTime->format('d-m-Y_H:i') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('visit'), $imageName);
        }

        // Simpan data dengan mengisi time_visit dan date_visit secara otomatis
        $visit = Visit::create([
            'id_user' => Auth::id(),
            'time_visit' => $timeVisit,
            'date_visit' => $dateVisit,
            'location' => $request->location,
            'image' => $imageName,
            'information' => $request->information,
        ]);

        return response()->json([
            'success' => true,
            'data' => $visit,
        ]);
    }
    public function getdatavisit()
    {
        $id_user = Auth::id();
        $visits = Visit::where('id_user', $id_user)->get();

        if ($visits->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Kunjungan tidak ditemukan',
            ], 404);
        }

        // Tambahkan URL gambar untuk setiap kunjungan
        $visits->transform(function ($visit) {
            $visit->image_url = url('visit/' . $visit->image);
            return $visit;
        });

        return response()->json([
            'success' => true,
            'data' => $visits,
        ]);
    }
    public function getusername(){
        $id_user = Auth::id();
        $username = User::select('name')->where('id', $id_user)->first();

        if (!$username) {
            return response()->json([
                'success' => false,
                'message' => 'Nama User tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $username,
        ]);
    }


    }

