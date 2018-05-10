<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Alert;
use \App\Models\RelatedTask;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_actual=date('Y/m/d');
        //dd($fecha_actual);
        $alertas=Alert::whereDate('date_send', $fecha_actual)->get();
        //dd($alertas);
        $tareas=RelatedTask::where('activo', '=', 1)->with('task')->get();
        //foreach($tareas as $t){
          //  dd($t->task->id);        
        //}
        
        return view('home', compact('alertas', 'tareas'));
    }
}
