<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { defineProps, reactive } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const invoice = reactive({
    invoice_number: "",
    sender: "",
    bill_to: "",
    ship_to: "",
    date: "",
    due_date: "",
    additional_note: "",
    items: [
        {
            description: "",
            quantity: "",
            rate: "",
            discount: "",
            amount: "",
        },
    ],
    notes: "",
    terms: "",
    sub_total: "",
    tax: "",
    total: "",
});

//sub total
function getSubTotal() {
    let subTotal = 0;
    invoice.items.forEach((item) => {
        subTotal += item.amount;
    });
    invoice.sub_total = subTotal;
    return subTotal;
}

//total
function getTotal() {
    const tax = (invoice.sub_total * invoice.tax) / 100;
    const total = invoice.sub_total + tax;
    invoice.total = total;
    return total;
}

//add item
function addMoreItem() {
    invoice.items.push({
        description: "",
        quantity: "",
        rate: "",
        discount: "",
        amount: "",
    });
}

//delete item
function deleteItem(index) {
    invoice.items.splice(index, 1);
}

//save  invoice to database
function saveInvoice() {
    const data = {
        invoice_number: invoice.invoice_number,
        sender: invoice.sender,
        bill_to: invoice.bill_to,
        ship_to: invoice.ship_to,
        date: invoice.date,
        due_date: invoice.due_date,
        additional_note: invoice.additional_note,
        items: invoice.items,
        notes: invoice.notes,
        terms: invoice.terms,
        sub_total: invoice.sub_total,
        tax: invoice.tax,
        total: invoice.total,
    };
    router.post(route("invoice.create"), { invoice: JSON.stringify(data) });
    clearInvoice();
}

function clearInvoice() {
    invoice.invoice_number = "";
    invoice.sender = "";
    invoice.bill_to = "";
    invoice.ship_to = "";
    invoice.date = "";
    invoice.due_date = "";
    invoice.additional_note = "";
    invoice.items = [
        {
            description: "",
            quantity: "",
            rate: "",
            discount: "",
            amount: "",
        },
    ];
    invoice.notes = "";
    invoice.terms = "";
    invoice.sub_total = "";
    invoice.tax = "";
    invoice.total = "";
}
</script>

