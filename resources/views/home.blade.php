@extends('layouts.app')

@push('styles')
    <style>
        .mt-100 {
            margin-top: 100px;
        }

        .card {
            border-radius: 7px !important;
            border-color: #e1e7ec;
        }

        .mb-30 {
            margin-bottom: 30px !important;
        }

        .card-img-tiles {
            display: block;
            border-bottom: 1px solid #e1e7ec;
        }

        a {
            color: #0da9ef;
            text-decoration: none !important;
        }

        .card-img-tiles>.inner {
            display: table;
            width: 100%;
        }

        .card-img-tiles .main-img,
        .card-img-tiles .thumblist {
            display: table-cell;
            width: 65%;
            padding: 15px;
            vertical-align: middle;
        }

        .card-img-tiles .main-img>img:last-child,
        .card-img-tiles .thumblist>img:last-child {
            margin-bottom: 0;
        }

        .card-img-tiles .main-img>img,
        .card-img-tiles .thumblist>img {
            display: block;
            width: 100%;
            margin-bottom: 6px;
        }

        .thumblist {
            width: 35%;
            border-left: 1px solid #e1e7ec !important;
            display: table-cell;
            width: 65%;
            padding: 15px;
            vertical-align: middle;
        }



        .card-img-tiles .thumblist>img {
            display: block;
            width: 100%;
            margin-bottom: 6px;
        }

        .btn-group-sm>.btn,
        .btn-sm {
            padding: .45rem .5rem !important;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }

        .filter {
            margin-bottom: 30px;
        }

        .category {
            margin-top: 20px;
            border: 1px solid lightgreen;
            border-radius: 5px;
            padding: 10px 46px;
        }

        .apply-btn {
            margin-left: 20px;
            padding: 10px 19px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
        }

        .pagination li {
            margin: 0 5px;
            display: inline-block;
        }

        .pagination a {
            color: #3490dc;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid #3490dc;
            border-radius: 0.25rem;
        }

        .pagination a:hover {
            background-color: #3490dc;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-100">
        @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
         @endif
        <div class="filter">
            <form action="{{ route('home') }}" method="GET">
                <label for="category">Filter by Category:</label><br>
                <select name="category" id="category" class="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-success apply-btn" type="submit">Apply Filter</button>
            </form>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
                            <div class="inner">
                                <div class="main-img"><img src="/images/{{ $product->images[0]->url ?? '' }}"
                                        alt="Category"></div>
                                <div class="thumblist">
                                    @foreach ($product->images as $image)
                                        <img src="/images/{{ $image->url }}" alt="Category">
                                    @endforeach
                                </div>
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p class="text-muted">Price {{ $product->price }}</p>
                            <div>
                                {{-- <a
                                    class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Products</a> --}}
                                <form action="{{ route('addcart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Add to cart</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}

        </div>
    </div>
@endsection
