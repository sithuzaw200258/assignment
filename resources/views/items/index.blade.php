@extends('layouts.app')
@section('title', 'Items')

@section('content')
    <div class="flex">
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>

        <div class="px-5 w-full bg-white">
            <h5 class="text-violet-600 mt-3">Items List</h5>
            <div class="text-end mb-5">
                <a href="{{ route('items.create') }}"
                    class="px-3 md:px-4 py-1 md:py-2 bg-violet-600 border border-vibg-violet-600 text-white rounded-lg hover:bg-violet-700">
                    <i class="fa-solid fa-plus"></i>
                    Add Items
                </a>
            </div>

            <div class="table">
                <table id="datatable" class="display w-full my-5 shadow">
                    <thead>
                        <tr class="bg-violet-600 text-white">
                            <th>Action</th>
                            <th>No</th>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Owner</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        var table = new DataTable('#datatable', {
            searching: false,
            ajax: "{{ route('items.datatable.ssd') }}",
            processing: true,
            serverSide: true,
            columns: [
                {
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'excerpt',
                    name: 'excerpt'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'owner_id',
                    name: 'owner_id'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
        });

        $(document).on('click', '#delete-btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let link = "/items/" + id;
            // alert(link);
            deleteBox(table,link);
        })

    </script>
@endpush
