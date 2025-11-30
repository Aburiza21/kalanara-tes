<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded shadow p-4">
                <form method="POST" action="{{ route('transactionitems.store') }}"
                    class="w-full flex items-end justify-between">
                    @csrf
                    <div class="flex gap-6">

                        <div>
                            <label for="title"
                                class="block mb-2.5 text-sm font-medium text-heading">Invoice</label>
                            <input type="number" id="invoice" name="invoice"
                                class="w-full px-3 py-1 shadow-xs"
                                placeholder="Pencarian ..." value="{{ $transaction->invoice ?? '' }}" />
                        </div>
                        <div>
                            <label for="title"
                                class="block mb-2.5 text-sm font-medium text-heading">Produk</label>
                            <select name="product" id="product"
                                class="w-full px-3 py-1 shadow-xs">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ Str::limit($product->title, 50, '...') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="quantity"
                                class="block mb-2.5 text-sm font-medium text-heading">Jumlah</label>
                            <input type="number" id="quantity" name="quantity"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                placeholder="Pencarian ..." required />
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Tambah</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-4">
                <form method="POST" action="{{ route('transactionitems.store') }}"
                    class="w-full">
                    @csrf
                    {{-- <div class="flex gap-6">

                        <div>
                            <label for="title"
                                class="block mb-2.5 text-sm font-medium text-heading">Invoice</label>
                            <input type="number" id="invoice" name="invoice"
                                class="w-full px-3 py-1 shadow-xs"
                                placeholder="Pencarian ..." value="{{ $transaction->invoice ?? '' }}" />
                        </div>
                    </div> --}}
                    <div class="mt-6">
                        @foreach ($transaction->items as $transaction_item)
                            <div class="flex gap-2 w-full">
                                <div>
                                    <label for="title"
                                        class="block mb-2.5 text-sm font-medium text-heading">Produk</label>
                                    <select name="product" id="product"
                                        class="w-full px-3 py-1 shadow-xs">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if ($product->id == $transaction_item->product_id)
                                                selected
                                            @endif>
                                                {{ Str::limit($product->title, 50, '...') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="quantity"
                                        class="block mb-2.5 text-sm font-medium text-heading">Price</label>
                                    <input type="number" id="quantity" name="quantity"
                                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                        placeholder="Pencarian ..." value="{{ $transaction_item->price }}" readonly required />
                                </div>

                                <div>
                                    <label for="quantity"
                                        class="block mb-2.5 text-sm font-medium text-heading">Quantity</label>
                                    <input type="number" id="quantity" name="quantity"
                                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                        placeholder="Pencarian ..." value="{{ $transaction_item->quantity }}" readonly required />
                                </div>

                                <div>
                                    <label for="quantity"
                                        class="block mb-2.5 text-sm font-medium text-heading">Amout</label>
                                    <input type="number" id="quantity" name="quantity"
                                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                        placeholder="Pencarian ..." value="{{ $transaction_item->price*$transaction_item->quantity }}" readonly required />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-end">
                        <h1 class="text-2xl">
                            {{ $transaction->total }}
                        </h1>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 gap-8">

                    <div>
                        <form method="GET" action="{{ route('transactions.index') }}"
                            class="flex justify-between items-center">
                            @csrf
                            <div class="grid gap-6 mb-6 md:grid-cols-2 w-full">
                                <div>
                                    <label for="search"
                                        class="block mb-2.5 text-sm font-medium text-heading">Pencarian</label>
                                    <input type="text" id="search" name="search"
                                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                        placeholder="Pencarian ..." required />
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit"
                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Cari</button>
                                <button data-modal-target="popup-modal-create" data-modal-toggle="popup-modal-create"
                                    type="button"
                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Tambah</button>
                            </div>
                        </form>

                        <div id="popup-modal-create" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="popup-modal-create">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>

                                    <div class="p-4 md:p-5 w-full">

                                        <form method="POST"
                                            action="{{ route('transactions.store') }}"
                                            class="gap-2 w-full">
                                            @method('POST')
                                            @csrf
                                            <div class="flex gap-2 justify-end">
                                                <button data-modal-hide="popup-modal"
                                                    type="button"
                                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                <button type="submit"
                                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead
                                class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Invoice
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Item
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Total
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Pay
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Result
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Looping Data transactions --}}
                                @foreach ($transactions as $i => $item)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $i + 1 + ($transactions->currentPage() - 1) * $transactions->count() }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->invoice }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->items->count() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->total }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->pay }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->return }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2">

                                            <div>
                                                <button data-modal-target="popup-modal-item-{{ $i }}"
                                                    data-modal-toggle="popup-modal-item-{{ $i }}"
                                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1"
                                                    type="button">
                                                    Item
                                                </button>

                                                <div id="popup-modal-item-{{ $i }}" tabindex="-1"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                                                    <div class="relative p-4 w-full max-w-7xl max-h-full">
                                                        <div
                                                            class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                                            <button type="button"
                                                                class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                                                data-modal-hide="popup-modal-item-{{ $i }}">
                                                                <svg class="w-5 h-5" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>

                                                            <div class="p-4 md:p-5 space-y-6">
                                                                @foreach ($item->items as $transaction_item)
                                                                    <div class="flex gap-2 w-full">
                                                                        <div>
                                                                            <label for="title"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Produk</label>
                                                                            <select name="product" id="product"
                                                                                class="w-full px-3 py-1 shadow-xs">
                                                                                @foreach ($products as $product)
                                                                                    <option value="{{ $product->id }}" @if ($product->id == $transaction_item->product_id)
                                                                                        selected
                                                                                    @endif>
                                                                                        {{ Str::limit($product->title, 50, '...') }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div>
                                                                            <label for="quantity"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Price</label>
                                                                            <input type="number" id="quantity" name="quantity"
                                                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                                                                placeholder="Pencarian ..." value="{{ $transaction_item->price }}" readonly required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="quantity"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Quantity</label>
                                                                            <input type="number" id="quantity" name="quantity"
                                                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                                                                placeholder="Pencarian ..." value="{{ $transaction_item->quantity }}" readonly required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="quantity"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Amout</label>
                                                                            <input type="number" id="quantity" name="quantity"
                                                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                                                                placeholder="Pencarian ..." value="{{ $transaction_item->price*$transaction_item->quantity }}" readonly required />
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Edit --}}
                                            <div>
                                                <button data-modal-target="popup-modal-edit-{{ $i }}"
                                                    data-modal-toggle="popup-modal-edit-{{ $i }}"
                                                    class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1"
                                                    type="button">
                                                    Pay
                                                </button>

                                                <div id="popup-modal-edit-{{ $i }}" tabindex="-1"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div
                                                            class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                                            <button type="button"
                                                                class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                                                data-modal-hide="popup-modal-edit-{{ $i }}">
                                                                <svg class="w-5 h-5" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>

                                                            <div class="p-4 md:p-5">
                                                                <form method="POST"
                                                                    action="{{ route('transactions.update', $item->id) }}"
                                                                    class="gap-2 w-full">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="grid gap-6 mb-6  w-full">
                                                                        <div>
                                                                            <label for="title"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Total</label>
                                                                            <input type="text" id="title"
                                                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                                                                placeholder="Pencarian ..."
                                                                                value="{{ $item->total }}"
                                                                                readonly
                                                                                required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="pay"
                                                                                class="block mb-2.5 text-sm font-medium text-heading">Bayar</label>
                                                                            <input type="text" id="pay"
                                                                                name="pay"
                                                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body"
                                                                                placeholder="Pencarian ..."
                                                                                value="{{ $item->pay }}"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex gap-2 justify-end">
                                                                        <button data-modal-hide="popup-modal"
                                                                            type="button"
                                                                            class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                                        <button type="submit"
                                                                            class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Hapus --}}
                                            <div>
                                                <button data-modal-target="popup-modal-delete-{{ $i }}"
                                                    data-modal-toggle="popup-modal-delete-{{ $i }}"
                                                    class="text-white bg-red-500 hover:bg-gray-600 rounded px-3 py-1"
                                                    type="button">
                                                    Hapus
                                                </button>

                                                <div id="popup-modal-delete-{{ $i }}" tabindex="-1"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div
                                                            class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                                            <button type="button"
                                                                class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                                                data-modal-hide="popup-modal-delete-{{ $i }}">
                                                                <svg class="w-5 h-5" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>

                                                            <div class="p-4 md:p-5 text-center">
                                                                <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                                <h3 class="mb-6 text-body">Are you sure you want to
                                                                    delete this product from your account?</h3>

                                                                <form method="POST"
                                                                    action="{{ route('transactions.destroy', $item->id) }}"
                                                                    class="gap-2 w-full">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <div class="flex gap-2 justify-end">
                                                                        <button data-modal-hide="popup-modal"
                                                                            type="button"
                                                                            class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                                        <button type="submit"
                                                                            class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Link --}}
                    <div class="mt-4">
                        {{ $transactions->onEachSide(0)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
