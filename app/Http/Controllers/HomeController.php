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

        $enteredTime = TimeEntry::where('user_id', $user)
                    ->get();
        
        $enteredTimeTM = TimeEntry::where('user_id', '!=', $user)
                            ->where('created_by', $user)
                            ->orWhere('updated_by', $user)
                            ->get();
        
        $enteredPayCodeTM = PayCodeEntry::where('user_id', '!=', $user)
                            ->where('created_by', $user)
                            ->orWhere('updated_by', $user)
                            ->get();


        return view('pages.dashboard',['enteredTime'=>$enteredTime, 'enteredTimeTM'=>$enteredTimeTM, 'enteredPayCodeTM'=>$enteredPayCodeTM ]);
    }
}
