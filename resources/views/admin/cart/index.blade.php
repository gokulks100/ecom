@extends('admin.layouts.app')
@section('title', 'Cart Items')
@push('style')

</style>
@endpush
@section('content')
    <div class="page-header">
        {{-- <h3 class="page-title">
            Role Management
        </h3> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Cart Items</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart Items</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="category_list">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Cart Items</h4>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    <div class="table-responsive">
                        <table class="table table-striped text-md-nowrap key-buttons" width="100%" id="cartTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Customer Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @include('admin.cart.js.datatable')
@endsection
