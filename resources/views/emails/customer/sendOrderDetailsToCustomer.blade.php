@extends('emails.layouts.master')

@section('content')

    <div class="block">
        <table width="100%" bgcolor="white" cellpadding="0" cellspacing="0" border="0" >
            <tbody>
            <tr>
                <td>
                    <table bgcolor="white" width="1000" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" modulebg="edit">
                        <tbody>
                        <!-- Space -->
                        <!-- Space -->
                        <tr>
                            <td>
                                <table width="600" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                    <tbody>
                                    <!-- Title -->
                                    <tr>
                                        <td style="font-family: Verdana; text-align:center;line-height: auto;" st-title="fulltext-title">
                                            <h1 style="font-size:24px;font-weight:bold;color:#424242;">{{ __('Potvrdenie objednávky') }}</h1>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td height="15"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: Verdana; text-align:center;line-height: auto;" st-title="fulltext-title">
                                            <h2>{{ __('Dobrý deň,') }} {{$order->customer_name}}!</h2>
                                            @php($country = \App\Shop\Countries\Country::find($order->shipping_country))
                                            <p>{{ __('posielame Vám rekapituláciu Vašej objednávky:') }} <br /></p>
                                            <p>{{ __('Adresa') }}: {{$order->shipping_address_1}} @if($order->shipping_address_2){{$order->shipping_address_2}}@endif {{$order->shipping_city}} {{$order->shipping_zip}}, {{$country->name}}</p>
                                            <br>
                                            @isset($payment->instructions)
                                                <h2>{{ __('Priebeh platby:') }}</h2>
                                                <p>{!! $payment->instructions !!}</p>
                                            @endisset
                                            <br>
                                            <table class="table table-striped data" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <thead>
                                                <tr>
                                                    <th class="col-md-2">{{ __('SKU') }}</th>
                                                    <th class="col-md-2">{{ __('Názov') }}</th>
                                                    <th class="col-md-3">{{ __('Popis') }}</th>
                                                    <th class="col-md-1">{{ __('Množstvo') }}</th>
                                                    <th class="col-md-4 text-right">{{ __('Cena') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product->product_sku}}</td>
                                                        <td>{{$product->product_name}}</td>
                                                        <td>
                                                            {{$product->product_description}}
                                                            @php($pattr = \App\Shop\ProductAttributes\ProductAttribute::find($product->product_attribute_id))
                                                            @if(!is_null($pattr))<br>
                                                            @foreach($product->productAttributes as $it)
                                                                <p class="label label-primary">{{ $it->attributesValues()->first()->value }}</p>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{$product->quantity}}</td>
                                                        <td class="text-right">{{config('cart.currency')}} {{number_format($product->product_price * $product->quantity, 2)}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $payment->title }}</td>
                                                    <td>{{ $payment->description }}</td>
                                                    <td></td>
                                                    <td>{{ $payment->price }}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $courier->name }}</td>
                                                    <td>{{ $courier->description }}</td>
                                                    <td></td>
                                                    <td>{{ $courier->price }}</td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ __('Produkty') }}:</td>
                                                    <td class="text-right">{{config('cart.currency')}} {{number_format($order->total_products, 2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ __('Doručenie') }}:</td>
                                                    <td class="text-right">{{config('cart.currency')}} {{number_format($payment->price + $courier->price, 2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ __('Daň') }}:</td>
                                                    <td class="text-right">{{config('cart.currency')}} {{number_format($order->tax, 2)}}</td>
                                                </tr>
                                                <tr class="bg-warning">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>{{ __('Celkom') }}:</strong></td>
                                                    <td class="text-right"><strong>{{config('cart.currency')}} {{number_format($order->total, 2)}}</strong></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15"></td>
                                    </tr>
                                    <!-- Space -->
                                    </tbody>
                                </table>
                                @isset($payment->instructions)
                                    <h2>{{ __('Priebeh platby:') }}</h2>
                                    <p>{!! $payment->instructions !!}</p>
                                @endisset
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection