<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceGeneratorController extends Controller
{
    protected final function invoice_create()
    {
        $invoice = new Invoice();
        $invoice->invoice_number = $this->invoice_number();
        $invoice->sender = $this->sender();
        $invoice->bill_to = $this->bill_to();
        $invoice->ship_to = $this->ship_to();
        $invoice->date = $this->date();
        $invoice->due_date = $this->due_date();
        $invoice->additional_note = $this->additional_note();
        $invoice->notes = $this->notes();
        $invoice->terms = $this->terms();
        $invoice->sub_total = $this->sub_total();
        $invoice->tax = $this->tax();
        $invoice->total = $this->total();
        $invoice_items = new InvoiceItem();
        $invoice_items->description = $this->description();
        $invoice_items->quantity = $this->quantity();
        $invoice_items->rate = $this->rate();
        $invoice_items->discount = $this->discount();
        $invoice_items->amount = $this->amount();
        $invoice_items->save();
        $invoice->save();

    }

}
