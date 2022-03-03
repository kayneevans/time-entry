@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="timeButton d-flex mb-2 flex-row justify-content-between">

                @if (auth()->check())
                @if (auth()->user()->isAdmin())
                    <a href="/search" class="btn btn-secondary ">Search Punch</a>
                    <a href="/search-paycode" class="btn btn-secondary ">Search Pay Code</a>
                @endif
                    @if (auth()->user()->isTimekeeper())
                        <a href="/paycode" class="btn btn-secondary me-2">Add Pay Code</a>
                        <a href="/time/timekeeper" class="btn btn-secondary me-2">Add Clock Time</a>
                    @else

                    @endif
                @endif

                @auth
                <a href="/time" class="btn btn-primary">Clock Time</a>
                @else
                <!-- <a class="nav-item nav-link" href="{{route('login')}}">Login</a> -->

                @endauth




            </div>
            <div class="card mt-3">
                <div class="card-header">Time Submitted</div>

                <div class="card-body">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Punch Type</th>
                                <th>Date - Time</th>
                                <th>Transfer</th>
                                <th>Attestation</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enteredTime as $timeentered)
                            <tr>
                                <td> {{ $timeentered->user_id }} </td>
                                <td> {{ $timeentered->punch_type }} </td>
                                <td> {{ $timeentered->punch_date }} - {{ $timeentered->punch_time }}</td>
                                <td> @empty($timeentered->cost_center) @else {{ $timeentered->cost_center }} - @endempty
                                    @empty($timeentered->work_rule) @else {{ $timeentered->work_rule }} - @endempty
                                    @empty($timeentered->position) @else {{ $timeentered->position }} @endempty </td>
                                <td> {{ $timeentered->attestation }} </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @if (auth()->check())
            @if (auth()->user()->isTimekeeper())
            <div class="card mt-3">
                <div class="card-header">Time Submitted - For Team Members</div>

                <div class="card-body">
                    <table class="table table-hover" id="datatable2">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Punch Type</th>
                                <th>Date - Time</th>
                                <th>Transfer</th>
                                <th>Attestation</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th>Edit</th>
                                    @else

                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enteredTimeTM as $timeenteredTM)
                            <tr>
                                <td> {{ $timeenteredTM->user_id }} </td>
                                <td> {{ $timeenteredTM->punch_type }} </td>
                                <td> {{ $timeenteredTM->punch_date }} - {{ $timeenteredTM->punch_time }}</td>
                                <td> @empty($timeenteredTM->cost_center) @else {{ $timeenteredTM->cost_center }} -
                                    @endempty
                                    @empty($timeenteredTM->work_rule) @else {{ $timeenteredTM->work_rule }} - @endempty
                                    @empty($timeenteredTM->position) @else {{ $timeenteredTM->position }} @endempty
                                </td>
                                <td> {{ $timeenteredTM->attestation }} </td>
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th><a href="time/timekeeper/{{ $timeenteredTM->time_id }}" class="btn btn-primary btn-sm">Edit</a></th>
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


            @if (auth()->check())
            @if (auth()->user()->isTimekeeper())
            <div class="card mt-3">
                <div class="card-header">Pay Code Submitted - For Team Members</div>

                <div class="card-body">
                    <table class="table table-hover" id="datatable3">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Pay Code</th>
                                <th>Date </th>
                                <th>Hours</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th>Edit</th>
                                    @else

                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enteredPayCodeTM as $enteredPayCodeTM)
                            <tr>
                                <td> {{ $enteredPayCodeTM->user_id }} </td>
                                <td> {{ $enteredPayCodeTM->paycode }} </td>
                                <td> {{ $enteredPayCodeTM->paycode_date }} </td>
                                <td> {{ $enteredPayCodeTM->paycode_hours }} </td>
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th><a href="/paycode/{{ $enteredPayCodeTM->paycode_entry_id }}" class="btn btn-primary btn-sm">Edit</a></th>
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
