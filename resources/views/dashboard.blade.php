{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="flex ">
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>

        <div class="p-9 w-full bg-white h-screen">
            <h1 class="font-bold">Welcome To Dashboard >>></h1>
        </div>
    </div>

@endsection
