<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{

    public function store($orderId)
    {
        $user_id = Auth::user()->id;
        $order = Order::findOrFail($orderId);

        // التحقق من وجود فاتورة سابقة لهذا الطلب
        $existingBill = Bill::where('order_id', $order->id)->first();
        if ($existingBill) {
            return redirect()->route('bills.show', $existingBill->id);
        }

        $project = Project::first();
        $client = $order->client;
        $items = $order->orderItems()->get();

        $billData = [
            'project_name' => $project->name ?? '',
            'project_link' => $project->link ?? '',
            'project_qr' => $project->qr_code ?? '',
            'date' => $order->created_at->format('Y-m-d H:i'),
            'client' => [
                'name' => $client->name ?? '',
                'email' => $client->email ?? '',
                'id' => $client->id ?? '',
            ],
            'order_details' => [
                'order_number' => $order->order_number,
                'order_type' => $order->order_type,
                'table_number' => $order->table_number,
            ],
            'meals' => $items->map(function($item) {
                return [
                    'meal_id' => $item->meal_id,
                    'meal_name' => Meal::find($item->meal_id)->name ?? 'Deleted Meal',
                    'quantity' => $item->quantity,
                    'price' => $item->unit_price,
                    'total' => $item->total_price,
                ];
            }),
            'summary' => [
                'subtotal' => $order->subtotal,
                'tax_amount' => $order->tax_amount,
                'delivery_fee' => $order->delivery_fee,
                'total_amount' => $order->total_amount,
            ]
        ];

        $bill = new Bill();
        $bill->order_id = $order->id;
        $bill->bill_number = 'BILL-' . now()->format('YmdHis') . '-' . $order->id;
        $bill->bill_data = json_encode($billData);
        $bill->save();

        return redirect()->route('bills.show', $bill->id);
    }

    public function show($id)
    {
        $bill = Bill::with('order.client')->findOrFail($id);
        $billData = json_decode($bill->bill_data, true);
        return view('bills.show', compact('bill', 'billData'));
    }
}
