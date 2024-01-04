@extends('layouts.app')
@section('title', 'Edit Category')

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
                                <span class="text-violet-600 ml-1 md:ml-2 text-sm font-medium dark:text-violet-600">Edit
                                    Category</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="">
                <div
                    class="font-bold relative block w-full rounded bg-violet-200 p-4 text-base leading-5 text-black opacity-70">
                    Edit Categories
                </div>
            </div>

            <div class="px-2 py-5">
                <div class="flex">
                    <!-- Author: FormBold Team -->
                    <!-- Learn More: https://formbold.com -->
                    <div class="w-full max-w-[550px]">
                        <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-5">
                                <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Category
                                </label>
                                <input type="text" name="title" id="title" placeholder="Type category title"
                                    value="{{ old('title',$category->title) }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md @error('title') border border-red-600 @enderror" />

                                @error('title')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="photo" class="mb-1 block text-base font-medium text-[#07074D]">
                                    Category Photo
                                </label>
                                <p class="mb-2 text-xs text-slate-500">Recommend Size 400 * 200</p>
                                <input type="file" name="photo" id="photo"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md  @error('photo') border border-red-600 @enderror" />
                                @error('photo')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="status" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Status
                                </label>
                                <input type="checkbox" name="status"
                                    class="form-checkbox rounded text-violet-600 me-1" {{ $category->status == "1" ? 'checked' : '' }}>
                                    <span class="text-sm">Publish</span>
                            </div>

                            <div class="text-end">
                                <button id="cancel"
                                    class="hover:shadow-form rounded-md  py-2 px-8 text-base font-semibold text-violet-600 outline-none">
                                    Cancel
                                </button>

                                <button
                                    class="hover:shadow-form rounded-md bg-[#6A64F1] py-2 px-8 text-base font-semibold text-white outline-none">
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
