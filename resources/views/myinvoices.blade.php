@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; $modal="accounthead"; @endphp

    <h3 class="page-title">Transactions | <small style="color: green">Payments, Invoices, Reciepts</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <table class="table  responsive-table" style="width: 100%" id="products">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Amount</th>

                                <th>Date</th>
                                <th>Ref. No</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transact)

                                <tr>
                                    <td>{{$transact->title}}</td>
                                    <td>{{$transact->amount}}</td>
                                    <td>{{$transact->dated}}</td>
                                    <td>{{$transact->reference_no}}</td>
                                    <td>
                                        @if ($transact->account_head==1)
                                            <a href="{{url('/invoice/invoice/'.$transact->id)}}" target="_blank" class="label label-success">Invoice</a>
                                            <a href="{{url('/invoice/receipt/'.$transact->id)}}" target="_blank" class="label label-warning">Reciept</a>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$transactions->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>

@endsection
