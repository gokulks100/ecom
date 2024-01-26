@extends('layouts.app')

@push('styles')
    <style>
        .ui-w-40 {
            width: 300px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
        }

        .text-dark {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0" id="cartTable">
                        <thead>
                            <tr>
                                <!-- Set columns width -->
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#"
                                        class="shop-tooltip float-none text-light" title=""
                                        data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center">
                                            @if (isset($cart->product->images[0]->url))
                                                <img src="/images/{{ $cart->product->images[0]->url }}"
                                                    class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                            @endif
                                            <div class="media-body">
                                                <a href="#"
                                                    class="d-block text-dark">{{ $cart->product->name ?? '' }}</a>
                                                <small>
                                                    <span class="tex-muted">{{ $cart->product->description }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4 ">
                                        {{ $cart->product->price }}</td>
                                    <td class="align-middle p-4"><input type="text" id="quantity{{ $i }}"
                                            onchange="addQuantity({{ $cart->product->price }},{{ $i }})"
                                            class="form-control text-center " value="1"></td>
                                    <td class="text-right font-weight-semibold align-middle p-4"
                                        id="oneProductPrice{{ $i }}" class="productPrice">
                                        {{ $cart->product->price }}</td>
                                    <td class="text-center align-middle px-0">
                                        <a href="#" onclick="deleteCart({{ $cart->id }})"
                                            class="shop-tooltip close float-none text-danger" title=""
                                            data-original-title="Remove">×</a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-end align-items-center pb-4">
                    <div class="d-flex">
                        <div class="text-right mt-4" style="padding-right: 40px;">
                            <label class="text-muted font-weight-normal m-0">Total price</label>
                            <div class="text-large"><strong id="totalPrice"></strong></div>
                        </div>
                    </div>
                </div>

                <div class="float-right">
                    <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to shopping</button>
                    <button type="button" class="btn btn-lg btn-primary mt-2">Checkout</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            calculateTotalPrice();
        });

        function calculateTotalPrice() {
            var total = 0;
            const table = $("#cartTable");
            table.find('tbody tr').each(function () {
                var amount = parseFloat($(this).find('td.productPrice').text());
                total += isNaN(amount) ? 0 : amount;
            });
            $("#totalPrice").text(total);
            // return total;
        }

        function addQuantity(price, i) {
            const quantity = $("#quantity" + i).val();
            const priceperproduct = price * quantity;
            $("#oneProductPrice" + i).text(priceperproduct + ".00");
            calculateTotalPrice();
        }

        function deleteCart(id) {
            $.ajax({
                url: "{{ route('delete.cartitem') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    if (data.success == false) {
                        notify("warning", "data not found!");
                    }
                    location.reload();
                },
                error: function(data) {
                    notify('warning', 'try again !');
                }
            });
        }
    </script>
@endsection
