@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Enter Time</h1>
                </div>

                <div class="card-body">


                    <form method="POST" action="/time/timekeeper/{{$punch->time_id}}" class="formOptions">
                        @csrf

                        <div class="card p-3" >
                                <label for="costcenter" class="form-label">Team Member ID</label>
                                <input type="text" class="form-control" id="" name="" value="{{$punch->user_id}}" disabled >
                            </div>
                        
                        <div class="card p-3 mt-3">
                            <label for="PunchType" class="form-label">Punch Type</label>
                            <select name="PunchType" id="PunchType" class="form-select" >
                                @if($punch->punch_type === 'In')
                                    <option value="In" selected>Clock In</option>
                                    <option value="Out">Clock Out</option>
                                    <option value="Transfer">Transfer</option>
                                @elseif($punch->punch_type === 'Out')
                                    <option value="In">Clock In</option>
                                    <option value="Out" selected>Clock Out</option>
                                    <option value="Transfer">Transfer</option>
                                @elseif($punch->punch_type === 'Transfer')
                                    <option value="In">Clock In</option>
                                    <option value="Out">Clock Out</option>
                                    <option value="Transfer" selected>Transfer</option>
                                @else
                                @endif
                            </select>
                            
                        </div>

                        <div class="form-group mt-3 card p-3" id="time">
                            <label for="workrule" class="form-label">Punch Date & Time</label>
                            <div class="input-group">
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" placeholder="{{$punch->punch_date}}" value="{{$punch->punch_date}}" required>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" id="time" placeholder="{{$punch->punch_time}}" value="{{$punch->punch_time}}" required>
                                @error('date', 'time')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-group mt-3 card p-3" id="time-out" >
                            @if($punch->attestation === '1')
                                <input class="form-check-input" type="checkbox" value="1" id="attestation" name="attestation" checked>
                            @else 
                                <input class="form-check-input" type="checkbox" value="1" id="attestation" name="attestation">
                            @endif
                            <label class="form-check-label" for="flexCheckDefault">
                                I am attesting that I needed to return to work early due to a business related activity and did not take a full 30 minute break. 
                            </label>
                        </div>


                        <div id="transfer">
                            <div class="mt-3 card p-3" >
                                <label for="costcenter" class="form-label">Company Cost Center Transfer</label>
                                <input type="text" class="form-control" id="costcenter" name="costcenter" aria-describedby="costCenter" placeholder="{{$punch->cost_center}}"  >
                            </div>

                            <div class="form-group mt-3 card p-3" >
                                <label for="workrule" class="form-label">Work Rule Transfer</label>
                                <select name="workrule" id="workrule" class="form-select">
                                    <option value="{{$punch->work_rule}}" selected>{{$punch->work_rule}}</option>
                                    @foreach($workrule as $row)
                                        <option value="{{$row->wr_Name}}">{{$row->wr_Name}} - {{$row->wr_Desc}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mt-3 card p-3">
                                <label for="position" class="form-label">Position Transfer</label>
                                <input type="text" class="form-control" id="position" name="position" aria-describedby="position" placeholder="{{$punch->position}}" >
                            </div>
                        </div>
                        

                        <div class="hiddenInputs" id="hiddenInputs">
                            <input type="text" id="punch_id" name="punch_id" value="{{$punch->time_id}}" hidden />
                            <input type="text" id="user_id" name="user_id" value="{{$punch->user_id}}" hidden />   
                            <input type="text" id="created_by" name="created_by" value="{{$punch->created_by}}" hidden />
                            <input type="text" id="created_at" name="created_at" value="{{$punch->created_at}}" hidden />
                            <input type="text" id="updated_by" name="updated_by" value="{{ Auth::user()->id }}" hidden />
                            <div id="hiddenInputs-teamSide"></div>
                        </div>

                        <div class="mt-3" id="enterBtn">
                            <input type="submit" value="Update" class="btn btn-primary btn-lg" style="width: 100%">
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
