<?php

namespace App\Http\Controllers;

Use Auth;
use Illuminate\Http\Request;
use App\Models\TimeEntry;
use App\Models\PayCodeEntry;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->id();

        $enteredTime = DB::table('TimeEntry')
                        ->leftJoin('users', 'TimeEntry.user_id', '=', 'users.id')
                        ->where('user_id', $user)
                        ->get();
                    
        
        $enteredTimeTM = DB::table('TimeEntry')
                            ->leftJoin('users', 'TimeEntry.user_id', '=', 'users.id')
                            ->where('user_id', '!=', $user)
                            ->where('created_by', $user)
                            ->orWhere('updated_by', $user)
                            ->get();
        
        $enteredPayCodeTM = DB::table('PayCodeEntry')
                            ->leftJoin('users', 'PayCodeEntry.user_id', '=', 'users.id')
                            ->where('user_id', '!=', $user)
                            ->where('created_by', $user)
                            ->orWhere('updated_by', $user)
                            ->get();


        return view('pages.dashboard',['enteredTime'=>$enteredTime, 'enteredTimeTM'=>$enteredTimeTM, 'enteredPayCodeTM'=>$enteredPayCodeTM ]);
    }
}
