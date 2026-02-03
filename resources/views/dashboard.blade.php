<x-app-layout>
    <div class="container dashboard-main">
        
        @if(session('status'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="card">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-wallet"></i> Connected Accounts</h3>
            <div class="account-grid">
                <div class="account-card mpesa">
                    <i class="fas fa-mobile-alt"></i>
                    <p>MPESA</p>
                    <h4 style="font-size: 1.2rem; margin: 5px 0;">sh. {{ number_format($mpesaBalance, 2) }}</h4>
                    <span class="status connected">Active</span>
                </div>

                <div class="account-card bank">
                    <i class="fas fa-university"></i>
                    <p>Bank Account</p>
                    <h4 style="font-size: 1.2rem; margin: 5px 0;">sh. {{ number_format($bankBalance, 2) }}</h4>
                    <span class="status connected">Active</span>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--primary-color);"><i class="fas fa-lock"></i> Savings Goals</h3>
                
                <form action="{{ route('goals.store') }}" method="POST" style="display: flex; gap: 10px;">
                    @csrf
                    <input type="text" name="title" placeholder="New Goal Name" required style="padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.85rem;">
                    <input type="number" name="target_amount" placeholder="Target" required style="width: 80px; padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.85rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 6px 15px; font-size: 0.85rem; border-radius: 6px;">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </form>
            </div>
            
            @forelse($goals as $goal)
                @php 
                    $percent = ($goal->target_amount > 0) ? ($goal->current_amount / $goal->target_amount) * 100 : 0;
                    $percent = min($percent, 100);
                    $isReached = $goal->current_amount >= $goal->target_amount;
                @endphp

                <div class="goal-item" style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px dashed #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 5px;">
                        <div>
                            <span style="font-weight: 600; font-size: 1.1rem;">
                                {{ $goal->title }}
                                @if(!$isReached)
                                    <i class="fas fa-lock" style="font-size: 0.8rem; color: #bbb; margin-left: 5px;" title="Funds Locked"></i>
                                @else
                                    <i class="fas fa-check-circle" style="font-size: 0.9rem; color: var(--success); margin-left: 5px;"></i>
                                @endif
                            </span>
                            <div style="font-size: 0.85rem; color: #666; margin-top: 2px;">
                                Saved: <strong>sh. {{ number_format($goal->current_amount) }}</strong> 
                                / {{ number_format($goal->target_amount) }}
                            </div>
                        </div>
                        
                        @if(!$isReached)
                            <button onclick="openDepositModal({{ $goal->id }}, '{{ addslashes($goal->title) }}')" 
                                    class="btn" 
                                    type="button"
                                    style="background: var(--primary-color); color: white; padding: 6px 15px; font-size: 0.8rem; border-radius: 4px; border:none; cursor: pointer;">
                                <i class="fas fa-plus-circle"></i> Top Up
                            </button>
                        @else
                            <form action="{{ route('goals.withdraw', $goal->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="btn" 
                                        style="background: #fbbc04; color: #222; padding: 6px 15px; font-size: 0.8rem; border-radius: 4px; border:none; cursor: pointer; font-weight: bold;">
                                    <i class="fas fa-unlock-alt"></i> Withdraw Funds
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <div class="goal-progress-bg" style="background: #eee; height: 10px; border-radius: 5px; overflow: hidden;">
                        <div class="goal-progress-fill" 
                             style="width: {{ $percent }}%; height: 100%; transition: width 0.5s ease;
                                    background: {{ $isReached ? '#fbbc04' : 'var(--success)' }};">
                        </div>
                    </div>
                    
                    <div style="text-align: right; font-size: 0.75rem; color: #888; margin-top: 4px;">
                        @if($isReached)
                            <span style="color: var(--success); font-weight: bold;">Goal Reached!</span>
                        @else
                            {{ number_format($percent, 0) }}% Reached
                        @endif
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 30px; color: #888;">
                    <i class="fas fa-piggy-bank" style="font-size: 2rem; margin-bottom: 10px; color: #ddd;"></i>
                    <p>No goals set yet. Start saving today!</p>
                </div>
            @endforelse
        </div>

        <div class="card" style="margin-top: 25px;">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-history"></i> Recent Activity</h3>
            @if(isset($transactions) && $transactions->count() > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        @foreach($transactions as $t)
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 10px 0;">
                                    <div style="font-weight: 500;">{{ $t->description }}</div>
                                    <div style="font-size: 0.8rem; color: #888;">{{ \Carbon\Carbon::parse($t->date)->format('M d') }} • {{ ucfirst($t->source) }}</div>
                                </td>
                                <td style="text-align: right; font-weight: bold; color: {{ ($t->type == 'income' || $t->type == 'withdraw') ? 'green' : 'red' }};">
                                    {{ ($t->type == 'income' || $t->type == 'withdraw') ? '+' : '-' }} {{ number_format($t->amount) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 15px; text-align: center;">
                    <a href="{{ route('transactions.index') }}" style="color: var(--primary-color); text-decoration: none; font-size: 0.9rem;">View Full History &rarr;</a>
                </div>
            @else
                <p style="color: #999; text-align: center;">No recent transactions.</p>
            @endif
        </div>

    </div>

    <div id="depositModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background: white; padding: 30px; border-radius: 12px; width: 90%; max-width: 400px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); animation: slideIn 0.3s ease;">
            <h3 style="margin-top: 0;">Add Savings 🔒</h3>
            <p>Adding to: <strong id="modalGoalTitle">Goal</strong></p>
            <p style="font-size: 0.85rem; color: #666; margin-bottom: 15px;">Funds are locked until the goal is reached!</p>

            <form id="depositForm" method="POST" action="">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Amount (sh)</label>
                    <input type="number" name="amount" required min="1" placeholder="e.g. 500" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
                
                <div style="display: flex; gap: 10px;">
                    <button type="button" onclick="closeDepositModal()" 
                            style="flex: 1; padding: 10px; background: #eee; border: none; border-radius: 6px; cursor: pointer;">Cancel</button>
                    <button type="submit" 
                            style="flex: 1; padding: 10px; background: var(--success); color: white; border: none; border-radius: 6px; cursor: pointer;">Add Money</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Logic
        window.openDepositModal = function(id, title) {
            var baseUrl = "{{ url('/goals') }}"; 
            var form = document.getElementById('depositForm');
            form.action = baseUrl + '/' + id + '/deposit';
            document.getElementById('modalGoalTitle').innerText = title;
            document.getElementById('depositModal').style.display = 'flex';
        }

        window.closeDepositModal = function() {
            document.getElementById('depositModal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('depositModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

    @if(session('confetti'))
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
            // Fire confetti!
            confetti({
                particleCount: 150,
                spread: 70,
                origin: { y: 0.6 }
            });
        </script>
    @endif

</x-app-layout>