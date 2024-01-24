@extends('admin.layouts.app')
@section('title', 'Product Management')
@section('style')
@endsection
@section('content')
    <div class="page-header">
        {{-- <h3 class="page-title">
            Role Management
        </h3> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Service Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Management</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="service_list">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Service Management</h4>
                        <button type="button" class="btn btn-success btn-fw" onclick="addServiceForm(0)"><i class="mdi mdi-plus"></i>Add</button>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    <div class="table-responsive">
                        <table class="table table-striped text-md-nowrap key-buttons" width="100%" id="serviceTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle Name</th>
                                    <th>Min Members</th>
                                    <th>Max Members</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Description</th>
                                    <th>Updated By</th>
                                    <th>Updated At</th>
                                    <th>Status</th>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body d-none" id="service_form" style="padding-top:2em;">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title heading">Add Service</h4>
                        <button type="button" id="back" class="btn btn-success btn-fw d-none"
                            onclick="addServiceForm(1)"><i class="mdi mdi-arrow-left"></i>Back</button>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    {{-- @include('admin.pages.service.addservice') --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- @include('admin.pages.service.js.datatable')
    @include('admin.pages.service.js.script') --}}
@endsection
