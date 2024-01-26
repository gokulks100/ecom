@extends('admin.layouts.app')
@section('title', 'Stock Management')
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
                <li class="breadcrumb-item"><a href="#">Stock Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stock Management</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="category_list">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Stock Management</h4>
                    </div>
                    <div class="mt-3 mb-4 border-bottom"></div>
                    <div class="table-responsive">
                        <table class="table table-striped text-md-nowrap key-buttons" width="100%" id="stockTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Stock</th>
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
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="stockModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Stock</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" id="updateStock">
                @csrf
                <input type="hidden" id="id" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name"> Stock <span class="required">*</span></label>
                            <input type="text" class="form-control numberValidation" id="count" name="count" placeholder="count">
                        </div>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="stockButton" onclick="updateStock(event)">Update Stock</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('script')
    @include('admin.stock.js.datatable')
    @include('admin.stock.js.script')
@endsection
