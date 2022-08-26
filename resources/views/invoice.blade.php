@extends('layouts.print-theme')

@section('content')
    <div style="text-align: center;"><img  src="/public/images/{{$settings->logo}}" class="img-responsive logo" style="height: auto !important; width: 100px; position: relative; padding: 0px;"></div>

    <h3 class="page-title" style="font-weight: bold; text-align: center;">{{$settings->business_name}}<br><small>{{$settings->address}} | {{$settings->phone_number}}</small></h3>

    <hr>

    <h4 class="page-title" style="font-weight: bold; text-align: center;">{{$category}} No.: {{$sale->reference_no}} </h4>
    <div class="row" style="margin: 10px auto;">

            <div class="panel">
                <div class="panel-body">
                    <h4>Customer Detail</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr>
                                <th>Name:</th>
                                <th>Phone Number:</th>
                                <th>Address</th>
                                <th>Date</th>
                            </tr>

                        </thead>
                        <tbody>
                                <tr>
                                    <td><b>{{$customer->name}}</b></td>
                                    <td>{{$customer->phone_number}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->dated}}</td>

                                </tr>
                                <tr>
                                    <td><b>Other Info</b></td>
                                    <td colspan="3">
                                        {!! $sale->details !!}
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h4>Products Purchased</h4>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $pr)
                                <tr>
                                    <td>{{$pr->product->name}}</td>
                                    <td>{{$pr->quantity}}</td>
                                    <td>{{$pr->price}}</td>
                                    <td>{{$pr->amount_paid}}</td>
                                    <td>{{$pr->dated}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    Total Amount:
                                </td>
                                <td>
                                    {{$sale->amount}}
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <hr>
                    <table class="table responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Manager Sign</th>

                                <th>Customer Signature</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>______________________________</td>
                                <th>______________________________</th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

    </div>


@endsection
