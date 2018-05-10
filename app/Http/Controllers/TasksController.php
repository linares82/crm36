<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;

class TasksController extends Controller
{

    /**
     * Display a listing of the tasks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Task::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$tasks = $r->with('user')->paginate(25);
		//$tasks = Task::with('user')->paginate(25);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('tasks.create', compact('users','users'));
    }

    /**
     * Store a new task in the storage.
     *
     * @param App\Http\Requests\TasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TasksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Task::create($data);

            return redirect()->route('tasks.task.index')
                             ->with('success_message', trans('tasks.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tasks.unexpected_error')]);
        }
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::with('user')->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('tasks.edit', compact('task','users','users'));
    }

    /**
     * Update the specified task in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TasksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $task = Task::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $task->update($data);

            return redirect()->route('tasks.task.index')
                             ->with('success_message', trans('tasks.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tasks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified task from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return redirect()->route('tasks.task.index')
                             ->with('success_message', trans('tasks.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tasks.unexpected_error')]);
        }
    }



}
