<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Oportunity;
use App\Models\FilesCustomer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesCustomersFormRequest;
use Exception;
use Illuminate\Http\Request;
use Log;
use Auth;
use Storage;

class FilesCustomersController extends Controller
{

    /**
     * Display a listing of the files customers.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesCustomer::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesCustomers = $r->with('oportunity','user')->paginate(25);
		//$filesCustomers = FilesCustomer::with('oportunity','user')->paginate(25);

        return view('files_customers.index', compact('filesCustomers'));
    }

    /**
     * Show the form for creating a new files customer.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('files_customers.create', compact('oportunities','users','users'));
    }

    /**
     * Store a new files customer in the storage.
     *
     * @param App\Http\Requests\FilesCustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesCustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesCustomer::create($data);

            return redirect()->route('files_customers.files_customer.index')
                             ->with('success_message', trans('files_customers.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_customers.unexpected_error')]);
        }
    }

    /**
     * Display the specified files customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesCustomer = FilesCustomer::with('oportunity','user')->findOrFail($id);

        return view('files_customers.show', compact('filesCustomer'));
    }

    /**
     * Show the form for editing the specified files customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesCustomer = FilesCustomer::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();

        return view('files_customers.edit', compact('filesCustomer','oportunities','users','users'));
    }

    /**
     * Update the specified files customer in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesCustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesCustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesCustomer = FilesCustomer::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesCustomer->update($data);

            return redirect()->route('files_customers.files_customer.index')
                             ->with('success_message', trans('files_customers.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_customers.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files customer from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesCustomer = FilesCustomer::findOrFail($id);
            $filesCustomer->delete();

            return redirect()->route('files_customers.files_customer.index')
                             ->with('success_message', trans('files_customers.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_customers.unexpected_error')]);
        }
    }

    public function cargaArchivoCorreo(Request $request) {
        //dd($request);
        try{
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();
                $nombre=date('dmYHmi').$nombre;
                $r = Storage::disk('customer_files')->put($nombre, \File::get($file));
                $data['oportunity_id']=$request->get('oportunity');
                $data['nota']="Correo Electronico";
                $data['archivo']=$nombre;
                $data['usu_alta_id']=Auth::user()->id;
                $data['usu_mod_id']=Auth::user()->id;
                $file=FilesCustomer::create($data);
            } else {
                return "no";
            }

            if ($r) {
                return $nombre;
            } else {
                return "Error vuelva a intentarlo";
            }
        }catch(Exception $e){
            Log::info($e);
        }    
    }

    public function descargarArchivo(Request $request){
        $archivo=FilesCustomer::find($request->get('id'));
        $pathToFile = storage_path('app') . "/public/customer_files/" . $archivo->archivo;
        return response()->download($pathToFile);
    }
    
}
