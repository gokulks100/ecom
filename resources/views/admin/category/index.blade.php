@extends('admin.layouts.app')
@section('title', 'Product Management')
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
                <li class="breadcrumb-item"><a href="#">Category Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category Management</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="product_list">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Category Management</h4>
                        <button type="button" class="btn btn-success btn-fw" onclick="addProductForm(0)"><i class="mdi mdi-plus"></i>Add</button>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    <div class="table-responsive">
                        <table class="table table-striped text-md-nowrap key-buttons" width="100%" id="categoryTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Decription</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
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
                <div class="card-body d-none" id="product_form" style="padding-top:2em;">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title heading">Add Product</h4>
                        <button type="button" id="back" class="btn btn-success btn-fw d-none"
                            onclick="addProductForm(1)"><i class="mdi mdi-arrow-left"></i>Back</button>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    @include('admin.category.addcategory')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @include('admin.category.js.datatable')
    @include('admin.category.js.script')
@endsection
