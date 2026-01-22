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

        <div class="card" style="margin-top: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--primary-color);"><i class="fas fa-lock"></i> Savings Goals</h3>
                <a href="{{ route('goals') }}" class="btn btn-primary" style="padding: 8px 15px; font-size: 0.85rem; text-decoration: none; border-radius: 6px;">
                    <i class="fas fa-plus"></i> Add Goal
                </a>
            </div>
            
            @forelse($goals as $goal)
                @php 
                    // Calculate percentage safely (avoid divide by zero)
                    $percent = ($goal->target_amount > 0) ? ($goal->current_amount / $goal->target_amount) * 100 : 0;
                    // Cap it at 100% for visual cleanliness
                    $percent = min($percent, 100);
                @endphp

                <div class="goal-item" style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="font-weight: 500;">{{ $goal->title }}</span>
                        <span style="font-size: 0.9rem; color: #666;">
                            sh. {{ number_format($goal->current_amount) }} / {{ number_format($goal->target_amount) }}
                        </span>
                    </div>
                    
                    <div class="goal-progress-bg">
                        <div class="goal-progress-fill" style="width: {{ $percent }}%; background: var(--success);"></div>
                    </div>
                    
                    <div style="text-align: right; font-size: 0.75rem; color: #888; margin-top: 2px;">
                        {{ number_format($percent, 0) }}% Reached
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 30px; color: #888;">
                    <i class="fas fa-piggy-bank" style="font-size: 2rem; margin-bottom: 10px; color: #ddd;"></i>
                    <p>No goals set yet.</p>
                    <a href="{{ route('goals') }}" style="color: var(--primary-color); font-weight: bold; text-decoration: none;">Create your first goal &rarr;</a>
                </div>
            @endforelse
        </div>
        
    </div>
</x-app-layout>