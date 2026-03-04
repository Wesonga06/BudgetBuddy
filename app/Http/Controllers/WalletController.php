<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User; // We need this to update the user's balance!

class WalletController extends Controller
{
    // 1. THE TRIGGER: Laravel asks Node to send the prompt to the phone
    public function initiateTopUp(Request $request)
    {
        $userPhone = $request->input('phone');
        $userAmount = $request->input('amount');

        // Auto-format the phone number to start with 254
        if (str_starts_with($userPhone, '0')) {
            $userPhone = '254' . substr($userPhone, 1);
        }

        // Send the DYNAMIC data to your Node.js Robot
        $response = Http::post('http://127.0.0.1:3000/api/pay-bill', [
            'receiver_phone' => $userPhone,
            'amount' => $userAmount,
            'account_reference' => 'BudgetBuddy',
            'transaction_desc' => 'Wallet Top Up',
        ]);

        if ($response->successful()) {
            // CHANGED: Redirect to the dashboard with the 'status' message your view expects!
            return redirect('/dashboard')->with('status', 'M-Pesa prompt sent! Check your phone to enter your PIN.');
        }

        // CHANGED: Redirect back with an error if Node is asleep
        return back()->withErrors(['Failed to connect to the M-Pesa payment server.']);
    }

    // 2. THE RECEIVER: Node hands the Safaricom receipt to Laravel
    public function updateDatabase(Request $request)
    {
        $data = $request->all();
        Log::info('Laravel received M-Pesa Receipt!', $data);

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

            // 3. THE ACTUAL DATABASE UPDATE
            // Find the user whose phone number matches the one that just paid
            $user = User::where('phone', $phone)->first();
            
            if ($user) {
                // Add the money to their M-Pesa balance! 
                // (Note: Make sure your users table has a column called 'mpesa_balance')
                $user->mpesa_balance += $amount;
                $user->save();
                
                Log::info("Successfully added Ksh {$amount} to the wallet!");
            } else {
                // If they pay but aren't registered in your database yet
                Log::warning("Payment received, but no user found with phone number: {$phone}");
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Database updated']);
    }
}