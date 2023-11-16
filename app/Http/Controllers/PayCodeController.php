<?php

namespace App\Http\Controllers;

Use Auth;
use Illuminate\Http\Request;
use App\Models\PayCode;
use App\Models\PayCodeEntry;
use App\Models\TimeEntry;
use DB;
use Carbon\Carbon;

class PayCodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user(); 
        $paycode = PayCode::all();
        $people = DB::select(
            "
                SELECT distinct
                    users.id,
                    users.name

                FROM users   
                where users.id <> $user->id             
            "); 
        
        return view('pages.paycode',['paycode'=>$paycode, 'people'=>$people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'paycode' => 'required',
            'paycode_date' => 'required',
            'user_id' => 'required',
            'created_by' => 'required',
            'paycode_hours' => 'required',

        ]);

        $paycode_entry = new PayCodeEntry;

        $paycode_entry->user_id = $request->input('user_id');
        $paycode_entry->paycode = $request->input('paycode');
        $paycode_entry->paycode_date = $request->input('paycode_date');
        $paycode_entry->paycode_hours = $request->input('paycode_hours');
        $paycode_entry->created_by = $request->input('created_by');

        $paycode_entry->save();

        return redirect("/dashboard")->with('success', 'Punch Added', 'time', $paycode_entry);
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
    public function edit($paycode_entry_id)
    {
        //
        $paycode = PayCode::all();
        $paycode_id = $paycode_entry_id;

        $paycode_entry = PayCodeEntry::where('paycode_entry_id', $paycode_entry_id)->firstOrFail();

        return view('pages.paycodeedit', compact(['paycode', 'paycode_id', 'paycode_entry']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $paycode_entry_id)
    {
        //
        $paycodeedit = PayCodeEntry::findOrFail($paycode_entry_id, 'paycode_entry_id');

        $paycodeedit->user_id = $request->input('user_id');
        $paycodeedit->paycode = $request->input('paycode');
        $paycodeedit->paycode_date = $request->input('paycode_date');
        $paycodeedit->paycode_hours = $request->input('paycode_hours');
        $paycodeedit->updated_by = $request->input('updated_by');

        $paycodeedit->save(); 

        return redirect("/dashboard")->with('success', 'Punch ' . $paycode_entry_id . ' Edited');
    }

    public function searchtk()
    {
        //
        $paycode = PayCode::all();
    
        
        $paycodeentry = DB::table('PayCodeEntry')
            ->leftJoin('users', 'PayCodeEntry.user_id', '=', 'users.id')
            ->get();
        

        return view('pages.admin-dashboard-paycode', compact(['paycodeentry', 'paycodeentry']));

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
