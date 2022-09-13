@extends('layouts.theme')

@section('content')
    @php $pagetype="reports"; @endphp

    <h3 class="page-title">Product Damagess | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#productdamages">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Product Name</th>
                                <th>Batch/Invoice</th>
                                <th>Reason</th>
                                <th>Quantity</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Facility</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_damages as $prd)

                                <tr>

                                    <td><a href="{{url('/product/'.$prd->product_id)}}"><b>{{$prd->product->name}}</b></td>
                                    <td><b>{{$prd->batchno}}/{{$prd->invoiceno}}</b></td>
                                    <td>{{$prd->reason}}</td>
                                    <td>{{$prd->quantity}}</td>
                                    <td>{{$prd->damagedby!='' ? $prd->damagedby->name : 'N/A'}}</td>
                                    <td>{{$prd->dated}}</td>
                                    <td>{{$prd->settings->business_name}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$prd->id}}" onclick="productDamages({{$prd->id}})"  data-toggle="modal" data-target="#productdamages" data-product_id="{{$prd->product_id}}" data-product_name="{{$prd->product->product_name}}" data-invoiceno="{{$prd->invoiceno}}" data-batchno="{{$prd->batchno}}" data-reason="{{$prd->reason}}"  data-quantity="{{$prd->quantity}}"  data-dated="{{$prd->dated}}"  data-damaged_by="{{$prd->damaged_by}}"  data-setting_id="{{$prd->setting_id}}">Edit</button>
                                        <a href="{{url('/delete-dprd/'.$prd->id)}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the damaged product : {{$prd->product->name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$product_damages->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->

  <!-- The Modal -->
  <div class="modal" id="productdamages">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Record New Damaged product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('adddproduct') }}" id="dproductform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="product_id">product Name</label>
                        <select class="form-control" name="product_id" required>
                            @foreach ($settings->products as $sma)
                                <option value="{{$sma->id}}" data-units="{{$sma->measurement_unit}}">{{$sma->name}}</option>
                            @endforeach

                        </select>                    </div>

                    <div class="form-group col-md-3">
                        <label for="invoiceno">Invoice No (for supplied goods)</label>
                        <input type="text" name="invoiceno" id="invoiceno" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="batchno">Batch No (for produced goods)</label>
                        <input type="text" name="batchno" id="batchno" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="reason">Reason for Damage</label>
                        <input type="text" name="reason" id="reason" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" step="0.01" name="quantity" id="quantity" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="dated">Date of Damage</label>
                        <input type="text" name="dated" id="dated" class="form-control datepicker">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="damaged_by">Damaged by / Staff Concerned</label>
                        <select class="form-control" name="damaged_by" id="damaged_by">
                            @foreach ($settings->personnel as $ssp)
                                <option value="{{$ssp->id}}">{{$ssp->name}}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group col-md-4">

                        <label for="setting_id" class="control-label">Facility/Location</label>
                        <select class="form-control" name="setting_id" id="setting_id">
                            @foreach ($userbusinesses as $set)
                                <option value="{{$set->id}}">{{$set->business_name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="dprdbutton">
                        {{ __('Save Damaged product') }}
                    </button>
                </div>


            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger modaldismiss" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


@endsection
