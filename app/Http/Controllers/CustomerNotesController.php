<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerNote;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerNotesFormRequest;
use Exception;
use Illuminate\Http\Request;

class CustomerNotesController extends Controller
{

    /**
     * Display a listing of the customer notes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CustomerNote::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$customerNotes = $r->with('customer','user')->paginate(25);
		//$customerNotes = CustomerNote::with('customer','user')->paginate(25);

        return view('customer_notes.index', compact('customerNotes'));
    }

    /**
     * Show the form for creating a new customer note.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('razon','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('customer_notes.create', compact('customers','users','users'));
    }

    /**
     * Store a new customer note in the storage.
     *
     * @param App\Http\Requests\CustomerNotesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CustomerNotesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CustomerNote::create($data);

            return redirect()->route('customer_notes.customer_note.index')
                             ->with('success_message', trans('customer_notes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customer_notes.unexpected_error')]);
        }
    }

    /**
     * Display the specified customer note.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $customerNote = CustomerNote::with('customer','user')->findOrFail($id);

        return view('customer_notes.show', compact('customerNote'));
    }

    /**
     * Show the form for editing the specified customer note.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $customerNote = CustomerNote::findOrFail($id);
        $customers = Customer::pluck('razon','id')->all();
$users = User::pluck('name','id')->all();

        return view('customer_notes.edit', compact('customerNote','customers','users','users'));
    }

    /**
     * Update the specified customer note in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CustomerNotesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CustomerNotesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $customerNote = CustomerNote::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $customerNote->update($data);

            return redirect()->route('customer_notes.customer_note.index')
                             ->with('success_message', trans('customer_notes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customer_notes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified customer note from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $customerNote = CustomerNote::findOrFail($id);
            $customerNote->delete();

            return redirect()->route('customer_notes.customer_note.index')
                             ->with('success_message', trans('customer_notes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('customer_notes.unexpected_error')]);
        }
    }



}
