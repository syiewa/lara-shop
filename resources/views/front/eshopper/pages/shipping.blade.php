@extends('front/eshopper/layouts/index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('css')
@section('main')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <!--        <div class="step-one">
                    <h2 class="heading">Step1</h2>
                </div>
                <div class="checkout-options">
                    <h3>New User</h3>
                    <p>Checkout options</p>
                    <ul class="nav">
                        <li>
                            <label><input type="checkbox"> Register Account</label>
                        </li>
                        <li>
                            <label><input type="checkbox"> Guest Checkout</label>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-times"></i>Cancel</a>
                        </li>
                    </ul>-->
    </div><!--/checkout-options-->

    <div class="register-req">
        <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
        <div class="row">
            <!--                <div class="col-sm-3">
                                <div class="shopper-info">
                                    <p>Shopper Information</p>
                                    <form>
                                        <input type="text" placeholder="Display Name">
                                        <input type="text" placeholder="User Name">
                                        <input type="password" placeholder="Password">
                                        <input type="password" placeholder="Confirm password">
                                    </form>
                                    <a class="btn btn-primary" href="">Get Quotes</a>
                                    <a class="btn btn-primary" href="">Continue</a>
                                </div>
                            </div>-->
            <div class="col-sm-7 clearfix">
                <div class="bill-to">
                    <p>Bill To</p>
                    <div class="form-one">
                        <form>
                            <input type="text" placeholder="Email*" value="{{$user->email}}">
                            <input type="text" placeholder="Name" value="{{$user->name}}">
                            <textarea placeholder="Address 1 *"></textarea>
                        </form>
                    </div>
                    <div class="form-two">
                        <form>
                            <input type="text" placeholder="Zip / Postal Code *">
                            <select>
                                <option>-- Country --</option>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            <select>
                                <option>-- State / Province / Region --</option>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            <input type="text" placeholder="Phone *">
                            <input type="text" placeholder="Mobile Phone">
                            <input type="text" placeholder="Fax">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="order-message">
                    <p>Shipping Order</p>
                    <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                    <label><input type="checkbox"> Shipping to bill address</label>
                </div>	
            </div>					
        </div>
    </div>
</section> <!--/#cart_items-->
@stop