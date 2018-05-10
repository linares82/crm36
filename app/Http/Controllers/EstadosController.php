<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Municipio;
use App\Models\Estado;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadosFormRequest;
use Exception;
use Illuminate\Http\Request;
use DB;

class EstadosController extends Controller {

    /**
     * Display a listing of the estados.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request) {
        $input = $request->all();
        $r = Estado::where('id', '<>', '0');
        if (isset($input['id']) and $input['id'] <> 0) {
            $r->where('id', '=', $input['id']);
        }
        /* if(isset($input['name']) and $input['name']<>""){
          $r->where('name', 'like', '%'.$input['name'].'%');
          } */
        $estados = $r->with('user')->paginate(25);
        //$estados = Estado::with('user')->paginate(25);

        return view('estados.index', compact('estados'));
    }

    /**
     * Show the form for creating a new estado.
     *
     * @return Illuminate\View\View
     */
    public function create() {
        $users = User::pluck('name', 'id')->all();

        return view('estados.create', compact('users', 'users'));
    }

    /**
     * Store a new estado in the storage.
     *
     * @param App\Http\Requests\EstadosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EstadosFormRequest $request) {
        try {

            $data = $request->getData();

            $data['usu_mod_id'] = Auth::user()->id;
            $data['usu_alta_id'] = Auth::user()->id;
            Estado::create($data);

            return redirect()->route('estados.estado.index')
                            ->with('success_message', trans('estados.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('estados.unexpected_error')]);
        }
    }

    /**
     * Display the specified estado.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id) {
        $estado = Estado::with('user')->findOrFail($id);

        return view('estados.show', compact('estado'));
    }

    /**
     * Show the form for editing the specified estado.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id) {
        $estado = Estado::findOrFail($id);
        $users = User::pluck('name', 'id')->all();

        return view('estados.edit', compact('estado', 'users', 'users'));
    }

    /**
     * Update the specified estado in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EstadosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EstadosFormRequest $request) {
        try {

            $data = $request->getData();

            $estado = Estado::findOrFail($id);
            $data['usu_mod_id'] = Auth::user()->id;

            $estado->update($data);

            return redirect()->route('estados.estado.index')
                            ->with('success_message', trans('estados.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('estados.unexpected_error')]);
        }
    }

    /**
     * Remove the specified estado from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        try {
            $estado = Estado::findOrFail($id);
            $estado->delete();

            return redirect()->route('estados.estado.index')
                            ->with('success_message', trans('estados.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('estados.unexpected_error')]);
        }
    }

    public function getCmbMunicipios(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $estado = $request->get('estado');
            $municipio = $request->get('municipio');

            $final = array();
            $r = DB::table('municipios as e')
                    ->select('e.id', 'e.municipio')
                    ->where('e.estado_id', '=', $estado)
                    ->where('e.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($municipio) and $municipio <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $municipio) {
                        array_push($final, array('id' => $r1->id,
                            'name' => $r1->municipio,
                            'selectec' => 'Selected'));
                    } else {
                        array_push($final, array('id' => $r1->id,
                            'name' => $r1->municipio,
                            'selectec' => ''));
                    }
                }
                
            } else {
                foreach ($r as $r1) {
                    
                    array_push($final, array('id' => $r1->id,
                        'name' => $r1->municipio,
                        'selectec' => ''));

                }
                
            }
            //return $final;
            echo json_encode($final);
        }
    }

}
