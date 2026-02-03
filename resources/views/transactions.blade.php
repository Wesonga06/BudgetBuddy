<x-app-layout>
    <div class="container dashboard-main">
        
        @if(session('status'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);"><i class="fas fa-exchange-alt"></i> New Transaction</h3>
                <p style="color: #666; font-size: 0.9rem;">Record your income or expenses manually.</p>
            </div>

            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Type</label>
                        <select name="type" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            <option value="expense">Expense (Spending)</option>
                            <option value="income">Income (Earnings)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Account</label>
                        <select name="source" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            <option value="mpesa">MPESA</option>
                            <option value="bank">Bank Account</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Amount (KES)</label>
                        <input type="number" name="amount" placeholder="e.g. 500" required min="1"
                               style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    </div>

                    <div class="form-group">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Date</label>
                        <input type="date" name="date" required value="{{ date('Y-m-d') }}"
                               style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Description (Optional)</label>
                    <input type="text" name="description" placeholder="e.g. Lunch, Salary, Bus Fare"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; border-radius: 8px; background-color: #4f46e5; color: white; border: none; font-weight: bold; cursor: pointer;">
                    <i class="fas fa-save"></i> Save Transaction
                </button>
            </form>
        </div>

        <div class="card" style="margin-top: 30px;">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-history"></i> Recent History</h3>
            
            @if(isset($transactions) && $transactions->count() > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; border-bottom: 2px solid #eee;">
                            <th style="padding: 10px;">Description</th>
                            <th style="padding: 10px;">Source</th>
                            <th style="padding: 10px;">Date</th>
                            <th style="padding: 10px; text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $t)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px 10px; font-weight: 500;">
                                    {{ $t->description ?? 'No description' }}
                                </td>
                                <td style="padding: 12px 10px;">
                                    <span style="background: #eee; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; text-transform: uppercase;">
                                        {{ $t->source }}
                                    </span>
                                </td>
                                <td style="padding: 12px 10px; color: #666; font-size: 0.9rem;">
                                    {{ \Carbon\Carbon::parse($t->date ?? $t->created_at)->format('M d, Y') }}
                                </td>
                                <td style="padding: 12px 10px; text-align: right; font-weight: bold; 
                                           color: {{ $t->type == 'income' || $t->type == 'withdraw' ? 'green' : 'red' }};">
                                    {{ ($t->type == 'income' || $t->type == 'withdraw') ? '+' : '-' }} {{ number_format($t->amount) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: #888; padding: 20px;">No transactions found. Add one above!</p>
            @endif
        </div>

    </div>
</x-app-layout>