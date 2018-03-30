@extends('admin_layout')
@section('admin_content')


<ul class="breadcrumb">
  <li>
    <i class="icon-home"></i>
    <a href="index.html">Home</a>
    <i class="icon-angle-right"></i>
  </li>
  <li>
    <i class="icon-edit"></i>
    <a href="#">Update Product</a>
  </li>
</ul>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
    </div>

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

    <div class="box-content">
      <form class="form-horizontal" action="{{url('/update-product', $edit_product_info->product_id)}}" method="post">

         {{ csrf_field() }}

        <fieldset>
        <div class="control-group">
          <label class="control-label" for="date01">Product Name</label>
          <div class="controls">
          <input type="text" class="input-xlarge" name="product_name" value="{{$edit_product_info->product_name}}">
          </div>
        </div>
        <div class="control-group hidden-phone">
          <label class="control-label" for="textarea2">Product Short Description</label>
          <div class="controls">
          <textarea class="cleditor" name="product_short_description" rows="3">
            {{$edit_product_info->product_short_description}}
          </textarea>
          </div>
        </div>
        <div class="control-group hidden-phone">
          <label class="control-label" for="textarea2">Product Long Description</label>
          <div class="controls">
          <textarea class="cleditor" name="product_long_description" rows="3">
            {{$edit_product_info->product_long_description}}
          </textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="date01">Product Price</label>
          <div class="controls">
          <input type="text" class="input-xlarge" name="product_price" value="{{$edit_product_info->product_price}}">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="date01">Product Size</label>
          <div class="controls">
          <input type="text" class="input-xlarge" name="product_size" value="{{$edit_product_info->product_size}}">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="date01">Product Color</label>
          <div class="controls">
          <input type="text" class="input-xlarge" name="product_color" value="{{$edit_product_info->product_color}}">
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
        </fieldset>
      </form>

    </div>
  </div><!--/span-->

</div><!--/row-->


@endsection