<x-app-layout>
    <div class="container dashboard-main">
        <div class="card">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-wallet"></i> Connected Accounts</h3>
            <div class="account-grid">
                <div class="account-card mpesa">
                    <i class="fas fa-mobile-alt"></i>
                    <p>MPESA</p>
                    <h4 style="font-size: 1.2rem; margin: 5px 0;">sh. 12,450</h4>
                    <span class="status connected">Active</span>
                </div>

                <div class="account-card bank">
                    <i class="fas fa-university"></i>
                    <p>Equity Bank</p>
                    <h4 style="font-size: 1.2rem; margin: 5px 0;">sh. 85,000</h4>
                    <span class="status connected">Active</span>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-lock"></i> Goal-Locked Savings</h3>
            
            <div class="goal-item" style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4>Emergency Fund</h4>
                    <span style="color: var(--success); font-weight: bold; font-size: 0.8rem;"><i class="fas fa-lock"></i> Locked</span>
                </div>
                <div class="goal-progress-bg">
                    <div class="goal-progress-fill" style="width: 45%; background: var(--success);"></div>
                </div>
                <small style="color: #666;">sh. 45,000 / 100,000</small>
            </div>

            <div class="goal-item">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4>New Laptop</h4>
                    <span style="color: var(--primary-color); font-weight: bold; font-size: 0.8rem;"><i class="fas fa-clock"></i> 12 days left</span>
                </div>
                <div class="goal-progress-bg">
                    <div class="goal-progress-fill" style="width: 75%; background: var(--primary-color);"></div>
                </div>
                <small style="color: #666;">sh. 75,000 / 100,000</small>
            </div>
        </div>
    </div>
</x-app-layout>