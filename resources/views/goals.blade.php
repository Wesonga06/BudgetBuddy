<x-app-layout>
    <div class="container dashboard-main">
        
        <div class="card">
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);"><i class="fas fa-plus-circle"></i> Set a New Goal</h3>
                <p style="color: #666; font-size: 0.9rem;">What are you saving for?</p>
            </div>

            <form method="POST" action="{{ route('goals.store') }}">
                @csrf
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Goal Title</label>
                    <input type="text" name="title" placeholder="e.g. Emergency Fund, New Laptop" required 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Target Amount (KES)</label>
                    <input type="number" name="target_amount" placeholder="e.g. 50000" required min="1"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-lock"></i> Create Goal
                </button>
            </form>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-list"></i> Your Current Goals</h3>
            
            @if(isset($goals) && $goals->count() > 0)
                @foreach($goals as $goal)
                    <div class="goal-item" style="padding: 15px 0; border-bottom: 1px solid #eee;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="margin: 0;">{{ $goal->title }}</h4>
                            <span style="font-size: 0.9rem; color: #666;">
                                {{ number_format($goal->current_amount) }} / {{ number_format($goal->target_amount) }}
                            </span>
                        </div>
                        
                        @php
                            $percent = $goal->target_amount > 0 ? ($goal->current_amount / $goal->target_amount) * 100 : 0;
                            $percent = min($percent, 100); // Cap at 100%
                        @endphp
                        
                        <div style="width: 100%; height: 8px; background: #eee; border-radius: 4px; margin-top: 8px; overflow: hidden;">
                            <div style="width: {{ $percent }}%; height: 100%; background: var(--success); transition: width 0.5s;"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="color: #888; text-align: center; padding: 20px;">You haven't set any goals yet.</p>
            @endif
        </div>

    </div>
</x-app-layout>