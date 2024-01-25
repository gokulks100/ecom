@extends('admin.layouts.app')
@section('title', 'Product Management')
@push('style')
<style>
    .hide {
        display: none !important;
    }

.mutiPhotoInput{
        border: 1px solid #ededed;
        align-items: center;
/*        padding: 0px 7px ;*/
    }

.mutiPhotoInput .form-control {
        border: 0 !important;
        padding: 14px 20px !important;
}
     /* padding-right: px; */

</style>
@endpush
@section('content')
    <div class="page-header">
        {{-- <h3 class="page-title">
            Role Management
        </h3> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Management</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="product_list">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Product Management</h4>
                        <button type="button" class="btn btn-success btn-fw" onclick="addProductForm(0)"><i class="mdi mdi-plus"></i>Add</button>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    <div class="table-responsive">
                        <table class="table table-striped text-md-nowrap key-buttons" width="100%" id="productTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Description</th>
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
                    @include('admin.products.addproduct')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @include('admin.products.js.datatable')
    @include('admin.products.js.script')
@endsection
