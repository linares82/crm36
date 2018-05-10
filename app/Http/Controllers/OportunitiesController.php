<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Oportunity;
use App\Models\Task;
use App\Models\PredefinedTask;
use App\Models\RelatedTask;
use App\Models\Customer;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\OportunitySt;
use App\Models\OportunityLabel;
use App\Http\Controllers\Controller;
use App\Http\Requests\OportunitiesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use \Carbon\Carbon; 

class OportunitiesController extends Controller
{

    /**
     * Display a listing of the oportunities.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Oportunity::where('id', '<>', '0')->orderBy('id', 'desc');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$oportunities = $r->with('oportunitylabel','oportunityst','user')->paginate(25);
		//$oportunities = Oportunity::with('oportunitylabel','oportunityst','user')->paginate(25);

        return view('oportunities.index', compact('oportunities'));
    }

    /**
     * Show the form for creating a new oportunity.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunityLabels = OportunityLabel::pluck('etiqueta','id')->all();
        $oportunitySts = OportunitySt::pluck('estatus','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('oportunities.create', compact('oportunityLabels','oportunitySts','users','users'));
    }

    /**
     * Store a new oportunity in the storage.
     *
     * @param App\Http\Requests\OportunitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(OportunitiesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $registro=Oportunity::create($data);
            $predefined_tasks= PredefinedTask::where('activo', '=', 1)->get();
            foreach($predefined_tasks as $pt){
                $tarea['oportunity_id']=$registro->id;
                $tarea['task_id']=$pt->task_id;
                $tarea['detail']=$pt->detail;
                $tarea['activo']=1;
                $fecha=date('Y-m-j', strtotime('+'.$pt->dias.' day', strtotime(date('Y-m-j'))));
                //dd($fecha);
                $tarea['fecha']=$fecha;
                $tarea['usu_mod_id']=Auth::user()->id;
                $tarea['usu_alta_id']=Auth::user()->id;
                //dd($tarea);
                RelatedTask::create($tarea);
            }

            return redirect()->route('oportunities.oportunity.show', $registro->id)
                             ->with('success_message', trans('oportunities.model_was_added'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunities.unexpected_error')]);
        }
    }

    /**
     * Display the specified oportunity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $oportunity = Oportunity::with('oportunitylabel','oportunityst','user','customer')->findOrFail($id);
        $title="Oportunidad";
        //$customer=Customer::where('oportunity_id','=',$oportunity->id)->first();
        $estados = Estado::pluck('estado','id')->all();
        $municipios = Municipio::pluck('municipio','id')->all();
        $tasks = Task::pluck('task','id')->all();
        $alerts=$oportunity->alert()->orderBy('id','desc')->get();
        $notes=$oportunity->note()->orderBy('id','desc')->get();
        $related_tasks=$oportunity->relatedTask()->orderby('id', 'desc')->get();
        
        //dd($alerts);
        
        return view('oportunities.show', compact('oportunity', 'title', 'estados', 'municipios', 'alerts','notes', 'tasks', 'related_tasks'));
    }

    /**
     * Show the form for editing the specified oportunity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $oportunity = Oportunity::findOrFail($id);
        $oportunityLabels = OportunityLabel::pluck('etiqueta','id')->all();
        $oportunitySts = OportunitySt::pluck('estatus','id')->all();
        $users = User::pluck('name','id')->all();
        $title="Oportunidad";
        
        return view('oportunities.edit', compact('oportunity','oportunityLabels','oportunitySts','users','users', 'title'));
    }

    /**
     * Update the specified oportunity in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\OportunitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, OportunitiesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $oportunity = Oportunity::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $oportunity->update($data);

            return redirect()->route('oportunities.oportunity.index')
                             ->with('success_message', trans('oportunities.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunities.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified oportunity from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $oportunity = Oportunity::findOrFail($id);
            $oportunity->delete();

            return redirect()->route('oportunities.oportunity.index')
                             ->with('success_message', trans('oportunities.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('oportunities.unexpected_error')]);
        }
    }

    public function seleccionarCliente(Request $request){
        $data=$request->all();
        if($request->ajax()){
            $oportunidad=Oportunity::find($data['oportunidad']);
            $oportunidad->customer()->detach();
            $oportunidad->customer()->attach($data['cliente']);
        }
        return $oportunidad;
    }
    
    public function seleccionarProducto(Request $request){
        $data=$request->all();
        if($request->ajax()){
            $oportunidad=Oportunity::find($data['oportunidad']);
            $oportunidad->product()->detach();
            $oportunidad->product()->attach($data['producto']);
        }
        return $oportunidad;
    }

    public function enviarCorreo(Request $request) {
        //dd($request->all());
        $pathToFile = "";
        $containfile = false;
        if ($request->hasFile('file')) {
            $containfile = true;
            $file = $request->file('file');
            $nombre = $file->getClientOriginalName();
            $pathToFile = storage_path('app') . "/public/customer_files/" . $request->get('file_hidden');
        }
        
        $f=$request->all();
        
        $destinatario = $request->get("destinatario");
        $nombre = $request->get("nombre");
        $asunto = $request->get("asunto");
        $contenido = $request->get("contenido_mail");
        $from_e=Auth::user()->email;
        $from_n=Auth::user()->name;
        //dd($from_e);
        
        $data = array('contenido' => $contenido);
        $r = \Mail::send('oportunities.correo_individual', $data, function ($message)
                use ($asunto, $destinatario, $containfile, $pathToFile, $nombre, $from_e, $from_n) 
                {
                    $message->from($from_e, $from_n);
                    $message->to($destinatario, $nombre)->subject($asunto);
                    $message->replyTo($from_e);
                    if ($containfile) {
                        $message->attach($pathToFile);
                    }
                    
                });
        
        
        
    }
}
