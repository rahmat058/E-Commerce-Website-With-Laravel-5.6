@extends('admin_layout')
@section('admin_content')


<ul class="breadcrumb">
  <li>
    <i class="icon-home"></i>
    <a href="index.html">Home</a>
    <i class="icon-angle-right"></i>
  </li>
  <li><a href="#">All Slider</a></li>
</ul>

<p class="alert-success">
    <?php
        $message = Session::get('message');
        if($message)
        {
          echo $message;
          Session::put('message', NULL);
        }
    ?>
</p>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="halflings-icon user"></i><span class="break"></span>All Slider</h2>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>Slider ID</th>
            <th>Slider Image</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

      @foreach($all_slider_info as $allSlider)
        <tbody>
        <tr>
          <td>{{$allSlider->slider_id}}</td>
          <td class="center">
            <img src="{{URL::to($allSlider->slider_image)}}" style="height:80px; width:250px;">
          </td>
          <td class="center">
            @if($allSlider->publication_status ==1)
            <span class="label label-success">Active</span>
            @else
            <span class="label label-danger">Unactive</span>
            @endif
          </td>
          <td class="center">
            @if($allSlider->publication_status ==1)
            <a class="btn btn-danger"         href="{{URL::to('/unactive-slider/'.$allSlider->slider_id)}}">
              <i class="halflings-icon white thumbs-down"></i>
            </a>
            @elseif($allSlider->publication_status ==0)
            <a class="btn btn-success" href="{{URL::to('/active-slider/'.$allSlider->slider_id)}}">
              <i class="halflings-icon white thumbs-up"></i>
            </a>
            @endif
            <a class="btn btn-danger" id="delete" href="{{URL::to('/delete-slider/'.$allSlider->slider_id)}}">
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
