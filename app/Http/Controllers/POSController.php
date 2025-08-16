<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Str;

class POSController extends Controller
{
    public function index()
    {
        $items = Item::where('is_active', true)->get();
        return view('pos.index', compact('items'));
    }

    public function searchItem(Request $request)
    {
        $query = $request->get('query');
        
        $items = Item::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('barcode', 'LIKE', "%{$query}%");
            })
            ->get();
            
        return response()->json($items);
    }

    public function processSale(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'cashier' => 'nullable|string',
        ]);

        // Create sale
        $sale = Sale::create([
            'receipt_number' => 'RCP-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            'total_amount' => $request->total_amount,
            'tax_amount' => $request->tax_amount ?? 0,
            'discount_amount' => $request->discount_amount ?? 0,
            'payment_method' => $request->payment_method,
            'cashier' => $request->cashier ?? 'System',
        ]);

        // Create sale items
        foreach ($request->items as $itemData) {
            $item = Item::find($itemData['id']);
            $totalPrice = $item->price * $itemData['quantity'];
            
            SaleItem::create([
                'sale_id' => $sale->id,
                'item_id' => $item->id,
                'quantity' => $itemData['quantity'],
                'unit_price' => $item->price,
                'total_price' => $totalPrice,
            ]);
        }

        return response()->json([
            'success' => true,
            'sale_id' => $sale->id,
            'receipt_number' => $sale->receipt_number,
        ]);
    }

    public function printReceipt($saleId)
    {
        $sale = Sale::with(['saleItems.item'])->find($saleId);
        
        if (!$sale) {
            return response()->json(['error' => 'Sale not found'], 404);
        }
        
        return view('pos.receipt', compact('sale'));
    }
}
