@extends('layouts.theme')

@section('content')
    @php $pagetype="reports"; @endphp

    <h3 class="page-title">Material Damagess | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#materialdamages">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Material Name</th>
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
                            @foreach ($material_damages as $mat)

                                <tr>

                                    <td><a href="{{url('/material/'.$mat->id)}}"><b>{{$mat->material->name}}</b></td>
                                    <td><b>{{$mat->batchno}}/{{$mat->invoiceno}}</b></td>
                                    <td>{{$mat->reason}}</td>
                                    <td>{{$mat->quantity}}</td>
                                    <td>{{$mat->damagedby!='' ? $mat->damagedby->name : 'N/A'}}</td>
                                    <td>{{$mat->dated}}</td>
                                    <td>{{$mat->settings->business_name}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$mat->id}}" onclick="materialdamages({{$mat->id}})"  data-toggle="modal" data-target="#materialdamages" data-material_id="{{$mat->material_id}}" data-name="{{$mat->material->name}}" data-invoiceno="{{$mat->invoiceno}}" data-batchno="{{$mat->batchno}}" data-reason="{{$mat->reason}}"  data-quantity="{{$mat->quantity}}"  data-dated="{{$mat->dated}}"  data-damaged_by="{{$mat->damaged_by}}"  data-setting_id="{{$mat->setting_id}}">Edit</button>
                                        <a href="{{url('/delete-dmat/'.$mat->id)}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the damaged material : {{$mat->material->name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$material_damages->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->

  <!-- The Modal -->
  <div class="modal" id="materialdamages">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Damaged Material</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('adddmaterial') }}" id="dmaterialform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="material_id">Material Name</label>
                        <select class="form-control" name="material_id" required>
                            @foreach ($settings->materials as $sma)
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

                        <select class="form-control" name="setting_id" id="setting_id">
                            <option value="1" selected>Select Location</option>
                            @foreach ($userbusinesses as $set)
                                <option value="{{$set->id}}">{{$set->business_name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="dmatbutton">
                        {{ __('Save Damaged Material') }}
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
