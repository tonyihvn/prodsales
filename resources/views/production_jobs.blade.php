@extends('layouts.theme')

@section('content')
    @php $modal="production_jobs"; $pagename = "production_jobs"; @endphp

    <h3 class="page-title">Production Jobs | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#productionjob">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Batch No.</th>
                                <th>Product Name</th>
                                <th>Target Quantity</th>
                                <th>Date Started</th>
                                <th>Date Ended</th>
                                <th>Status</th>
                                <th>Estimated Cost</th>
                                <th>Staff in Charge</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productionjobs as $pjobs)

                                <tr>
                                    <td><b>{{$pjobs->batchno}}</b></td>
                                    <td><b>{{$pjobs->product->name}}</b></td>
                                    <td><b>{{$pjobs->target_quantity}}</b></td>
                                    <td>{{$pjobs->dated_started}}</td>
                                    <td>{{$pjobs->dated_ended}}</td>
                                    <td>{{$pjobs->status}}</td>
                                    <td>{{$pjobs->estimated_cost_of_production}}</td>
                                    <td>{{$pjobs->user->name}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$pjobs->id}}" onclick="productionjob({{$pjobs->id}})"  data-toggle="modal" data-target="#productionjob" data-batchno="{{$pjobs->batchno}}"  data-product_id="{{$pjobs->product_id}}" data-staff_incharge="{{$pjobs->staff_incharge}}" data-target_quantity="{{$pjobs->target_quantity}}" data-dated_started="{{$pjobs->dated_started}}"  data-dated_ended="{{$pjobs->dated_ended}}"  data-status="{{$pjobs->status}}"  data-details="{{$pjobs->details}}"  data-estimated_cost_of_production="{{$pjobs->estimated_cost_of_production}}" data-setting_id="{{$pjobs->setting_id}}">Edit</button>
                                        <a href="/delete-pjob/{{$pjobs->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the Production record : {{$pjobs->product->name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$productionjobs->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="productionjob">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Production Job</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addproduction') }}" id="materialform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="product_id">Product Name</label>
                        <select class="form-control" name="product_id" id="product_id">
                            @foreach ($settings->products as $pro)
                                <option value="{{$pro->id}}">{{$pro->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="staff_incharge">Staff In Charge</label>
                        <select class="form-control" name="staff_incharge" id="staff_incharge">
                            @foreach ($settings->personnel as $sta)
                                <option value="{{$sta->id}}">{{$sta->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="target_quantity">Target Quantity</label>
                        <input type="number" step="0.01" name="target_quantity" id="target_quantity" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dated_started">Start Date</label>
                        <input type="text" name="dated_started" id="dated_started" class="form-control datepicker">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dated_ended">End Date</label>
                        <input type="text" name="dated_ended" id="dated_ended" class="form-control datepicker">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                          <option value="Not Started">Not Started</option>
                          <option value="In Progress">In Progress</option>
                          <option value="Completed">Completed</option>
                          <option value="Terminated">Terminated</option>
                          <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="estimated_cost_of_production">Estimated Cost of Production</label>
                        <input type="number" step="0.01" name="estimated_cost_of_production" id="estimated_cost_of_production" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="batchno">Batch Number</label>
                        <input type="text" name="batchno" id="batchno" class="form-control">
                    </div>

                    <div class="form-group col-md-6">

                        <label for="setting_id" class="control-label">Facility / Location</label>
                        <select class="form-control" name="setting_id" id="setting_id">
                            <option value="1" selected>Select Location</option>
                            @foreach ($userbusinesses as $set)
                                <option value="{{$set->id}}">{{$set->business_name}}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="pjobbutton">
                        {{ __('Add Production Job') }}
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
