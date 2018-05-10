<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OportunityLabel;
use App\Http\Controllers\Controller;
use App\Http\Requests\OportunityLabelsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;

class OportunityLabelsController extends Controller
{

    /**
     * Display a listing of the oportunity labels.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=OportunityLabel::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$oportunityLabels = $r->with('user')->paginate(25);
		//$oportunityLabels = OportunityLabel::with('user')->paginate(25);

        return view('oportunity_labels.index', compact('oportunityLabels'));
    }

    /**
     * Show the form for creating a new oportunity label.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('oportunity_labels.create', compact('users','users'));
    }

    /**
     * Store a new oportunity label in the storage.
     *
     * @param App\Http\Requests\OportunityLabelsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(OportunityLabelsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            //dd($data);
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            OportunityLabel::create($data);

            return redirect()->route('oportunity_labels.oportunity_label.index')
                             ->with('success_message', trans('oportunity_labels.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_labels.unexpected_error')]);
        }
    }

    /**
     * Display the specified oportunity label.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $oportunityLabel = OportunityLabel::with('user')->findOrFail($id);
        $title= "Etiqueta";
        return view('oportunity_labels.show', compact('oportunityLabel', 'title'));
    }

    /**
     * Show the form for editing the specified oportunity label.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $oportunityLabel = OportunityLabel::findOrFail($id);
        $users = User::pluck('name','id')->all();
        $title= "Editar Etiqueta";

        return view('oportunity_labels.edit', compact('oportunityLabel','users','users', 'title'));
    }

    /**
     * Update the specified oportunity label in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\OportunityLabelsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, OportunityLabelsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_mod_id']=Auth::user()->id;
            
            $oportunityLabel = OportunityLabel::findOrFail($id);
            $oportunityLabel->update($data);

            return redirect()->route('oportunity_labels.oportunity_label.index')
                             ->with('success_message', trans('oportunity_labels.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_labels.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified oportunity label from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $oportunityLabel = OportunityLabel::findOrFail($id);
            $oportunityLabel->delete();

            return redirect()->route('oportunity_labels.oportunity_label.index')
                             ->with('success_message', trans('oportunity_labels.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_labels.unexpected_error')]);
        }
    }



}
