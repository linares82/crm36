<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado;
use App\Models\Customer;
use App\Models\Oportunity;
use App\Models\Municipio;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomersFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
class CustomersController extends Controller
{

    /**
     * Display a listing of the customers.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Customer::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$customers = $r->with('oportunity','estado','municipio','user')->paginate(25);
		//$customers = Customer::with('oportunity','estado','municipio','user')->paginate(25);

        return view('customers.index', compact('customers'));
    }
    
    public function customersOportunityChange(Request $request)
    {
        $input=$request->all();
        
        $r=Customer::where('id', '<>', '0');
        if(isset($input['razon']) and $input['razon']<>''){
                $r->where('razon', 'like', '%'.$input['razon'].'%');
        }
        if(isset($input['nombre1']) and $input['nombre1']<>''){
                $r->where('nombre1', 'like', '%'.$input['nombre1'].'%');
        }
        if(isset($input['nombre2']) and $input['nombre2']<>''){
                $r->where('nombre2', 'like', '%'.$input['nombre2'].'%');
        }
        if(isset($input['ape_paterno']) and $input['ape_paterno']<>''){
                $r->where('ape_paterno', 'like', '%'.$input['ape_paterno'].'%');
        }
        if(isset($input['ape_materno']) and $input['ape_materno']<>''){
                $r->where('ape_materno', 'like', '%'.$input['ape_materno'].'%');
        }
        /*if(isset($input['name']) and $input['name']<>""){
                $r->where('name', 'like', '%'.$input['name'].'%');
        }*/
        $customers = $r->get();
        //$customers = Customer::with('oportunity','estado','municipio','user')->paginate(25);
        //dd($customers->toArray());
        return $customers->toArray();
        //return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$estados = Estado::pluck('estado','id')->all();
$municipios = Municipio::pluck('estado','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('customers.create', compact('oportunities','estados','municipios','users','users'));
    }

    /**
     * Store a new customer in the storage.
     *
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Customer::create($data);

            return redirect()->route('oportunities.oportunity.show')
                             ->with('success_message', trans('customers.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }
    }

    /**
     * Display the specified customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $customer = Customer::with('oportunity','estado','municipio','user')->findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        
        $customer = Customer::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion','id')->all();
        $estados = Estado::pluck('estado','id')->all();
        $municipios = Municipio::pluck('municipio','id')->all();
        $users = User::pluck('name','id')->all();
        $oportunity_id=$_GET['oportunidad'];
        
        return view('customers.edit', compact('customer','oportunities','estados','municipios','users','users', 'oportunity_id'));
    }

    /**
     * Update the specified customer in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $oportunidad=$data['oportunity_id'];
            
            $customer = Customer::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $customer->update($data);

            return redirect()->route('oportunities.oportunity.show', $oportunidad)
                             ->with('success_message', trans('customers.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified customer from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()->route('customers.customer.index')
                             ->with('success_message', trans('customers.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }
    }

    public function customersOportunityCreate(Request $request){
        $data=$request->all();
        //dd($data);
        $oportunity_id=$data['oportunidad'];
        $oportunities = Oportunity::pluck('descripcion','id')->all();
        $estados = Estado::pluck('estado','id')->all();
        $municipios = Municipio::pluck('municipio','id')->all();
        $users = User::pluck('name','id')->all();
        //dd($oportunity_id);
        return view('customers.oportunity_cliente', compact('oportunities','estados','municipios','users','users', 'oportunity_id'));
    }
    
    public function customersOportunityStore(CustomersFormRequest $request){
        try {            
            $data = $request->getData();
            
            $oportunidad=Oportunity::find($data['oportunity_id']);
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['cuenta_sms']=0;
            $data['cuenta_email']=0;
            
            $cliente=Customer::create($data);
            
            $oportunidad->customer()->attach($cliente->id);
            
            return redirect()->route('oportunities.oportunity.show', $data['oportunity_id'])
                             ->with('success_message', trans('customers.model_was_added'));

        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customers.unexpected_error')]);
        }
    }

}
