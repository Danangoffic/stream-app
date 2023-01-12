<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{


    public function store(Request $request)
    {


        $package = Package::findOrFail($request->package_id);
        if (!$package) {
            return back()->withErrors(['package' => 'Package is not available']);
        }

        $customer = auth()->user();

        $transaction = Transaction::create([
            'package_id' => $package->id,
            'user_id' => $customer->id,
            'amount' => $package->price,
            'transaction_code' => strtoupper(Str::random(8))."-".rand(1000,10000),
            'status' => 'pending'
        ]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS3DS');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->transaction_code,
                'gross_amount' => $transaction->amount,
            ),
            'customer_details' => array(
                'first_name' => $customer->name,
                'last_name' => $customer->name,
                'email' => $customer->email,
            ),
        );
        $createMidtransTransaction = \Midtrans\Snap::createTransaction($params);
        $midtransRedirectURL = $createMidtransTransaction->redirect_url;

        return redirect($midtransRedirectURL);
    }
}
