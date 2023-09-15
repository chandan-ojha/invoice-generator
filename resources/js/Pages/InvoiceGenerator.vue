<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
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
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
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
                        <textarea name="" id="" cols="30" rows="2"></textarea>
                        <div class="flex space-x-2">
                            <div class="flex flex-col">
                                <span>Bill to</span>
                                <textarea
                                    name=""
                                    id=""
                                    cols="30"
                                    rows="2"
                                ></textarea>
                            </div>
                            <div class="flex flex-col">
                                <span>Ship to</span>
                                <textarea
                                    name=""
                                    id=""
                                    cols="30"
                                    rows="2"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-1/2 items-end">
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
                        <h1 class="mt-12 text-4xl uppercase text-right mb-5">
                            Invoice
                        </h1>
                        <input
                            class="w-[200px] text-right"
                            type="text"
                            placeholder="Invoice Number"
                        />
                        <div class="mt-10 flex-y-5 text-right space-y-3 w-full">
                            <p>
                                <span>Date</span>
                                <input class="ml-2 w-[200px]" />
                            </p>
                            <p>
                                <span>Due Date</span>
                                <input class="ml-2 w-[200px]" />
                            </p>
                            <p>
                                <span>Additional Note</span>
                                <input class="ml-2 w-[200px]" type="text" />
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
                        <tr>
                            <td class="py-1">
                                <input
                                    class="w-full pl-5"
                                    type="text"
                                    placeholder="Description"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Quantity"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Rate"
                                />
                            </td>
                            <td class="">
                                <input
                                    class="w-full"
                                    type="number"
                                    placeholder="Discount"
                                />
                            </td>
                            <td class="py-1 pr-5 text-right text-gray-800">
                                $ 0.00
                            </td>
                            <td class="py-1 pr-5 text-right text-gray-800">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-gray-500 cursor-pointer"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
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
                            ></textarea>
                            <span>Terms</span>
                            <textarea
                                name=""
                                id=""
                                cols="30"
                                rows="2"
                            ></textarea>
                        </div>
                        <div class="flex flex-col w-1/2 items-end">
                            <div
                                class="mt-10 flex-y-5 text-right space-y-3 w-full"
                            >
                                <p>
                                    <span>Subtotal</span>
                                    <input
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
                                    />
                                </p>
                                <p>
                                    <span>Total</span>
                                    <input
                                        readonly
                                        class="focus:ring-0 focus:ring-offset-0 text-right ml-2 pr-4 w-[200px] border-0"
                                        placeholder="Total"
                                    />
                                </p>
                                <p>
                                    <span>Balace Due</span>
                                    <input
                                        readonly
                                        class="focus:ring-0 focus:ring-offset-0 text-right ml-2 pr-4 w-[200px] border-0"
                                        placeholder="Balance"
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
