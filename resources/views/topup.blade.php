<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBuddy - Top Up</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        h2 { color: #333; text-align: center; margin-bottom: 25px; font-size: 24px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #555; font-weight: 600; font-size: 14px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; transition: border-color 0.3s; }
        input:focus { border-color: #28a745; outline: none; }
        .btn { width: 100%; padding: 14px; background-color: #28a745; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn:hover { background-color: #218838; }
        .error { color: #dc3545; font-size: 14px; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Wallet Top Up</h2>
        
        <form action="/test-mpesa" method="POST">
            @csrf 
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" required placeholder="e.g., 0712345678">
            </div>
            
            <div class="form-group">
                <label>Amount (Ksh)</label>
                <input type="number" name="amount" required min="1" placeholder="Enter amount">
            </div>
            
            <button type="submit" class="btn">Pay with M-Pesa</button>
        </form>

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
    </div>
</body>
</html>