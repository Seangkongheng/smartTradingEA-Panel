{{-- Marketplace Show Page - Alternative Design --}}
<div class="marketplace-container">
    {{-- Hero Section with Title and Status --}}
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="marketplace-title">{{ $marketplace->title }}</h1>
            <span class="status-pill {{ $marketplace->is_public ? 'public' : 'private' }}">
                {{ $marketplace->is_public ? 'Public' : 'Private' }}
            </span>
        </div>
    </div>

    {{-- Two Column Layout --}}
    <div class="content-grid">
        {{-- Left Column: Details --}}
        <div class="details-column">
            <div class="info-card">
                <div class="info-header">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3>Feature</h3>
                </div>

                <div class="info-content [&_ul]:list-disc [&_ul]:pl-6 [&_li]:mb-2">
                    {!! $marketplace->feature !!}
                </div>

            </div>

            <div class="info-card">
                <div class="info-header">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3>Description</h3>
                </div>
                <p class="info-content">{{ $marketplace->description ?? 'No description provided.' }}</p>
            </div>
        </div>

        {{-- Right Column: Pricing Plans --}}
        <div class="plans-column">
            <h2 class="plans-title">Marketplace Plan</h2>

            @forelse($marketplace->subscriptionPlans as $index => $marketplacePlan)
            @php
            $plan = $marketplacePlan->plan;
            $isPopular = $index === 1;
            @endphp

            <div class="pricing-card {{ $isPopular ? 'popular' : '' }}">
                <h4 class="plan-title">{{ $plan->name ?? 'Unnamed Plan' }}</h4>

                @if($plan->desc)
                <p class="plan-desc">{{ $plan->desc }}</p>
                @endif

                <div class="price-section">
                    <span class="currency">$</span>
                    <span class="amount">{{ $marketplacePlan->price ?? $plan->price ?? '0' }}</span>
                    <span class="period">/month</span>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p>No subscription plans available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .marketplace-container {
        padding: 2rem;
    }

    .hero-section {
        background: white;
        border-radius: 16px;
        padding: 3rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .hero-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .marketplace-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }

    .status-pill {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-pill.public {
        background: #d1fae5;
        color: #065f46;
    }

    .status-pill.private {
        background: #fef3c7;
        color: #92400e;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
    }

    @media (max-width: 968px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .info-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .icon {
        width: 24px;
        height: 24px;
        color: #667eea;
    }

    .info-header h3 {
        margin: 0;
        font-size: 1.25rem;
        color: #2d3748;
    }

    .info-content {
        color: #4a5568;
        line-height: 1.6;
        margin: 0;
    }

    .plans-column {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .plans-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 2rem 0;
        text-align: center;
    }

    .pricing-card {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .pricing-card:hover {
        border-color: #667eea;
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.2);
    }

    .pricing-card.popular {
        border-color: #667eea;
        border-width: 3px;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
    }

    .popular-badge {
        position: absolute;
        top: -12px;
        right: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.375rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .plan-label {
        display: inline-block;
        background: #fef3c7;
        color: #92400e;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .plan-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 0.5rem 0;
    }

    .plan-desc {
        color: #718096;
        margin: 0 0 1.5rem 0;
        line-height: 1.5;
    }

    .price-section {
        display: flex;
        align-items: baseline;
        margin-bottom: 1.5rem;
    }

    .currency {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4a5568;
    }

    .amount {
        font-size: 3rem;
        font-weight: 800;
        color: #1a202c;
        margin: 0 0.25rem;
    }

    .period {
        font-size: 1rem;
        color: #718096;
    }

    .subscribe-btn {
        width: 100%;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .subscribe-btn.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .subscribe-btn.primary:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .subscribe-btn.secondary {
        background: #edf2f7;
        color: #2d3748;
    }

    .subscribe-btn.secondary:hover {
        background: #e2e8f0;
    }

    .plan-meta {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
        font-size: 0.875rem;
        color: #a0aec0;
        text-align: center;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        color: #cbd5e0;
        margin: 0 auto 1rem;
    }

    .empty-state p {
        color: #718096;
        font-size: 1.125rem;
    }
</style>
