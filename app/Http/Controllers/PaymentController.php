<?php

namespace App\Http\Controllers;

use Auth;
use Omnipay;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function sendTestPurchase()
    {
        $options = [
            'amount' => '100.00',
            'currency' => 'NZD',
            'returnUrl' => route('pxpay.return'),
            'cancelUrl' => route('pxpay.cancel'),
            'description' => 'apples',
            'transactionId' => uniqid(),
        ];

        $purchaseResponse = Omnipay::purchase($options)->send();

        if ($purchaseResponse->isSuccessful()){
            // payment is successful
            dd("NOT SUPPOSED TO HAPPEN");
        } elseif ($purchaseResponse->isRedirect()) {
            $purchaseResponse->redirect();
        } else {
            // something went wrong, not successful
            dd($purchaseResponse);
        }
    }

    public function sendPurchase()
    {
        $user = Auth::user();
        $order = $user->cart();

        $total = $order->subtotal();

        $options = [
            'amount' => number_format($total, 2, ".", ""),
            'currency' => 'NZD',
            'returnUrl' => route('pxpay.return'),
            'cancelUrl' => route('pxpay.cancel'),
            'description' => $user->name . " #" . $order->id,
            'transactionId' => $order->id . "-" . uniqid(),
        ];

        $purchaseResponse = Omnipay::purchase($options)->send();

        if ($purchaseResponse->isSuccessful()){
            // payment is successful
            dd("NOT SUPPOSED TO HAPPEN");
        } elseif ($purchaseResponse->isRedirect()) {
            $purchaseResponse->redirect();
        } else {
            // something went wrong, not successful
            dd($purchaseResponse);
        }

    }

    public function confirmPurchase()
    {
        $purchaseConfirmation = Omnipay::completePurchase()->send();

        $user = Auth::user();
        $order = $user->cart();

        if ($purchaseConfirmation->isSuccessful()) {

            $data = $purchaseConfirmation->getData();

            $order->order_status = "paid";
            $order->payment_received = true;
            $order->total_price = $data->AmountSettlement;
            $order->payment_reference = $purchaseConfirmation->getTransactionReference();
            $order->save();

            return view('payment.success', compact('order'));

        } else {
            $reason = $purchaseConfirmation->getMessage();
            $order->order_status = "cart";
            $order->save();

            return view('payment.failure', compact('reason', 'order'));
        }
    }

    public function cancelPurchase()
    {
        # code...
    }
}
