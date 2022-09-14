@extends('layouts.theme')

@section('content')
@php $pagetype="report"; @endphp

    <h3 class="page-title">Tickets | <small style="color: green">Messages, Reminders...</small></h3>
    <div class="row">
            <div class="panel">

                <div class="panel-body">
                    <table class="table  responsive-table" id="products">
                        <thead>
                            <tr style="color: ">
                                <th>Title</th>
                                <th>Details</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td><b>{{$task->title}}</b></td>
                                    <td>{{$task->activities}}</td>
                                    <td>{{$task->date}}</td>
                                    <td>{{$task->status}}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$tasks->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>





@endsection
