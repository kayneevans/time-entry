<?php

namespace App\Http\Controllers;


Use Auth;
use Illuminate\Http\Request;
use App\Models\WorkRule;
use App\Models\TimeEntry;
use DB;
use Carbon\Carbon;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $workrule = WorkRule::all();
        
        return view('pages.time',['workrule'=>$workrule]);
    }

    public function indexTK()
    {
        //
        $workrule = WorkRule::all();
        return view('pages.timetk',['workrule'=>$workrule]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'PunchType' => 'required',
            'date' => 'required',
            'time' => 'required',
            'created_by' => 'required',

        ]);

        $time_entry = new TimeEntry;

        $time_entry->user_id = $request->input('created_by');
        $time_entry->punch_type = $request->input('PunchType');
        $time_entry->punch_date = $request->input('date');
        $time_entry->punch_time = $request->input('time');
        $time_entry->attestation = $request->input('attestation');
        $time_entry->cost_center = $request->input('costcenter');
        $time_entry->work_rule = $request->input('workrule');
        $time_entry->position =  $request->input('position');
        $time_entry->created_by = $request->input('created_by');
        
        


        $time_entry->save();

        return redirect("/dashboard")->with('success', 'Punch Added', 'time', $time_entry);

        
    }

    public function storeTK(Request $request)
    {
        $this->validate($request, [
            'PunchType' => 'required',
            'PunchType' => 'required',
            'date' => 'required',
            'time' => 'required',
            'created_by' => 'required',

        ]);

        $time_entry = new TimeEntry;

        $time_entry->user_id = $request->input('user_id');
        $time_entry->punch_type = $request->input('PunchType');
        $time_entry->punch_date = $request->input('date');
        $time_entry->punch_time = $request->input('time');
        $time_entry->attestation = $request->input('attestation');
        $time_entry->cost_center = $request->input('costcenter');
        $time_entry->work_rule = $request->input('workrule');
        $time_entry->position =  $request->input('position');
        $time_entry->created_by = $request->input('created_by');
        
        


        $time_entry->save();

        return redirect("/dashboard")->with('success', 'Punch Added', 'time', $time_entry);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edittk($time_id)
    {
        //
        $workrule = WorkRule::all();
        $punch_id = $time_id;

        $punch = TimeEntry::where('time_id', $punch_id)->firstOrFail();

        return view('pages.timetkedit', compact(['punch_id', 'punch', 'workrule']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $time_id)
    {
        //
        // $workrule = WorkRule::all();
        $punchedit = TimeEntry::findOrFail($time_id, 'time_id');

        $punchedit->user_id = $request->input('user_id');
        $punchedit->punch_type = $request->input('PunchType');
        $punchedit->punch_date = $request->input('date');
        $punchedit->punch_time = $request->input('time');
        $punchedit->attestation = $request->input('attestation');
        $punchedit->cost_center = $request->input('costcenter');
        $punchedit->work_rule = $request->input('workrule');
        $punchedit->position =  $request->input('position');
        $punchedit->created_at = $request->input('created_at');
        $punchedit->updated_by = $request->input('updated_by');

        $punchedit->save(); 

        return redirect("/dashboard")->with('success', 'Punch ' . $time_id . ' Edited');
    }

    public function searchtk()
    {
        //
        $workrule = WorkRule::all();

        $punches = TimeEntry::where('deleted', Null)->get();
        

        return view('pages.admin-dashboard', compact(['punches', 'workrule']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
