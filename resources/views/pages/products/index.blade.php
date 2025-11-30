<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 gap-8">

                    <div>
                        <form method="GET" action="{{ route('products.index') }}" class="flex justify-between items-center">
                            @csrf
                            <div class="grid gap-6 mb-6 md:grid-cols-2 w-full">
                                <div>
                                    <label for="search" class="block mb-2.5 text-sm font-medium text-heading">Pencarian</label>
                                    <input type="text" id="search" name="search" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." required />
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Cari</button>
                                <button data-modal-target="popup-modal-create" data-modal-toggle="popup-modal-create" type="button" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Tambah</button>
                            </div>
                        </form>

                        <div id="popup-modal-create" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                        <button type="button" class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-create">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>

                                    <div class="p-4 md:p-5 w-full">

                                        <form method="POST" action="{{ route('products.store') }}" class="gap-2 w-full">
                                            @csrf
                                            <div class="grid gap-6 mb-6  w-full">
                                                <div>
                                                    <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
                                                    <input type="text" id="title" name="title" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." required />
                                                </div>

                                                <div>
                                                    <label for="description" class="block mb-2.5 text-sm font-medium text-heading">Description</label>
                                                    <input type="text" id="description" name="description" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." required />
                                                </div>

                                                <div>
                                                    <label for="price" class="block mb-2.5 text-sm font-medium text-heading">Price</label>
                                                    <input type="number" id="price" name="price" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." required />
                                                </div>
                                            </div>
                                            <div class="flex gap-2 justify-end">
                                                <button data-modal-hide="popup-modal" type="button" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                <button type="submit" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Looping Data Products --}}
                                @foreach ($products as $i => $item)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ ($i+1)+(($products->currentPage()-1)*$products->count())  }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp. {{ number_format($item->price) }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2">

                                            {{-- Edit --}}
                                            <div>
                                                <button data-modal-target="popup-modal-edit-{{ $i }}" data-modal-toggle="popup-modal-edit-{{ $i }}" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1" type="button">
                                                Edit
                                                </button>

                                                <div id="popup-modal-edit-{{ $i }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                                                <button type="button" class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-edit-{{ $i }}">
                                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>

                                                            <div class="p-4 md:p-5">
                                                                <form method="POST" action="{{ route('products.update', $item->id) }}" class="gap-2 w-full">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="grid gap-6 mb-6  w-full">
                                                                        <div>
                                                                            <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
                                                                            <input type="text" id="title" name="title" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." value="{{ $item->title }}" required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="description" class="block mb-2.5 text-sm font-medium text-heading">Description</label>
                                                                            <input type="text" id="description" name="description" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." value="{{ $item->description }}" required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="price" class="block mb-2.5 text-sm font-medium text-heading">Price</label>
                                                                            <input type="number" id="price" name="price" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-1 shadow-xs placeholder:text-body" placeholder="Pencarian ..." value="{{ $item->price }}" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex gap-2 justify-end">
                                                                        <button data-modal-hide="popup-modal" type="button" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                                        <button type="submit" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Hapus --}}
                                            <div>
                                                <button data-modal-target="popup-modal-delete-{{ $i }}" data-modal-toggle="popup-modal-delete-{{ $i }}" class="text-white bg-red-500 hover:bg-gray-600 rounded px-3 py-1" type="button">
                                                Hapus
                                                </button>

                                                <div id="popup-modal-delete-{{ $i }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/60">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6 ">
                                                                <button type="button" class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-delete-{{ $i }}">
                                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>

                                                            <div class="p-4 md:p-5 text-center">
                                                                <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                                <h3 class="mb-6 text-body">Are you sure you want to delete this product from your account?</h3>

                                                                <form method="POST" action="{{ route('products.destroy', $item->id) }}" class="gap-2 w-full">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <div class="flex gap-2 justify-end">
                                                                        <button data-modal-hide="popup-modal" type="button" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Batal</button>
                                                                        <button type="submit" class="text-white bg-gray-900 hover:bg-gray-600 rounded px-3 py-1">Simpan</button>
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
                        {{ $products->onEachSide(0)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
