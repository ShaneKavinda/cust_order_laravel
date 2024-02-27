<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function collection()
    {
        return collect([$this->order]);
    }

    public function map($order): array
    {
        $data = [];

        

        // Products in the order
        foreach ($order->products as $product) {
            $data[] = [
                'Product Name' => $product->name,
                'Quantity' => $product->pivot->quantity,
                'Price' => $product->price,
                'Amount' => $product->pivot->quantity * $product->price,
            ];
        }

        // Total amount
        $data[] = [
            'Product Name' => '',
            'Quantity' => '',
            'Price' => 'Total:',
            'Amount' => $order->net_amount, 
        ];

        // Empty space
        $data[] = [
            'Product Name' => '',
            'Quantity' => '',
            'Price' => '',
            'Amount' => '', 
        ];

        // Order id and name
        $data[] = [
            'Product Name' => 'Order ID',
            'Quantity' => 'Customer Name',
            'Price' => 'Order Date',
            'Amount' => 'Order Time',
        ];

        // Order date and time
        $data[] = [
            'Product Name' => $order->id,
            'Quantity' => $order->customer->name,
            'Price' => $order->order_date,
            'Amount' => $order->order_time, 
        ];


        return $data;
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Quantity',
            'Price',
            'Amount',
        ];
    }
}
