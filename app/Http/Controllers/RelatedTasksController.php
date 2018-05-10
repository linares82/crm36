<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Oportunity;
use App\Models\RelatedTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\RelatedTasksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class RelatedTasksController extends Controller
{

    /**
     * Display a listing of the related tasks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RelatedTask::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$relatedTasks = $r->with('oportunity','task','user')->paginate(25);
		//$relatedTasks = RelatedTask::with('oportunity','task','user')->paginate(25);

        return view('related_tasks.index', compact('relatedTasks'));
    }

    /**
     * Show the form for creating a new related task.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$tasks = Task::pluck('task','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('related_tasks.create', compact('oportunities','tasks','users','users'));
    }

    /**
     * Store a new related task in the storage.
     *
     * @param App\Http\Requests\RelatedTasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RelatedTasksFormRequest $request)
    {
        try {
            //dd("fil");
            $data = $request->getData();
            $f=date_create($data['fecha']);
            $data['fecha']=date_format($f,'Y/m/d H:i:s');
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $related_task=RelatedTask::create($data);
            return $related_task;
            /*return redirect()->route('related_tasks.related_task.index')
                             ->with('success_message', trans('related_tasks.model_was_added'));
*/
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('related_tasks.unexpected_error')]);
        }
    }

    /**
     * Display the specified related task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $relatedTask = RelatedTask::with('oportunity','task','user')->findOrFail($id);

        return view('related_tasks.show', compact('relatedTask'));
    }

    /**
     * Show the form for editing the specified related task.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $relatedTask = RelatedTask::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion','id')->all();
        $tasks = Task::pluck('task','id')->all();
        $users = User::pluck('name','id')->all();

        return view('related_tasks.edit', compact('relatedTask','oportunities','tasks','users','users'));
    }

    /**
     * Update the specified related task in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RelatedTasksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RelatedTasksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            //$data['fecha'] = Carbon::createFromFormat('Y-m-d H:i', $request->get('fecha'));
            $f=date_create($data['fecha']);
            $data['fecha']=date_format($f,'Y/m/d H:i:s');
            //dd($data);
            $relatedTask = RelatedTask::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $relatedTask->update($data);

            return $relatedTask;
            /*return redirect()->route('related_tasks.related_task.index')
                             ->with('success_message', trans('related_tasks.model_was_updated'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('related_tasks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified related task from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $relatedTask = RelatedTask::findOrFail($id);
            $relatedTask->delete();
            return $relatedTask;
            /*return redirect()->route('related_tasks.related_task.index')
                             ->with('success_message', trans('related_tasks.model_was_deleted'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('related_tasks.unexpected_error')]);
        }
    }



}
