<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WebhookController extends Controller
{
    public function handler()
    {
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        // $type = $notif->payment_type;
        $transactionCode = $notif->order_id;
        $fraudStatus = $notif->fraud_status;
        $status = '';

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $status = 'challenge';
            } else if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } else if ($transactionStatus == 'settlement') {
            $status = 'success';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $status = 'failure';
        } else if ($transactionStatus == 'pending') {
            $status = 'pending';
        }

        $transaction = Transaction::with(['package'])
            ->where('transaction_code', $transactionCode)
            ->first();

        if ($status === 'success') {

            $userPremium = UserPremium::where('user_id', $transaction->user_id)->first();
            if ($userPremium) {
                $endOfSubscription = $userPremium->end_of_subscription;
                $date = Carbon::createFromFormat("Y-m-d", $endOfSubscription);
                $newEndOfSubscription = $date->addDays($transaction->package->max_days)->format('Y-m-d');
                $userPremium->update([
                    'package_id' => $transaction->package_id,
                    'end_of_subscription' => $newEndOfSubscription
                ]);
            } else {
                UserPremium::create([
                    'package_id' => $transaction->package_id,
                    'user_id' => $transaction->user_id,
                    'end_of_subscription' => now()->addDay($transaction->package->max_days)
                ]);
            }
        }
        $transaction->update(['status' => $status]);
    }
}
