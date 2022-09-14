@extends('layouts.theme')

@section('content')
    @php $pagename="user_dashboard"; @endphp

    <div class="row">
        @if ($settings->status=="InActive" || Auth()->user()->status=="InActive")
            <p style="color: red; font-weight: bold;">This account or business is not yet approved, please contact admin for activation at: <a href="mailto:{{$settings->user->email}}">{{$settings->user->email}}</a></p>
        @endif
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Stats</h3>
            </div>
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="card-box bg-blue">
                                <div class="inner">
                                    <h3> {{$myinvoices->count()}} </h3>
                                    <p> Invoices/Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                                <a href="/myinvoices" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>


                        <div class="col-lg-5 col-sm-6">
                            <div class="card-box bg-red">
                                <div class="inner">
                                    <h3> {{$mytasks->count()}} </h3>
                                    <p> Messages </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <a href="{{url('/mytickets')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Messages / Tickets</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>

                            <tr>

                                <th>Title</th>
                                <th>Date</th>
                                <th>Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mytasks as $ta)
                                @if ($ta->category=="Tivket")

                                    <tr>
                                        <td>{{$ta->title}}</td>
                                        <td>{{$ta->from==$ta->to?$ta->from:$ta->from." to ".$ta->to}}</td>
                                        <td>{{$ta->activities}}</td>
                                        <td>{{$ta->status}}</td>

                                    </tr>
                                @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        body{
            background:#eee;
            }

            .card-box {
                position: relative;
                color: #fff;
                padding: 20px 10px 40px;
                margin: 20px 0px;
            }
            .card-box:hover {
                text-decoration: none;
                color: #f1f1f1;
            }
            .card-box:hover .icon i {
                font-size: 100px;
                transition: 1s;
                -webkit-transition: 1s;
            }
            .card-box .inner {
                padding: 5px 10px 0 10px;
            }
            .card-box h3 {
                font-size: 27px;
                font-weight: bold;
                margin: 0 0 8px 0;
                white-space: nowrap;
                padding: 0;
                text-align: left;
            }
            .card-box p {
                font-size: 15px;
            }
            .card-box .icon {
                position: absolute;
                top: auto;
                bottom: 5px;
                right: 5px;
                z-index: 0;
                font-size: 72px;
                color: rgba(0, 0, 0, 0.15);
            }
            .card-box .card-box-footer {
                position: absolute;
                left: 0px;
                bottom: 0px;
                text-align: center;
                padding: 3px 0;
                color: rgba(255, 255, 255, 0.8);
                background: rgba(0, 0, 0, 0.1);
                width: 100%;
                text-decoration: none;
            }
            .card-box:hover .card-box-footer {
                background: rgba(0, 0, 0, 0.3);
            }
            .bg-blue {
                background-color: #00c0ef !important;
            }
            .bg-green {
                background-color: #00a65a !important;
            }
            .bg-orange {
                background-color: #f39c12 !important;
            }
            .bg-red {
                background-color: #d9534f !important;
            }

    </style>


@endsection
