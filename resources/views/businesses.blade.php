@extends('layouts.theme')

@section('content')

    <h3 class="page-title">Suppliers | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">

                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Business Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userbusinesses as $biz)

                                <tr>

                                    <td><b>{{$biz->business_name}}</b></td>

                                    <td>
                                        <a href="{{url('/delete-biz/'.$biz->id)}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the Business: {{$biz->business_name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="supplier">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Supplier</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addsupplier') }}" id="materialform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="supplier_name">Contact Person Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="type">Category</label>
                        <select class="form-control" name="category" id="category">
                          <option value="Consumable">Consumable</option>
                          <option value="Cleaning">Cleaning</option>
                          <option value="Machine Part">Machine Part</option>
                          <option value="Solid">Solid</option>
                          <option value="Liquid">Liquid</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone_number">phone_number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="details">Details</label>
                        <input type="text" name="details" id="details" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control">
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
                    <button type="submit" class="btn btn-primary" id="supbutton">
                        {{ __('Add Supplier') }}
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
