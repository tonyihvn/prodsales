@extends('layouts.theme')

@section('content')
    @php $modal="material"; $pagename = "materials"; @endphp

    <h3 class="page-title">Suppliers | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#supplier">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Contact Person</th>
                                <th>Company Name</th>
                                <th>Materials/Products</th>
                                <th>Phone Number</th>
                                <th>Details</th>
                                <th>Address</th>
                                <th>Location/Facility</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $sup)

                                <tr>

                                    <td><b>{{$sup->supplier_name}}</b></td>
                                    <td><b>{{$sup->company_name}}</b></td>
                                    <td>{{$sup->category}}</td>
                                    <td>{{$sup->phone_number}}</td>
                                    <td>{{$sup->details}}</td>
                                    <td>{{$sup->address}}</td>
                                    <td>{{$sup->settings->business_name}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$sup->id}}" onclick="supplier({{$sup->id}})"  data-toggle="modal" data-target="#supplier" data-supplier_name="{{$sup->supplier_name}}" data-company_name="{{$sup->company_name}}" data-category="{{$sup->category}}" data-phone_number="{{$sup->phone_number}}"  data-details="{{$sup->details}}"  data-details="{{$sup->details}}"  data-address="{{$sup->address}}"  data-setting_id="{{$sup->setting_id}}" }}">Edit</button>
                                        <a href="/delete-sup/{{$sup->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the supplier: {{$sup->supplier_name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$suppliers->links("pagination::bootstrap-4")}}
                    </div>
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
