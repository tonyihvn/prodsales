@extends('layouts.theme')

@section('content')
    @php $modal="accounthead"; @endphp

    <h3 class="page-title">Categories | <small style="color: green">All Category Definitions</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#category">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Title</th>
                                <th>Category Group</th>
                                <th>Description</th>
                                <th>Facility</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat)

                                <tr>
                                    <td>{{$cat->title}}</td>
                                    <td>{{$cat->category_group}}</td>
                                    <td>{{$cat->description}}</td>
                                    <td>{{$cat->settings->business_name}}</td>
                                    <td><button class="label label-primary" id="ach{{$cat->id}}" onclick="category({{$cat->id}})"  data-toggle="modal" data-target="#category" data-title="{{$cat->title}}" data-category_group="{{$cat->category_group}}" data-description="{{$cat->description}}"  data-setting_id="{{$cat->setting_id}}">Edit</button>
                                    <a href="{{url('/delete-cat/'.$cat->id)}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete {{$cat->title}}\'s category?')">Delete</a>
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
  <div class="modal" id="category">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addcategory') }}">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Lubricants">
                </div>

                <div class="form-group">
                    <label for="category_group">Category Group</label>
                    <input type="text" name="category_group" id="category_group" class="form-control" placeholder="e.g. Materials, Products, Suppliers, Distributors">

                </div>



                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="e.g. This is for fules and diesels">
                </div>

                <div class="form-group">

                    <label for="setting_id" class="control-label">Facility / Location</label>
                    <select class="form-control" name="setting_id" id="setting_id">
                        <option value="1" selected>Select Location</option>
                        @foreach ($userbusinesses as $set)
                            <option value="{{$set->id}}">{{$set->business_name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="catbutton">
                        {{ __('Add Category') }}
                    </button>
                </div>


            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


@endsection
