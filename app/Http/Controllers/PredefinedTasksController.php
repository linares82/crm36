<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\PredefinedTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\PredefinedTasksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class PredefinedTasksController extends Controller
{

    /**
     * Display a listing of the predefined tasks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=PredefinedTask::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$predefinedTasks = $r->with('task','user')->paginate(25);
		//$predefinedTasks = PredefinedTask::with('task','user')->paginate(25);

        return view('predefined_tasks.index', compact('predefinedTasks'));
    }

    /**
     * Show the form for creating a new predefined task.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $tasks = Task::pluck('task','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('predefined_tasks.create', compact('tasks','users','users'));
    }

    /**
     * Store a new predefined task in the storage.
     *
     * @param App\Http\Requests\PredefinedTasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PredefinedTasksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            //dd($data);
            PredefinedTask::create($data);

            return redirect()->route('predefined_tasks.predefined_task.index')
                             ->with('success_message', trans('predefined_tasks.model_was_added'));

        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('predefined_tasks.unexpected_error')]);
        }
    }

    /**
     * Display the specified predefined task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $predefinedTask = PredefinedTask::with('task','user')->findOrFail($id);

        return view('predefined_tasks.show', compact('predefinedTask'));
    }

    /**
     * Show the form for editing the specified predefined task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $predefinedTask = PredefinedTask::findOrFail($id);
        $tasks = Task::pluck('task','id')->all();
$users = User::pluck('name','id')->all();

        return view('predefined_tasks.edit', compact('predefinedTask','tasks','users','users'));
    }

    /**
     * Update the specified predefined task in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PredefinedTasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PredefinedTasksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $predefinedTask = PredefinedTask::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $predefinedTask->update($data);

            return redirect()->route('predefined_tasks.predefined_task.index')
                             ->with('success_message', trans('predefined_tasks.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('predefined_tasks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified predefined task from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $predefinedTask = PredefinedTask::findOrFail($id);
            $predefinedTask->delete();

            return redirect()->route('predefined_tasks.predefined_task.index')
                             ->with('success_message', trans('predefined_tasks.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('predefined_tasks.unexpected_error')]);
        }
    }



}
