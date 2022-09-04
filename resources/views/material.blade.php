@extends('layouts.print-theme')

@section('content')

    <h4 class="page-title" style="font-weight: bold; text-align: center;">Material Details for : {{$material->name}}</h4>
    <div class="row" style="margin: 10px auto;">

            <div class="panel">

                <div class="panel-heading" style="text-align: center;">
                            <b>Available in Stock: </b> {{$material->stock->quantity}}
                </div>
                <div class="panel-body">
                    <h4>MAterial Details</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Measurement Unit</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td><b>{{$material->type}}</b></td>
                                    <td>{{$material->size}}</td>
                                    <td>{{$material->measurement_unit}}</td>
                                    <td>{{$material->cost_per}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Supplied from Vendors</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Supplier/Company</th>
                                <th>Supply Batch</th>
                                <th>Confirmed By</th>
                                <th>Qty</th>
                                <th>Unit Cost</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($susupplies as $msu)
                                <tr>
                                    <td>{{$msu->supplier->supplier_name}} / {{$msu->supplier->company_name}}</td>
                                    <td>{{$msu->batchno}}</td>
                                    <td><b>{{$msu->confirmedby->name}}</b></td>
                                    <td>{{$msu->quantity}}</td>
                                    <td>{{$msu->cost_per}}</td>
                                    <td>{{$msu->total_amount}}</td>
                                    <td>{{$msu->dated}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="3">Total Supplied:</td>
                                    <td colspan="2">{{$totalqsupplied = $susupplies->sum('quantity')}}</td>
                                    <td>{{$totalasupplied = $susupplies->sum('total_amount')}}</td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Material Checked Out for Production</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Production Batch No</th>
                                <th>Quantity</th>
                                <th>Details</th>
                                <th>Checkout By</th>
                                <th>Approved By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mcheckouts as $mtc)

                            <tr>
                                <td><b>{{$mtc->production_batch}}</b></td>
                                <td><b>{{$mtc->quantity}}{{$mtc->material->measurement_unit}}</b></td>
                                <td>{{$mtc->details}}</td>
                                <td>{{$mtc->checkoutby->name}}</td>
                                <td>{{$mtc->approvedby->name}}</td>
                                <td>{{$mtc->dated}}</td>
                            </tr>
                        @endforeach

                                <tr>
                                    <td>Total Checked Out:</td>
                                    <td colspan="5">{{$totalqcout = $mcheckouts->sum('quantity')}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <p>Quantity Deficit: {{($totalqsupplied)-($totalqcout+$material->stock->quantity)}} (<small><b>Key:</b> Total Supplied - (Total Sold + Stock) = 0</small>)</p>
                </div>
            </div>

    </div>


@endsection
