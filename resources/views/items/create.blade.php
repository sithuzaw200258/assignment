@extends('layouts.app')
@section('title', 'Add Category')

@section('content')
    <div class="flex">
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>

        <div class="px-5 w-full bg-white">
            <div class="breadcrumb">
                <!-- Breadcrumb -->
                <nav class="flex text-gray-700 py-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="text-sm text-gray-700 hover:text-gray-900 inline-flex items-center dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                <a href="{{ route('dashboard') }}" class="text-sm">Home</a>
                            </a>
                        </li>

                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-violet-600 ml-1 md:ml-2 text-sm font-medium dark:text-violet-600">Add
                                    Items</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="">
                <div
                    class="font-bold relative block w-full rounded bg-violet-200 p-4 text-base leading-5 text-black opacity-70">
                    Add Items
                </div>
            </div>

            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-10 my-5 mx-1">
                    {{-- Item Info --}}
                    <div class="">
                        <div class="mb-5">
                            <label for="name" class="mb-1 block text-base font-medium text-[#07074D]">
                                Item Name
                            </label>
                            <input type="text" name="name" id="name" placeholder="Type item name"
                                value="{{ old('name') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md @error('name') border border-red-600 @enderror" />

                            @error('name')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="category" class="mb-1 block text-base font-medium text-[#07074D]">
                                Selected Category
                            </label>
                            <select name="category"
                                class="peer h-full w-full rounded-[7px] bg-white py-3 px-6  text-base font-medium text-[#6B7280] transition-all  outline-none focus:border-[#6A64F1] focus:shadow-md  disabled:border-0 disabled:bg-blue-gray-50  @error('category') border border-red-600 @enderror">
                                {{-- <option>Select Category</option> --}}
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category') ? 'selected' : '' }}>{{ $category->title }}
                                    </option>
                                @empty
                                    <option value="0">No Category</option>
                                @endforelse
                            </select>
                            @error('category')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="price" class="mb-1 block text-base font-medium text-[#07074D]">
                                Price
                            </label>
                            <input type="number" value="{{ old('price') }}" name="price" id="price"
                                placeholder="Enter Price" value="{{ old('price') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md @error('price') border border-red-600 @enderror" />

                            @error('price')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="description" class="mb-1 block text-base font-medium text-[#07074D]">
                                Description
                            </label>
                            <textarea id="description" rows="6" name="description"
                                class="block py-2.5 px-6 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('description') border border-red-600 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="condition" class="mb-1 block text-base font-medium text-[#07074D]">
                                Selected Item Condition
                            </label>
                            <select name="condition"
                                class="peer h-full w-full rounded-[7px] bg-white py-3 px-6  text-base font-medium text-[#6B7280] outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 outline-none focus:border-[#6A64F1] focus:shadow-md  disabled:border-0 disabled:bg-blue-gray-50  @error('condition') border border-red-600 @enderror">
                                <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Used</option>
                                <option value="good second hand"
                                    {{ old('condition') == 'good second hand' ? 'selected' : '' }}>Good Second Hand
                                </option>
                            </select>
                            @error('condition')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="type" class="mb-1 block text-base font-medium text-[#07074D]">
                                Selected Item Type
                            </label>
                            <select name="type"
                                class="peer h-full w-full rounded-[7px] bg-white py-3 px-6  text-base font-medium text-[#6B7280] outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 outline-none focus:border-[#6A64F1] focus:shadow-md  disabled:border-0 disabled:bg-blue-gray-50  @error('type') border border-red-600 @enderror">
                                <option value="sell" {{ old('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                                <option value="buy" {{ old('type') == 'buy' ? 'selected' : '' }}>Buy</option>
                                <option value="exchange" {{ old('type') == 'exchange' ? 'selected' : '' }}>Exchange
                                </option>
                            </select>
                            @error('type')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="status" class="mb-0 block text-base font-medium text-[#07074D]">
                                Status
                            </label>
                            <input type="checkbox" name="status" class="form-checkbox rounded text-violet-600 me-1"><span
                                class="text-sm">Publish</span>
                        </div>

                        <div class="mb-5">
                            <label for="photo" class="mb-0 block text-base font-medium text-[#07074D]">
                                Item Photo
                            </label>
                            <p class="mb-2 text-xs text-slate-500">Recommend Size 400 * 200</p>
                            <input type="file" name="photo" id="photo"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md  @error('photo') border border-red-600 @enderror" />
                            @error('photo')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Owner Info --}}
                    <div class="">
                        <div class="mb-5">
                            <label for="owner_name" class="mb-1 block text-base font-medium text-[#07074D]">
                                Owner Name
                            </label>
                            <input type="text" value="{{ old('owner_name') }}" name="owner_name" id="owner_name"
                                placeholder="Type Owner Name" value="{{ old('owner_name') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md @error('owner_name') border border-red-600 @enderror" />

                            @error('owner_name')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="phone" class="mb-1 block text-base font-medium text-[#07074D]">
                                Contact Number
                            </label>
                            <div class="flex">
                                <div
                                    class="w-16 flex items-center justify-center bg-blue-lighter border-t border-l border-b border-blue-lighter rounded-l text-blue-dark">
                                    +95</div>
                                <input type="text" value="{{ old('phone') }}" placeholder="Enter Phone Number"
                                    name="phone"
                                    class="w-full py-3 px-6 text-base rounded-r border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md @error('phone') border border-red-600 @enderror" />
                            </div>

                            @error('phone')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="address" class="mb-1 block text-base font-medium text-[#07074D]">
                                Address
                            </label>
                            <textarea id="address" rows="4" name="address"
                                class="address block py-2.5 px-6 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('address') border border-red-600 @enderror"
                                placeholder="Enter Address...">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <div id="map"></div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('items.index') }}"
                                class="hover:shadow-form rounded-md  py-2 px-8 text-base font-semibold text-violet-600 outline-none">
                                Cancel
                            </a>

                            <button
                                class="hover:shadow-form rounded-md bg-[#6A64F1] py-2 px-8 text-base font-semibold text-white outline-none">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

    <script type="module">
        ClassicEditor
            .create(document.querySelector('#description'), {
                placeholder: 'Enter Description'
            })
            .catch(error => {
                console.error(error);
            });
            
        var map = L.map('map').setView([16.8409, 96.1735], 12);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([16.8409, 96.1735]).addTo(map);

        var circle = L.circle([16.8409, 96.1735], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);


        googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        L.Control.geocoder().addTo(map);
    </script>
@endpush
