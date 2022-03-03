@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Enter Paycode</h1>
                </div>

                <div class="card-body">


                    <form method="POST" action="/paycode/{{$paycode_entry->paycode_entry_id}}" class="formOptions">
                        @csrf

                        <div class="card p-3" >
                                <label for="costcenter" class="form-label">Team Member ID</label>
                                <input type="text" class="form-control" value="{{$paycode_entry->user_id}}" disabled >
                            </div>

                        <div id="transfer">

                            <div class="form-group mt-3 card p-3" >
                                <label for="paycode" class="form-label">Pay Code</label>
                                <select name="paycode" id="paycode" class="form-select">
                                    <option value="{{$paycode_entry->paycode}}" selected>{{$paycode_entry->paycode}} - (Current Selection)</option>
                                    @foreach($paycode as $row)
                                        <option value="{{$row->pc_Name}}">{{$row->pc_Name}} - {{$row->pc_Desc}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group mt-3 card p-3" id="time">
                            <label for="date" class="form-label">Pay Code Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="paycode_date" id="paycode_date" placeholder="{{$paycode_entry->paycode_date}}" value="{{$paycode_entry->paycode_date}}" required>
                                
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mt-3 p-3" >
                                <label for="costcenter" class="form-label">Pay Code Hours</label>
                                <input type="number" class="form-control" id="paycode_hours" name="paycode_hours" max="24" step="0.01" placeholder="{{$paycode_entry->paycode_hours}}" value="{{$paycode_entry->paycode_hours}}">
                            </div>



                        
                        

                        <div class="hiddenInputs" id="hiddenInputs">
                            <input type="text" id="updated_by" name="updated_by" value="{{ Auth::user()->id }}" hidden />
                            <input type="text" id="user_id" name="user_id" value="{{$paycode_entry->user_id}}" hidden />
                            <div id="hiddenInputs-teamSide"></div>
                        </div>

                        <div class="mt-3" id="enterBtn" style="width: 100%">
                            <input type="submit" value="Submit" class="btn btn-primary btn-lg" style="width: 100%">
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
