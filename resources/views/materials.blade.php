@extends('layouts.theme')

@section('content')
    @php $modal="material"; $pagename = "materials"; @endphp

    <h3 class="page-title">Materials | <small style="color: green">List</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#material">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Image</th>
                                <th>Name</th>
                                <th>type/Category</th>
                                <th>Size/Unit</th>
                                <th>Cost Per</th>
                                <th>Location</th>
                                <th>Stock Bal.</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materials as $mat)

                                <tr>
                                    <td width="10%">
                                            <img src="/public/images/materials/{{$mat->picture}}" class="img-circle" alt="{{$settings->business_name}}" width="100%" height="auto">
                                    </td>
                                    <td><a href="/material/{{$mat->id}}"><b>{{$mat->name}}</b></td>
                                    <td><b>{{$mat->type}}/{{$mat->category}}</b></td>
                                    <td>{{$mat->size}} {{$mat->measurement_unit}}</td>
                                    <td>{{$mat->cost_per}}</td>
                                    <td>{{$mat->settings->business_name}}</td>
                                    <td>{{$mat->stock->quantity}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$mat->id}}" onclick="material({{$mat->id}})"  data-toggle="modal" data-target="#material" data-name="{{$mat->name}}" data-type="{{$mat->type}}" data-category="{{$mat->category}}" data-measurement_unit="{{$mat->measurement_unit}}"  data-picture="{{$mat->picture}}"  data-size="{{$mat->size}}"  data-cost_per="{{$mat->cost_per}}"  data-setting_id="{{$mat->setting_id}}" }}">Edit</button>
                                        <a href="/delete-mat/{{$mat->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the material: {{$mat->name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$materials->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="material">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Material</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addmaterial') }}" id="materialform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="row">

                    <div class="form-group col-md-8">
                        <label for="name">Item Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cost_per">Cost Per Unit</label>
                        <input type="text" name="cost_per" id="cost_per" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                          <option value="Consumable">Consumable</option>
                          <option value="Cleaning">Cleaning</option>
                          <option value="Machine Part">Machine Part</option>
                          <option value="Solid">Solid</option>
                          <option value="Liquid">Liquid</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="size">Size</label>
                        <input type="text" name="size" id="size" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="measurement_unit">Measurement Unit</label>
                        <input type="text" name="measurement_unit" id="measurement_unit" class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                        <option value="Upcoming">Upcoming</option>

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


                <div class="form-group">
                    <input type="hidden" id="oldpicture" name="oldpicture">
                    <label for="picture">Upload Featured Image</label>
                    <input type="file" name="picture" id="picture" class="form-control">
                </div>






                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="matbutton">
                        {{ __('Add Material') }}
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
