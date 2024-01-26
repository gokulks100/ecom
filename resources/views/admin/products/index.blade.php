@extends('admin.layouts.app')
@section('title', 'Product Management')
@push('style')
<style>
    .hide {
        display: none !important;
    }

    .multiImage .upload__box .upload__img-wrap
    {
        display: flex;
        gap:30px;
    }

    .select2-container {
        width: 400px !important;
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        margin-top: 23px;
        margin-left: -69px;
    }

    .select2-container--open .select2-dropdown--below {
        width: 400px !important;
        border-top: none;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        margin-left: 69px;
        margin-top: -24px;
    }

    .upload__img-close {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.5) url(../images/remove.svg) center no-repeat;
        background-size: 14px;
        position: absolute;
        transform: translate(50%, -50%);
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
        margin-top: 24px;
        margin-left: -149px;
    }
    .upload__img-close:hover {
        background: red url("../images/remove.svg") center no-repeat;
        background-size: 14px;
    }
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
