<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Municipio;
use App\Http\Controllers\Controller;
use App\Http\Requests\MunicipiosFormRequest;
use Exception;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{

    /**
     * Display a listing of the municipios.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Municipio::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$municipios = $r->with('user')->paginate(25);
		//$municipios = Municipio::with('user')->paginate(25);

        return view('municipios.index', compact('municipios'));
    }

    /**
     * Show the form for creating a new municipio.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('municipios.create', compact('users','users'));
    }

    /**
     * Store a new municipio in the storage.
     *
     * @param App\Http\Requests\MunicipiosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MunicipiosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Municipio::create($data);

            return redirect()->route('municipios.municipio.index')
                             ->with('success_message', trans('municipios.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('municipios.unexpected_error')]);
        }
    }

    /**
     * Display the specified municipio.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $municipio = Municipio::with('user')->findOrFail($id);

        return view('municipios.show', compact('municipio'));
    }

    /**
     * Show the form for editing the specified municipio.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $municipio = Municipio::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('municipios.edit', compact('municipio','users','users'));
    }

    /**
     * Update the specified municipio in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MunicipiosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MunicipiosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $municipio = Municipio::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $municipio->update($data);

            return redirect()->route('municipios.municipio.index')
                             ->with('success_message', trans('municipios.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('municipios.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified municipio from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $municipio = Municipio::findOrFail($id);
            $municipio->delete();

            return redirect()->route('municipios.municipio.index')
                             ->with('success_message', trans('municipios.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('municipios.unexpected_error')]);
        }
    }



}
