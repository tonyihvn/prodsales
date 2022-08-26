@extends('layouts.print-theme')

@section('content')

    <h4 class="page-title" style="font-weight: bold; text-align: center;">Production Details for : {{$pjob->product->name}} | Batch No: {{$pjob->batchno}} </h4>
    <div class="row" style="margin: 10px auto;">

            <div class="panel">

                <div class="panel-heading" style="text-align: center;">
                            <b>Job Status: </b> {{$pjob->status}}
                </div>
                <div class="panel-body">
                    <h4>Production Details</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr>
                                <th>Target Quantity</th>
                                <th>Date Started</th>
                                <th>Date Ended</th>
                                <th>Estimated Cost</th>
                                <th>Staff-in-Charge</th>

                            </tr>

                        </thead>
                        <tbody>
                                <tr>
                                    <td><b>{{$pjob->target_quantity}}</b></td>
                                    <td>{{$pjob->dated_started}}</td>
                                    <td>{{$pjob->dated_ended}}</td>
                                    <td>{{$pjob->estimated_cost_of_production}}</td>
                                    <td>{{$pjob->user->name}}</td>

                                </tr>
                                <tr>
                                    <td colspan="5">
                                        {!! $pjob->details !!}
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Materials Used</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Material Name</th>
                                <th>Quantity</th>
                                <th>Details</th>
                                <th>Checked Out By</th>
                                <th>Approved By</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pusedmaterials as $mtc)

                                <tr>
                                    <td>{{$mtc->material->name}}</td>
                                    <td><b>{{$mtc->quantity}}{{$mtc->material->measurement_unit}}</b></td>
                                    <td>{{$mtc->details}}</td>
                                    <td>{{$mtc->checkoutby->name}}</td>
                                    <td>{{$mtc->approvedby->name}}</td>
                                    <td>{{$mtc->dated}}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <hr>

                    <h4>Finished Product Stocked</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Quantity Produced</th>
                                <th>Quantity Damaged</th>
                                <th>Details</th>
                                <th>Confirmed By</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>{{$pfinished->quantity_produced}}</td>
                                    <td><b>{{$pfinished->quantity_damaged}}</b></td>
                                    <td>{{$pfinished->details}}</td>
                                    <td>{{$pfinished->confirmedby->name}}</td>
                                    <td>{{$pfinished->dated}}</td>
                                </tr>

                        </tbody>
                    </table>
                    <hr>



                </div>
            </div>

    </div>


@endsection
