<div class="thermal-receipt">
    <div class="center bold">
        TOKO SERBA ADA
    </div>
    <div class="center">
        Jl. Raya Utama No. 123<br>
        Jakarta Pusat, DKI Jakarta<br>
        Telp: (021) 123-4567
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
        Thank you for your business!<br>
        Please come again!
    </div>
    
    <div class="center" style="margin-top: 10px;">
        {{ date('Y-m-d H:i:s') }}
    </div>
</div>
