@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="">

            
            @if (auth()->check())
            @if (auth()->user()->isAdmin())
            <div class="card mt-3">
                <div class="card-header">Time Submitted</div>

                <div class="card-body">
                    <table class="table table-hover" id="datatable-admin">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Punch Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Transfer</th>
                                <th>Attestation</th>
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
                            @foreach($punches as $punch)
                            <tr>
                                <td> {{ $punch->user_id }} </td>
                                <td> {{ $punch->punch_type }} </td>
                                <td> {{ $punch->punch_date }} </td>
                                <td> {{ $punch->punch_time }}</td>
                                <td> @empty($punch->cost_center) @else {{ $punch->cost_center }} -
                                    @endempty
                                    @empty($punch->work_rule) @else {{ $punch->work_rule }} - @endempty
                                    @empty($punch->position) @else {{ $punch->position }} @endempty
                                </td>
                                <td> {{ $punch->attestation }} </td>
                                <td> {{ $punch->created_by }} </td>
                                <td> {{ $punch->created_at }} </td>
                                <td> {{ $punch->updated_by }} </td>
                                <td> {{ $punch->updated_at }} </td>
                                @if (auth()->check())
                                    @if (auth()->user()->isTimekeeper())
                                        <th><a href="time/timekeeper/{{ $punch->time_id }}" class="btn btn-primary btn-sm">Edit</a></th>
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
