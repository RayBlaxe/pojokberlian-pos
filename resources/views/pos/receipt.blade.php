@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="thermal-receipt">
    @php
        $settings = \App\Models\BusinessSetting::getSettings();
    @endphp
    
    <div class="center" style="margin-bottom: 10px;">
        @if(str_starts_with($settings->logo_path, 'logos/'))
            <img src="{{ Storage::url($settings->logo_path) }}" alt="Logo" width="40" height="40" style="display: block; margin: 0 auto;">
        @else
            <img src="{{ asset($settings->logo_path) }}" alt="Logo" width="40" height="40" style="display: block; margin: 0 auto;">
        @endif
    </div>
    
    <div class="center bold">
        {{ $settings->business_name }}
    </div>
    <div class="center">
        {{ $settings->address }}<br>
        {{ $settings->city }}<br>
        Telp: {{ $settings->phone }}
    </div>
    
    <div class="dashed-line"></div>
    
    <div class="center">
        RECEIPT #{{ $sale->receipt_number }}
    </div>
    <div class="center">
        {{ $sale->created_at->format('M d, Y H:i:s') }}
    </div>
    <div>
        Cashier: {{ $sale->cashier }}
    </div>
    <div>
        Payment: {{ ucfirst($sale->payment_method) }}
    </div>
    
    <div class="dashed-line"></div>
    
    @foreach($sale->saleItems as $item)
    <div>
        {{ $item->item->name }}<br>
        {{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}
        <span style="float: right;">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
    </div>
    @endforeach
    
    <div class="dashed-line"></div>
    
    <div>
        Subtotal: 
        <span style="float: right;">Rp {{ number_format($sale->total_amount - $sale->tax_amount, 0, ',', '.') }}</span>
    </div>
    
    @if($sale->tax_amount > 0)
    <div>
        Tax (10%): 
        <span style="float: right;">Rp {{ number_format($sale->tax_amount, 0, ',', '.') }}</span>
    </div>
    @endif
    
    @if($sale->discount_amount > 0)
    <div>
        Discount: 
        <span style="float: right;">-Rp {{ number_format($sale->discount_amount, 0, ',', '.') }}</span>
    </div>
    @endif
    
    <div class="bold">
        TOTAL: 
        <span style="float: right;">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span>
    </div>
    
    <div class="dashed-line"></div>
    
    <div class="center">
        {!! nl2br(e($settings->footer_message)) !!}
    </div>
    
    <div class="center" style="margin-top: 10px;">
        {{ date('Y-m-d H:i:s') }}
    </div>
</div>
