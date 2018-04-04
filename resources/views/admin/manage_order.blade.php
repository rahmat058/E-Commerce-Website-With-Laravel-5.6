@extends('admin_layout')
@section('admin_content')


<ul class="breadcrumb">
  <li>
    <i class="icon-home"></i>
    <a href="index.html">Home</a>
    <i class="icon-angle-right"></i>
  </li>
  <li><a href="#">Order Details</a></li>
</ul>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Total</th>
            <th>Order Status</th>
            <th>Actions</th>
          </tr>
        </thead>

      @foreach($all_order_info as $allOrder)
        <tbody>
        <tr>
          <td>{{$allOrder->order_id}}</td>
          <td class="center">{{$allOrder->customer_name}}</td>
          <td class="center">{{$allOrder->order_total}}</td>
          <td class="center">{{$allOrder->order_status}}</td>

          <td class="center">
            @if($allOrder)
            <a class="btn btn-danger"         href="{{URL::to('/unactive-order/'.$allOrder->order_id)}}">
              <i class="halflings-icon white thumbs-down"></i>
            </a>
            @elseif($allOrder)
            <a class="btn btn-success" href="{{URL::to('/active-order/'.$allOrder->order_id)}}">
              <i class="halflings-icon white thumbs-up"></i>
            </a>
            @endif
            <a class="btn btn-info" href="{{URL::to('/view-order/'.$allOrder->order_id)}}">
              <i class="halflings-icon white edit"></i>
            </a>
            <a class="btn btn-danger" id="delete" href="{{URL::to('/delete-order/'.$allOrder->order_id)}}">
              <i class="halflings-icon white trash"></i>
            </a>
          </td>
        </tr>
        </tbody>
     @endforeach

      </table>
    </div>
  </div><!--/span-->

</div><!--/row-->


@endsection