<template>
    <Head title="Invoice Generator" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div
            v-if="canLogin"
            class="sm:fixed sm:top-0 sm:right-0 p-6 text-right"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register
                </Link>
            </template>
        </div>
        <div class="p-16 text-gray-600">
            <section
                class="mx-auto container bg-white border border-gray-400 min-h-screen p-12"
            >
                <div class="flex justify-between">
                    <div class="flex flex-col space-y-5 w-1/2s">
                        <div class=" ">
                            <img
                                class="w-40"
                                src="https://www.shutterstock.com/image-vector/invoice-typographic-stamp-sign-badge-600w-1027820257.jpg"
                                alt=""
                            />
                        </div>
                        <p class="mt-5">Sender</p>
                        <textarea
                            name=""
                            id=""
                            cols="30"
                            rows="2"
                            v-model="invoice.sender"
                        ></textarea>
                        <div class="flex space-x-2">
                            <div class="flex flex-col">
                                <span>Bill to</span>
                                <textarea
                                    name=""
                                    id=""
                                    cols="30"
                                    rows="2"
                                    v-model="invoice.bill_to"
                                ></textarea>
                            </div>
                            <div class="flex flex-col">
                                <span>Ship to</span>
                                <textarea
                                    name=""
                                    id=""
                                    cols="30"
                                    rows="2"
                                    v-model="invoice.ship_to"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-1/2 items-end">
                        <div class="space-x-1.5">
                            <button
                                onclick="window.print()"
                                class="bg-gray-800 text-white px-3 py-1 rounded-md"
                                type="button"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 inline-block mr-2"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3 2a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 100-2H4V3a1 1 0 00-1-1zm5 5a1 1 0 011 1v6a1 1 0 11-2 0V8a1 1 0 011-1zm5 0a1 1 0 011 1v6a1 1 0 11-2 0V8a1 1 0 011-1z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Print
                            </button>

                            <button
                                class="bg-gray-800 text-white px-3 py-1 rounded-md"
                                type="button"
                                @click="saveInvoice()"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 inline-block mr-2"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7l-4-4H5zm2 0h6l3 3v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm1 5a1 1 0 100 2h4a1 1 0 100-2H8z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Save
                            </button>
                        </div>

                        <h1 class="mt-12 text-4xl uppercase text-right mb-5">
                            Invoice
                        </h1>
                        <input
                            class="w-[200px] text-right"
                            type="text"
                            placeholder="Invoice Number"
                            v-model="invoice.invoice_number"
                        />
                        <div class="mt-10 flex-y-5 text-right space-y-3 w-full">
                            <p>
                                <span>Date</span>
                                <input
                                    class="ml-2 w-[200px]"
                                    v-model="invoice.date"
                                />
                            </p>
                            <p>
                                <span>Due Date</span>
                                <input
                                    class="ml-2 w-[200px]"
                                    v-model="invoice.due_date"
                                />
                            </p>
                            <p>
                                <span>Additional Note</span>
                                <input
                                    class="ml-2 w-[200px]"
                                    type="text"
                                    v-model="invoice.additional_note"
                                />
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-20">
                    <table class="table-auto w-full">
                        <tr class="bg-gray-800 text-left text-white">
                            <th class="p-2 pl-5 w-1/2">Item</th>
                            <th class="p-2">Quantity</th>
                            <th class="p-2">Rate</th>
                            <th class="p-2">Discount</th>
                            <th class="p-2 w-[200px] text-right pr-5">
                                Amount
                            </th>
                            <th class="p-2">Action</th>
                        </tr>
                        <tr v-for="(item, index) in invoice.items" :key="index">
                            <td class="py-1">
                                <input
                                    class="w-full pl-5"
                                    type="text"
                                    placeholder="Description"
                                    v-model="item.description"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Quantity"
                                    v-model="item.quantity"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Rate"
                                    v-model="item.rate"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Discount"
                                    v-model="item.discount"
                                />
                            </td>
                            <td class="py-1 pr-5 text-right text-gray-800">
                                $
                                {{
                                    (item.amount =
                                        item.quantity * item.rate -
                                        item.discount)
                                }}
                            </td>
                            <td class="py-1 pr-5 text-right text-gray-800">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-gray-500 cursor-pointer"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    @click="deleteItem(index)"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </td>
                        </tr>
                    </table>
                    <button
                        @click="addMoreItem()"
                        class="mt-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Add More
                    </button>
                </div>
                <div class="mt-[200px]">
                    <div class="flex justify-between">
                        <div class="flex flex-col space-y-5 w-1/2">
                            <span>Notes</span>
                            <textarea
                                name=""
                                id=""
                                cols="30"
                                rows="2"
                                v-model="invoice.notes"
                            ></textarea>
                            <span>Terms</span>
                            <textarea
                                name=""
                                id=""
                                cols="30"
                                rows="2"
                                v-model="invoice.terms"
                            ></textarea>
                        </div>
                        <div class="flex flex-col w-1/2 items-end">
                            <div
                                class="mt-10 flex-y-5 text-right space-y-3 w-full"
                            >
                                <p>
                                    <span>Subtotal</span>
                                    <input
                                        :value="getSubTotal()"
                                        readonly
                                        class="focus:ring-0 focus:ring-offset-0 text-right ml-2 pr-4 w-[200px] border-0"
                                        placeholder="Subtotal"
                                    />
                                </p>
                                <p>
                                    <span>Tax</span>
                                    <input
                                        type="number"
                                        class="tax text-right w-[200px] ml-2"
                                        placeholder="Tax"
                                        v-model="invoice.tax"
                                    />
                                </p>
                                <p>
                                    <span>Total</span>
                                    <input
                                        :value="getTotal()"
                                        readonly
                                        class="focus:ring-0 focus:ring-offset-0 text-right ml-2 pr-4 w-[200px] border-0"
                                        placeholder="Total"
                                    />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<style>
input,
input,
textarea {
    border: 1px solid #ddd !important;
    padding: 5px;
    border-radius: 5px;
}
</style>
