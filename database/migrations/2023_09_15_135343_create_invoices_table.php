<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->string('sender');
            $table->string('bill_to');
            $table->string('ship_to');
            $table->string('date');
            $table->string('due_date');
            $table->string('additional_note');
            $table->string('notes');
            $table->string('terms');
            $table->double('sub_total',8,2);
            $table->integer('tax');
            $table->double('total',8,2);
            $table->bigInteger('invoice_item_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('invoice_item_id')->references('id')->on('invoice_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
