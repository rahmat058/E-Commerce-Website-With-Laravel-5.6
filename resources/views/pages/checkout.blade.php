@extends('layout')
@section('content')


<section id="cart_items">
  <div class="container">

    <div class="register-req">
      <p>Please Fill Up This Form....</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
      <div class="row">
        <div class="col-sm-9 clearfix">
          <div class="bill-to">
            <p>Bill To</p>
            <div class="form-one">
              <form>
                <input type="text" placeholder="Email*">
                <input type="text" placeholder="First Name *">
                <input type="text" placeholder="Last Name *">
                <input type="text" placeholder="Address *">
                <input type="text" placeholder="Mobile Number *">
                <input type="text" placeholder="City *">
                <input type="submit" class="btn btn-default" value="Done">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="review-payment">
      <h2>Review & Payment</h2>
    </div>
  </div>
</section> <!--/#cart_items-->



@endsection
