@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="">

            
            @if (auth()->check())
            @if (auth()->user()->isAdmin())
            <div class="card mt-3">
                <div class="card-header">Pay Code Submitted</div>

                <div class="card-body">
                    <table class="table table-hover" id="datatable3">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Paycode</th>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Updated By</th>
                                <th>Updated At</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin())
                                        <th>Edit</th>
                                    @else

                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paycodeentry as $paycodeentry)
                            <tr>
                                <td> {{ $paycodeentry->user_id }} </td>
                                <td> {{ $paycodeentry->paycode }} </td>
                                <td> {{ $paycodeentry->paycode_date }} </td>
                                <td> {{ $paycodeentry->paycode_hours }}</td>
                                <td> {{ $paycodeentry->created_by }}</td>
                                <td> {{ $paycodeentry->created_at }}</td>
                                <td> {{ $paycodeentry->updated_by }}</td>
                                <td> {{ $paycodeentry->updated_at }}</td>
                                
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th><a href="paycode/{{ $paycodeentry->paycode_entry_id }}" class="btn btn-primary btn-sm">Edit</a></th>
                                    @else

                                    @endif
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            @else

            @endif
            @endif


        </div>
    </div>
</div>


@endsection
