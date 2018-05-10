<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Param;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParamsFormRequest;
use Exception;
use Illuminate\Http\Request;

class ParamsController extends Controller
{

    /**
     * Display a listing of the params.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Param::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$params = $r->with('user')->paginate(25);
		//$params = Param::with('user')->paginate(25);

        return view('params.index', compact('params'));
    }

    /**
     * Show the form for creating a new param.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('params.create', compact('users','users'));
    }

    /**
     * Store a new param in the storage.
     *
     * @param App\Http\Requests\ParamsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ParamsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Param::create($data);

            return redirect()->route('params.param.index')
                             ->with('success_message', trans('params.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('params.unexpected_error')]);
        }
    }

    /**
     * Display the specified param.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $param = Param::with('user')->findOrFail($id);

        return view('params.show', compact('param'));
    }

    /**
     * Show the form for editing the specified param.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $param = Param::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('params.edit', compact('param','users','users'));
    }

    /**
     * Update the specified param in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ParamsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ParamsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $param = Param::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $param->update($data);

            return redirect()->route('params.param.index')
                             ->with('success_message', trans('params.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('params.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified param from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $param = Param::findOrFail($id);
            $param->delete();

            return redirect()->route('params.param.index')
                             ->with('success_message', trans('params.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('params.unexpected_error')]);
        }
    }



}
