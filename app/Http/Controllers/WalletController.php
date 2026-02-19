<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Assuming you have a User model

class WalletController extends Controller
{
    // 1. THE TRIGGER: Laravel asks Node to send the prompt to the phone
    public function initiateTopUp(Request $request)
    {
        // 1. Grab what the user typed in the form
        $userPhone = $request->input('phone');
        $userAmount = $request->input('amount');

        // 2. Auto-format the phone number to start with 254
        // If they typed "0712...", cut off the "0" and add "254"
        if (str_starts_with($userPhone, '0')) {
            $userPhone = '254' . substr($userPhone, 1);
        }

        // 3. Send the DYNAMIC data to your Node.js Robot
        $response = Http::post('http://127.0.0.1:3000/api/pay-bill', [
            'receiver_phone' => $userPhone,
            'amount' => $userAmount,
            'account_reference' => 'BudgetBuddy',
            'transaction_desc' => 'Wallet Top Up',
            // If you have user login set up, use auth()->id(), otherwise default to 1
            'user_id' => auth()->id() ?? 1 
        ]);

        if ($response->successful()) {
            // Send them back to the form with a success message
            return back()->with('message', 'Prompt sent to ' . $userPhone . '! Please enter your PIN.');
        }

        return back()->with('message', 'Failed to connect to the payment server.');
    }

    // 2. THE RECEIVER: Node hands the Safaricom receipt to Laravel
    public function updateDatabase(Request $request)
    {
        // 1. Grab the receipt data Node just handed us
        $data = $request->all();
        
        // Log it so we can see it in Laravel's storage/logs/laravel.log
        Log::info('Laravel received M-Pesa Receipt!', $data);

        // 2. Extract the data we care about from Safaricom's confusing JSON
        $items = $data['Body']['stkCallback']['CallbackMetadata']['Item'] ?? null;
        
        if ($items) {
            $amount = null;
            $phone = null;
            $receiptNumber = null;

            foreach ($items as $item) {
                if ($item['Name'] === 'Amount') $amount = $item['Value'];
                if ($item['Name'] === 'PhoneNumber') $phone = $item['Value'];
                if ($item['Name'] === 'MpesaReceiptNumber') $receiptNumber = $item['Value'];
            }

            Log::info("Extracted: Phone {$phone} paid Ksh {$amount}. Receipt: {$receiptNumber}");

            // 3. UPDATE THE DATABASE!
            // Example: Find the user with this phone number and add the money
            /*
            $user = User::where('phone', $phone)->first();
            if ($user) {
                $user->wallet_balance += $amount;
                $user->save();
                Log::info("Successfully added funds to user's wallet!");
            }
            */
        }

        // Always reply to Node so it knows we got it
        return response()->json(['status' => 'success', 'message' => 'Database updated']);
    }
}