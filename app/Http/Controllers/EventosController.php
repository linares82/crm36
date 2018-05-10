<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventosFormRequest;
use Exception;
use Illuminate\Http\Request;

class EventosController extends Controller
{

    /**
     * Display a listing of the eventos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Evento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$eventos = $r->with('user')->paginate(25);
		//$eventos = Evento::with('user')->paginate(25);

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new evento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('eventos.create', compact('users','users'));
    }

    /**
     * Store a new evento in the storage.
     *
     * @param App\Http\Requests\EventosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EventosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Evento::create($data);

            return redirect()->route('eventos.evento.index')
                             ->with('success_message', trans('eventos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('eventos.unexpected_error')]);
        }
    }

    /**
     * Display the specified evento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $evento = Evento::with('user')->findOrFail($id);

        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified evento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('eventos.edit', compact('evento','users','users'));
    }

    /**
     * Update the specified evento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EventosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EventosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $evento = Evento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $evento->update($data);

            return redirect()->route('eventos.evento.index')
                             ->with('success_message', trans('eventos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('eventos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified evento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $evento = Evento::findOrFail($id);
            $evento->delete();

            return redirect()->route('eventos.evento.index')
                             ->with('success_message', trans('eventos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('eventos.unexpected_error')]);
        }
    }



}
