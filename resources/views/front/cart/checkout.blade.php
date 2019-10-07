@extends('front.layout.master')

@section('body')
    <!-- checkout page content area start -->
    <checkout-form
            :action="'{{ route('storeOrder') }}'"
            :initial-content="{{ app(\App\Shop\Carts\Repositories\CartRepository::class)->getWholeCart() }}"
            inline-template>
        <form method="post" @submit.prevent="onSubmit" :action="this.action">
            <div class="checkout-page-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @guest
                            <div class="notification-area"><!-- notification area -->
                                {{ __('Už ste u nás nakupovali?') }} <a href="{{ route('login') }}">{{ __('Prihláste sa!') }}</a>
                            </div><!-- //.notification area -->
                            @endguest
                            {{--<div class="notification-area"><!-- notification area -->--}}
                                {{--Have a coupon? <a href="#">Click here to enter your code</a>--}}
                            {{--</div><!-- //.notification area -->--}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                                <div class="left-content-area">
                                    <h3 class="title">{{ __('Fakturačné údaje') }}</h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-element" :class="{'has-danger': errors.has('customer_name'), 'has-success': this.fields.customer_name && this.fields.customer_name.valid }">
                                                    <label>{{ __('Meno') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.customer_name" type="text" class="input-field" placeholder="{{ __('Meno') }}...">
                                                    <div v-if="errors.has('customer_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_name') }}</div>
                                                </div>
                                                <div v-if="form.customer_company" class="form-element" :class="{'has-danger': errors.has('customer_ico'), 'has-success': this.fields.customer_ico && this.fields.customer_ico.valid }">
                                                    <label>{{ __('IČO') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.customer_ico" type="text" class="input-field" placeholder="{{ __('IČO') }}...">
                                                    <div v-if="errors.has('customer_ico')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_ico') }}</div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('billing_address_1'), 'has-success': this.fields.billing_address_1 && this.fields.billing_address_1.valid }">
                                                <label>{{ __('Adresa') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.billing_address_1" type="text" class="input-field" placeholder="{{ __('Adresa') }}...">
                                                    <div v-if="errors.has('billing_address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_1') }}</div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('billing_zip'), 'has-success': this.fields.billing_zip && this.fields.billing_zip.valid }">
                                                    <label>{{ __('PSĆ') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.billing_zip" type="text" class="input-field" placeholder="{{ __('Adresa') }}...">
                                                    <div v-if="errors.has('billing_zip')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_zip') }}</div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('billing_city'), 'has-success': this.fields.billing_city && this.fields.billing_city.valid }">
                                                <label>{{ __('Mesto') }}  <span class="base-color">**</span></label>
                                                    <input v-model="form.billing_city" type="text" class="input-field" placeholder="{{ __('Mesto') }}...">
                                                    <div v-if="errors.has('billing_city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_city') }}</div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('customer_phone'), 'has-success': this.fields.customer_phone && this.fields.customer_phone.valid }">
                                                <label>{{ __('Telefón') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.customer_phone" type="text" class="input-field" placeholder="{{ __('Telefón') }}...">
                                                    <div v-if="errors.has('billing_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_phone') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-element" :class="{'has-danger': errors.has('customer_company'), 'has-success': this.fields.customer_company && this.fields.customer_company.valid }">
                                                    <label>{{ __('Firma') }}</label>
                                                    <input v-model="form.customer_company" type="text" class="input-field" placeholder="{{ __('Firma') }}...">
                                                    <div v-if="errors.has('customer_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_company') }}</div>
                                                </div>
                                                <div v-if="form.customer_company" class="form-element" :class="{'has-danger': errors.has('customer_dic'), 'has-success': this.fields.customer_dic && this.fields.customer_dic.valid }">
                                                    <label>{{ __('DIČ') }} <span class="base-color">**</span></label>
                                                    <input v-model="form.customer_dic" type="text" class="input-field" placeholder="{{ __('DIČ') }}...">
                                                    <div v-if="errors.has('customer_dic')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_dic') }}</div>
                                                </div>
                                                <div class="form-element select has-icon">
                                                    <label>{{ __('Krajina') }} <span class="base-color">**</span></label>
                                                    <select v-model="form.billing_country" class="input-field select ">
                                                        <option disabled="disabled" value="0">{{ __('Vyberte krajinu') }}</option>

                                                        @foreach($countries as $country)

                                                        <option :value="{{ $country }}">{{ $country->name }}</option>

                                                        @endforeach

                                                    </select>
                                                    <div class="the-icon">
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('billing_address_2'), 'has-success': this.fields.billing_address_2 && this.fields.billing_address_2.valid }">
                                                <label class="blank"></label>
                                                    <input v-model="form.billing_address_2" type="text" class="input-field" placeholder="Address other...">
                                                    <div v-if="errors.has('billing_address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_2') }}</div>
                                                </div>
                                                <div class="form-element" :class="{'has-danger': errors.has('customer_email'), 'has-success': this.fields.customer_email && this.fields.customer_email.valid }">
                                                <label>{{ __('Email') }}<span class="base-color">**</span></label>
                                                    <input v-model="form.customer_email" type="email" class="input-field" placeholder="{{ __('Email') }}...">
                                                    <div v-if="errors.has('customer_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_email') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                @guest
                                                <div class="checkbox-element account">
                                                    <div class="checkbox-wrapper">
                                                        <label class="checkbox-inner">{{ __('Vytvoriť účet?') }}
                                                            <input type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                @endguest
                                                <div class="shipping-details"><!-- shipping details -->
                                                    <h3 class="title">{{ __('Dodacie údaje') }}</h3>
                                                    <div class="checkbox-element">
                                                        <div class="checkbox-wrapper">
                                                            <label class="checkbox-inner">{{ __('Rovnaké ako fakturačné') }}
                                                                <input v-model="form.same_addresses" type="checkbox" checked>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <template v-if="!form.same_addresses">
                                                        <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-element" :class="{'has-danger': errors.has('shipping_customer_name'), 'has-success': this.fields.shipping_customer_name && this.fields.shipping_customer_name.valid }">
                                                                <label>{{ __('Meno') }} <span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_customer_name" type="text" class="input-field" placeholder="{{ __('Meno') }}...">
                                                                <div v-if="errors.has('shipping_customer_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_name') }}</div>
                                                            </div>
                                                            <div v-if="form.shipping_customer_company" class="form-element" :class="{'has-danger': errors.has('shipping_customer_ico'), 'has-success': this.fields.shipping_customer_ico && this.fields.shipping_customer_ico.valid }">
                                                                <label>{{ __('IČO') }} <span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_customer_ico" type="text" class="input-field" placeholder="{{ __('IČO') }}...">
                                                                <div v-if="errors.has('shipping_customer_ico')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_ico') }}</div>
                                                            </div>
                                                            <div class="form-element" :class="{'has-danger': errors.has('billing_address_1'), 'has-success': this.fields.billing_address_1 && this.fields.billing_address_1.valid }">
                                                                <label>{{ __('Adresa') }} <span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_address_1" type="text" class="input-field" placeholder="{{ __('Adresa') }}...">
                                                                <div v-if="errors.has('billing_address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_1') }}</div>
                                                            </div>
                                                            <div class="form-element" :class="{'has-danger': errors.has('billing_city'), 'has-success': this.fields.billing_city && this.fields.billing_city.valid }">
                                                                <label>{{ __('Mesto') }}  <span class="base-color">**</span></label>
                                                                <input v-model="form.billing_city" type="text" class="input-field" placeholder="{{ __('Mesto') }}...">
                                                                <div v-if="errors.has('billing_city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_city') }}</div>
                                                            </div>
                                                            <div class="form-element" :class="{'has-danger': errors.has('shipping_phone'), 'has-success': this.fields.shipping_phone && this.fields.shipping_phone.valid }">
                                                                <label>{{ __('Telefón') }} <span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_phone" type="text" class="input-field" placeholder="{{ __('Telefón') }}...">
                                                                <div v-if="errors.has('shipping_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_phone') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-element" :class="{'has-danger': errors.has('shipping_customer_company'), 'has-success': this.fields.shipping_customer_company && this.fields.shipping_customer_company.valid }">
                                                                <label>{{ __('Firma') }}</label>
                                                                <input v-model="form.shipping_customer_company" type="text" class="input-field" placeholder="{{ __('Firma') }}...">
                                                                <div v-if="errors.has('shipping_customer_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_company') }}</div>
                                                            </div>
                                                            <div v-if="form.shipping_customer_company" class="form-element" :class="{'has-danger': errors.has('shipping_customer_dic'), 'has-success': this.fields.shipping_customer_dic && this.fields.shipping_customer_dic.valid }">
                                                                <label>{{ __('DIČ') }} <span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_customer_dic" type="text" class="input-field" placeholder="{{ __('DIČ') }}...">
                                                                <div v-if="errors.has('shipping_customer_dic')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_dic') }}</div>
                                                            </div>
                                                            <div class="form-element select has-icon">
                                                                <label>{{ __('Krajina') }} <span class="base-color">**</span></label>
                                                                <select v-model="form.shipping_country" class="input-field select ">
                                                                    <option disabled="disabled" value="0">{{ __('Vyberte krajinu') }}</option>

                                                                    @foreach($countries as $country)

                                                                        <option value="{{ $country }}">{{ $country->name }}</option>

                                                                    @endforeach

                                                                </select>
                                                                <div class="the-icon">
                                                                    <i class="fas fa-angle-down"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-element" :class="{'has-danger': errors.has('billing_address_2'), 'has-success': this.fields.billing_address_2 && this.fields.billing_address_2.valid }">
                                                                <label class="blank"></label>
                                                                <input v-model="form.billing_address_2" type="text" class="input-field" placeholder="Address other...">
                                                                <div v-if="errors.has('billing_address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_2') }}</div>
                                                            </div>
                                                            <div class="form-element" :class="{'has-danger': errors.has('shipping_customer_email'), 'has-success': this.fields.shipping_customer_email && this.fields.shipping_customer_email.valid }">
                                                                <label>{{ __('Email') }}<span class="base-color">**</span></label>
                                                                <input v-model="form.shipping_customer_email" type="email" class="input-field" placeholder="{{ __('Email') }}...">
                                                                <div v-if="errors.has('shipping_customer_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_email') }}</div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </template>
                                                    <div class="form-element textarea">
                                                        <label>{{ __('Poznámky') }}</label>
                                                        <textarea class="input-field textarea" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div><!-- //. shipping details -->
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-content-area">
                                <h3 class="title">{{ __('Vaša objednávka') }}</h3>
                                <ul class="order-list">
                                    <li>
                                        <div class="single-order-list heading">
                                            {{ __('Produkt') }} <span class="right">{{ __('Celkom') }}</span>
                                        </div>
                                    </li>
                                    <li v-for="(item, index) in content.cartItems" class="name">
                                        <div class="single-order-list">
                                            @{{ item.name }} 	× @{{ item.qty }} <span class="right">@{{ item.price }} €</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-order-list title-bold">
                                            {{ __('Produkty celkom') }} <span class="right normal">@{{ content.subtotal }} €</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-order-list title-bold">
                                            {{ __('Daň') }} <span class="right normal">@{{ content.tax }} €</span>
                                        </div>
                                    </li>
                                    <li class="shipping">
                                        <div class="single-order-list title-bold">
                                            {{ __('Poštovné') }}
                                            <span class="right normal">@{{ content.shippingFee }} €</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-order-list title-bold">
                                            {{ __('Celkom') }} <span class="right normal">@{{ totalWithShipping }} €</span>
                                        </div>
                                    </li>
                                </ul>
                                <h3> {{ __('Doručenie') }} </h3>
                                @foreach($couriers as $courier)
                                    <div class="credit-card-area">
                                        <div class="left-content">
                                            <div class="checkbox-element account">
                                                <div class="checkbox-wrapper">
                                                    <label class="checkbox-inner">{{ $courier->name }}
                                                        <input v-key="{{ $courier->id }}" @click="selectCourier({{ $courier }})" value="{{ $courier->id }}" v-model="selectedCouriers" name="courier" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-content">
                                            <ul>
                                                <strong>{{ $courier->price }} €</strong>
                                            </ul>
                                        </div>
                                    </div>
                                    <div v-if="form.courier.id === {{ $courier->id }}" class="notify-area">
                                        {{ $courier->description }}
                                        {{--VSETKO SA BUDE ROBIT NA BACKENDE--}}
                                    </div>
                                @endforeach
                                <h3> {{ __('Platba') }} </h3>

                                <template v-if="form.courier">
                                    <template v-for="paymentMethod in form.courier.payment_methods">
                                        <div class="credit-card-area">
                                            <div class="left-content">
                                                <div class="checkbox-element account">
                                                    <div class="checkbox-wrapper">
                                                        <label class="checkbox-inner">@{{ paymentMethod.title }}
                                                            <input v-key="paymentMethod.id" @click="selectPaymentMethod(paymentMethod)" v-model="paymentMethodCheck" :value="paymentMethod.id" name="paymentMethod" type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right-content">
                                                <ul>
                                                    <strong>@{{ paymentMethod.price }} €</strong>
                                                </ul>
                                            </div>
                                        </div>
                                        <div v-if="form.payment.id === paymentMethod.id" class="notify-area">
                                            @{{ paymentMethod.description }}
                                            {{--VSETKO SA BUDE ROBIT NA BACKENDE--}}
                                        </div>
                                    </template>
                                </template>

                                {{--<div class="credit-card-area">--}}
                                    {{--<div class="left-content">--}}
                                        {{--<div class="checkbox-element account">--}}
                                            {{--<div class="checkbox-wrapper">--}}
                                                {{--<label class="checkbox-inner">Credit Card (Stripe)--}}
                                                    {{--<input type="checkbox">--}}
                                                    {{--<span class="checkmark"></span>--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="right-content">--}}
                                        {{--<ul>--}}
                                            {{--sd;lcjv--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="checkbox-element account">
                                    <div class="checkbox-wrapper">
                                        <label class="checkbox-inner">{{ __('Súhlasím s ') }} <a href="#" class="base-color">{{ __('obchodnými podmienkami') }} *</a>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="submit-btn"> {{ __('Objednávka s povinnosťou platby') }} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </checkout-form>

    <!-- checkout page content area end -->
@endsection