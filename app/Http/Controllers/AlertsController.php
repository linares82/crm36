<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alert;
use App\Models\Oportunity;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlertsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AlertsController extends Controller
{

    /**
     * Display a listing of the alerts.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Alert::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$alerts = $r->with('oportunity','user')->paginate(25);
		//$alerts = Alert::with('oportunity','user')->paginate(25);

        return view('alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new alert.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('alerts.create', compact('oportunities','users','users'));
    }

    /**
     * Store a new alert in the storage.
     *
     * @param App\Http\Requests\AlertsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AlertsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $f=date_create($data['date_send']);
            $data['date_send']=date_format($f,'Y/m/d H:i:s');
            $alert=Alert::create($data);
            return $alert;
            /*return redirect()->route('alerts.alert.index')
                             ->with('success_message', trans('alerts.model_was_added'));
*/
        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('alerts.unexpected_error')]);
        }
    }

    /**
     * Display the specified alert.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $alert = Alert::with('oportunity','user')->findOrFail($id);

        return view('alerts.show', compact('alert'));
    }

    /**
     * Show the form for editing the specified alert.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $alert = Alert::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();

        return view('alerts.edit', compact('alert','oportunities','users','users'));
    }

    /**
     * Update the specified alert in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AlertsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AlertsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $alert = Alert::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            $f=date_create($data['date_send']);
            $data['date_send']=date_format($f,'Y/m/d H:i:s');
            $alert->update($data);
            return $alert;
            /*return redirect()->route('alerts.alert.index')
                             ->with('success_message', trans('alerts.model_was_updated'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('alerts.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified alert from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $alert = Alert::findOrFail($id);
            $alert->delete();
            return $alert;
             /*return redirect()->route('alerts.alert.index')
                             ->with('success_message', trans('alerts.model_was_deleted'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('alerts.unexpected_error')]);
        }
    }



}
