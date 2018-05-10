<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OportunitySt;
use App\Http\Controllers\Controller;
use App\Http\Requests\OportunityStsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;

class OportunityStsController extends Controller
{

    /**
     * Display a listing of the oportunity sts.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=OportunitySt::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$oportunitySts = $r->with('user')->paginate(25);
		//$oportunitySts = OportunitySt::with('user')->paginate(25);

        return view('oportunity_sts.index', compact('oportunitySts'));
    }

    /**
     * Show the form for creating a new oportunity st.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('oportunity_sts.create', compact('users','users'));
    }

    /**
     * Store a new oportunity st in the storage.
     *
     * @param App\Http\Requests\OportunityStsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(OportunityStsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            OportunitySt::create($data);

            return redirect()->route('oportunity_sts.oportunity_st.index')
                             ->with('success_message', trans('oportunity_sts.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_sts.unexpected_error')]);
        }
    }

    /**
     * Display the specified oportunity st.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $oportunitySt = OportunitySt::with('user')->findOrFail($id);
        $title= "Estatus";
        return view('oportunity_sts.show', compact('oportunitySt', 'title'));
    }

    /**
     * Show the form for editing the specified oportunity st.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $oportunitySt = OportunitySt::findOrFail($id);
        $users = User::pluck('name','id')->all();
        $title= "Estatus";
        
        return view('oportunity_sts.edit', compact('oportunitySt','users','users', 'title'));
    }

    /**
     * Update the specified oportunity st in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\OportunityStsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, OportunityStsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            
            $oportunitySt = OportunitySt::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $oportunitySt->update($data);

            return redirect()->route('oportunity_sts.oportunity_st.index')
                             ->with('success_message', trans('oportunity_sts.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_sts.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified oportunity st from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $oportunitySt = OportunitySt::findOrFail($id);
            $oportunitySt->delete();

            return redirect()->route('oportunity_sts.oportunity_st.index')
                             ->with('success_message', trans('oportunity_sts.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunity_sts.unexpected_error')]);
        }
    }



}
