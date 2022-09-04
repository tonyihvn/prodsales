@extends('layouts.print-theme')

@section('content')

    <h4 class="page-title" style="font-weight: bold; text-align: center;">Product Details for : {{$product->name}}</h4>
    <div class="row" style="margin: 10px auto;">

            <div class="panel">

                <div class="panel-heading" style="text-align: center;">
                            <b>Available in Stock: </b> {{$product->stock->quantity}}
                </div>
                <div class="panel-body">
                    <h4>Product Details</h4>
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
                                    <td><b>{{$product->type}}</b></td>
                                    <td>{{$product->size}}</td>
                                    <td>{{$product->measurement_unit}}</td>
                                    <td>{{$product->price}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Supplied From Factory to Stock</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Production Batch</th>
                                <th>Confirmed By</th>
                                <th>Qty Produced</th>
                                <th>Qty Damaged</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pfsupplies as $pfs)
                                <tr>
                                    <td>{{$pfs->batchno}}</td>
                                    <td><b>{{$pfs->confirmedby->name}}</b></td>
                                    <td>{{$pfs->quantity_produced}}</td>
                                    <td>{{$pfs->quantity_damaged}}</td>
                                    <td>{{$pfs->dated}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="2">Total Produced:</td>
                                    <td>{{$qproduced = $pfsupplies->sum('quantity_produced')}}</td>
                                    <td colspan="3"></td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Supplied From Vendors</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Batch</th>
                                <th>Supplier Name</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Amount</th>
                                <th>Confirmed By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($psupplies as $psu)
                                <tr>
                                    <td>{{$psu->batchno}}</td>
                                    <td><b>{{$psu->supplier->name}}</b></td>
                                    <td>{{$psu->quantity}}</td>
                                    <td>{{$psu->cost_per}}</td>
                                    <td>{{$psu->total_amount}}</td>
                                    <td>{{$psu->confirmedby->name}}</td>
                                    <td>{{$psu->date_supplied}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="2">Total Supplied:</td>
                                    <td colspan="2">{{$qsupplied = $psupplies->sum('quantity')}}</td>
                                    <td colspan="3">{{$qsupplied = $psupplies->sum('total_amount')}}</td>
                                </tr>


                        </tbody>
                    </table>
                    <hr>

                    <h4>Product Sales</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Invoice No</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Customer</th>
                                <th>Sold By</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($psales as $psa)
                                <tr>
                                    <td>{{$psa->group_id}}</td>
                                    <td><b>{{$psa->quantity}}</b></td>
                                    <td>{{$psa->price}}</td>
                                    <td>{{$psa->amount_paid}}</td>
                                    <td>{{$psa->pay_status}}</td>
                                    <td>{{$psa->customer->name}}</td>
                                    <td>{{$psa->seller->name}}</td>
                                    <td>{{$psa->dated_sold}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td>Total Sold:</td>
                                    <td colspan="2">{{$totalqsold = $psales->sum('quantity')}}</td>
                                    <td colspan="5">{{$totalasold = $psales->sum('amount_paid')}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <p>Quantity Deficit: {{($qproduced+$qsupplied)-($totalqsold+$product->stock->quantity)}} (<small><b>Key:</b> (Total Produced + Supplied) - (Total Sold + Stock) = 0</small>)</p>
                </div>
            </div>

    </div>


@endsection
