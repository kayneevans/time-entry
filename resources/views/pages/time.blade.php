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


                    <form method="POST" action="/time" class="formOptions">
                        @csrf

                        <div class="card p-3" >
                                <label for="costcenter" class="form-label">Team Member</label>
                                <input type="text" class="form-control" id="auth_user_id" name="auth_user_id" value="{{ Auth::user()->id }}" disabled />
                            </div>
                        
                        <div class="card p-3 mt-3">
                            <label for="PunchType" class="form-label">Punch Type</label>
                            <select name="PunchType" id="PunchType" class="form-select" onchange="yesnoCheck(this);">
                                <option value="" selected disabled></option>
                                <option value="In">Clock In</option>
                                <option value="Out">Clock Out</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                            
                        </div>

                        <div class="form-group mt-3 card p-3" id="time" style="display: none;">
                            <label for="workrule" class="form-label">Punch Date & Time</label>
                            <div class="input-group">
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" placeholder="Date" required>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" id="time" placeholder="Time" required>
                                @error('date', 'time')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-group mt-3 card p-3" id="time-out" style="display: none;">
                            <!-- <input class="form-check-input" type="checkbox" value="1" id="attestation" name="attestation">
                            <label class="form-check-label" for="flexCheckDefault">
                                I am attesting that I needed to return to work early due to a business related activity and did not take a full 30 minute break. 
                            </label> -->
                        </div>


                        <div id="transfer" style="display: none;">
                            <div class="mt-3 card p-3" >
                                <label for="costcenter" class="form-label">Company Cost Center Transfer</label>
                                <input type="text" class="form-control" id="costcenter" name="costcenter" aria-describedby="costCenter" placeholder="___ - ________" data-slots="_" >
                            </div>

                            <div class="form-group mt-3 card p-3" >
                                <label for="workrule" class="form-label">Work Rule Transfer</label>
                                <select name="workrule" id="workrule" class="form-select">
                                    <option value="" selected disabled></option>
                                    @foreach($workrule as $row)
                                        <option value="{{$row->wr_Name}}">{{$row->wr_Name}} - {{$row->wr_Desc}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mt-3 card p-3">
                                <label for="position" class="form-label">Position Transfer</label>
                                <input type="text" class="form-control" id="position" name="position" aria-describedby="position" placeholder="P_______" data-slots="_">
                            </div>
                        </div>
                        

                        <div class="hiddenInputs" id="hiddenInputs">
                            <input type="text" id="created_by" name="created_by" value="{{ Auth::user()->id }}" hidden />
                            <div id="hiddenInputs-teamSide"></div>
                        </div>

                        <div class="mt-3" id="enterBtn" style="display: none; width: 100%">
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}" style="display: none;"/>
                            <input type="submit" value="Submit" class="btn btn-primary btn-lg" style="width: 100%">
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
