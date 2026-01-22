<x-app-layout>
    <div class="container dashboard-main">
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

        <div class="card">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-lock"></i> Savings Goals</h3>
            
            @forelse($goals as $goal)
                @php 
                    $percent = ($goal->target_amount > 0) ? ($goal->current_amount / $goal->target_amount) * 100 : 0;
                @endphp
                <div class="goal-item" style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>{{ $goal->title }}</span>
                        <span>sh. {{ number_format($goal->current_amount) }} / {{ number_format($goal->target_amount) }}</span>
                    </div>
                    <div class="goal-progress-bg">
                        <div class="goal-progress-fill" style="width: {{ $percent }}%; background: var(--primary-color);"></div>
                    </div>
                </div>
            @empty
                <p style="color: #888;">No goals set yet. Click "Goals" to start saving!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>