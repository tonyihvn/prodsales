@extends('layouts.theme')

@section('content')
    @php $modal="material"; $pagename = "materials"; @endphp

    <h3 class="page-title">Material Checkouts | <small style="color: green">for Production</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#materialcheckout">Collect Materials</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Material Name</th>
                                <th>Production Batch No.</th>
                                <th>Quantity</th>
                                <th>Details</th>
                                <th>Checked Out By</th>
                                <th>Approved By</th>
                                <th>Date</th>
                                <th>Location/Facility</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mcheckouts as $mtc)

                                <tr>
                                    <td>{{$mtc->material->name}}</td>
                                    <td><b>{{$mtc->production_batch}}</b></td>
                                    <td><b>{{$mtc->quantity}}{{$mtc->material->measurement_unit}}</b></td>
                                    <td>{{$mtc->details}}</td>
                                    <td>{{$mtc->checkoutby->name}}</td>
                                    <td>{{$mtc->approvedby->name}}</td>
                                    <td>{{$mtc->dated}}</td>
                                    <td>{{$mtc->settings->business_name}}</td>

                                    <td>

                                        <button class="label label-primary" id="ach{{$mtc->id}}" onclick="materialcheckout({{$mtc->id}})"  data-toggle="modal" data-target="#materialcheckout"  data-material_name="{{$mtc->material->name}}" data-material_id="{{$mtc->material_id}}" data-production_batch="{{$mtc->production_batch}}" data-quantity="{{$mtc->quantity}}" data-details="{{$mtc->details}}"  data-checkout_by="{{$mtc->checkout_by}}"  data-approved_by="{{$mtc->approved_by}}" data-dated="{{$mtc->dated}}" data-setting_id="{{$mtc->setting_id}}">Edit</button>
                                        <a href="/delete-mtc/{{$mtc->id}}/{{$mtc->material_id}}/{{$mtc->quantity}}" class="label label-danger" onclick="return confirm('Are you sure you want to delete the material checkout record, this will return the {{$mtc->material->name}} with quantity {{$mtc->quantity}} back to stock?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$mcheckouts->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="materialcheckout">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Material Checkout</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addmcheckout') }}" id="materialchekoutform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row" id="forcheckout">
                    <div class="form-goup col-md-6">
                        <label for="material_id">
                            Material Name: <span id="material_named"></span>
                        </label>
                        <input type="hidden" name="material_id" id="material_id" readonly>

                    </div>
                    <div class="form-goup col-md-6">
                        <label for="quantity">
                            Quantity
                        </label>
                        <input type="hidden" name="quantity" id="quantity" readonly>
                    </div>
                </div>

                <table class="table" id="materiallist">
                    <thead>
                        <tr class="spechead">
                            <th class="form-group">Material NAme</th>
                            <th class="form-group">Quantity</th>
                            <th class="form-group">Unit</th>
                            <th class="form-group">.</th>
                        </tr>
                    </thead>
                    <tbody id="item_list">

                        <tr id="1">
                            <td class="form-group">
                                <select class="form-control mid" name="mid[]" required>
                                    @foreach ($settings->materials as $sma)
                                        <option value="{{$sma->id}}" data-units="{{$sma->measurement_unit}}">{{$sma->name}}</option>
                                    @endforeach

                                </select>
                            </td>
                            <td class="form-group">
                                <input type="number" name="qty[]" class="form-control" required><span></span>
                            </td>
                            <td class="unit">
                                <span></span>
                            </td>
                            <td class="form-group">
                                <a href="#" class="btn btn-sm btn-danger removeitem" id="re1">Remove<i class="lnr lnr-remove"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <a class="btn btn-sm btn-primary add_item" href="#" id="1">
                    Add Material
                    <i class="lnr lnr-add"></i>
                </a>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="dated">Checkout Date</label>
                        <input type="text" name="dated" id="dated" class="form-control datepicker">
                    </div>

                    <div class="form-group col-md-8">
                        <label for="details">Details</label>
                        <input type="text" name="details" id="details" class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="production_batch">Production Batch No.</label>
                        <select class="form-control" name="production_batch" id="production_batch">
                            @foreach ($settings->jobs as $pjs)
                                <option value="{{$pjs->batchno}}">{{$pjs->batchno}}</option>
                            @endforeach

                        </select>
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

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="checkout_by">Checked Out By</label>
                        <select class="form-control" name="checkout_by" id="checkout_by">
                            @foreach ($settings->personnel as $ssp)
                                <option value="{{$ssp->id}}">{{$ssp->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="approved_by">Approved By</label>
                        <select class="form-control" name="approved_by" id="approved_by">
                            @foreach ($settings->personnel as $ssa)
                                <option value="{{$ssa->id}}">{{$ssa->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="mtcbutton">
                        {{ __('Checkout Material') }}
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
