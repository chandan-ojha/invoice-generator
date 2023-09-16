<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Inertia\Inertia;
use Illuminate\Http\Request;

class InvoiceGeneratorController extends Controller
{
    protected final function invoice_create_api(Request $request)
    {
        $input = json_decode($request->input('invoice'), true);

        // Create a new invoice record
        $invoice = new Invoice();
        $invoice->invoice_number = $input['invoice_number'];
        $invoice->sender = $input['sender'];
        $invoice->bill_to = $input['bill_to'];
        $invoice->ship_to = $input['ship_to'];
        $invoice->date = $input['date'];
        $invoice->due_date = $input['due_date'];
        $invoice->additional_note = $input['additional_note'];
        $invoice->notes = $input['notes'];
        $invoice->terms = $input['terms'];
        $invoice->sub_total = $input['sub_total'];
        $invoice->tax = $input['tax'];
        $invoice->total = $input['total'];
        $invoice->save();

        //create invoice items
        $items = $input['items'];
        foreach ($items as $item) {
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->description = $item['description'];
            $invoice_item->quantity = $item['quantity'];
            $invoice_item->rate = $item['rate'];
            $invoice_item->discount = $item['discount'];
            $invoice_item->amount = $item['amount'];
            $invoice_item->save();
        }

        return response()->json(['message' => 'Invoice created successfully'], 200);
    }

    protected final function invoice_create(Request $request)
    {
        $input = json_decode($request->input('invoice'), true);

        // Create a new invoice record
        $invoice = new Invoice();
        $invoice->invoice_number = $input['invoice_number'] ;
        $invoice->sender = $input['sender'];
        $invoice->bill_to = $input['bill_to'];
        $invoice->ship_to = $input['ship_to'];
        $invoice->date = $input['date'];
        $invoice->due_date = $input['due_date'];
        $invoice->additional_note = $input['additional_note'];
        $invoice->notes = $input['notes'];
        $invoice->terms = $input['terms'];
        $invoice->sub_total = $input['sub_total'];
        $invoice->tax = $input['tax'];
        $invoice->total = $input['total'];
        $invoice->save();

        //create invoice items
        $items = $input['items'];
        foreach ($items as $item) {
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->description = $item['description'];
            $invoice_item->quantity = $item['quantity'];
            $invoice_item->rate = $item['rate'];
            $invoice_item->discount = $item['discount'];
            $invoice_item->amount = $item['amount'];
            $invoice_item->save();
        }

        return redirect()->back();

    }

}
