<!DOCTYPE html>
<html>
<head>
    <title>BudgetBuddy - Top Up</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 50px;">

    <h2>Top Up Your Wallet</h2>

    <form action="/test-mpesa" method="POST">
        @csrf <label>Phone Number (e.g., 0712345678):</label><br>
        <input type="text" name="phone" required placeholder="07..."><br><br>

        <label>Amount (Ksh):</label><br>
        <input type="number" name="amount" required min="1"><br><br>

        <button type="submit" style="padding: 10px 20px; background: green; color: white; border: none;">
            Pay with M-Pesa
        </button>
    </form>

    @if(session('message'))
        <p style="color: green; font-weight: bold;">{{ session('message') }}</p>
    @endif

</body>
</html>