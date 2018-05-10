<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TypeProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeProductsFormRequest;
use Exception;
use Illuminate\Http\Request;

class TypeProductsController extends Controller
{

    /**
     * Display a listing of the type products.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=TypeProduct::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$typeProducts = $r->with('user')->paginate(25);
		//$typeProducts = TypeProduct::with('user')->paginate(25);

        return view('type_products.index', compact('typeProducts'));
    }

    /**
     * Show the form for creating a new type product.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('type_products.create', compact('users','users'));
    }

    /**
     * Store a new type product in the storage.
     *
     * @param App\Http\Requests\TypeProductsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TypeProductsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            TypeProduct::create($data);

            return redirect()->route('type_products.type_product.index')
                             ->with('success_message', trans('type_products.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('type_products.unexpected_error')]);
        }
    }

    /**
     * Display the specified type product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $typeProduct = TypeProduct::with('user')->findOrFail($id);

        return view('type_products.show', compact('typeProduct'));
    }

    /**
     * Show the form for editing the specified type product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $typeProduct = TypeProduct::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('type_products.edit', compact('typeProduct','users','users'));
    }

    /**
     * Update the specified type product in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TypeProductsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TypeProductsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $typeProduct = TypeProduct::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $typeProduct->update($data);

            return redirect()->route('type_products.type_product.index')
                             ->with('success_message', trans('type_products.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('type_products.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified type product from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $typeProduct = TypeProduct::findOrFail($id);
            $typeProduct->delete();

            return redirect()->route('type_products.type_product.index')
                             ->with('success_message', trans('type_products.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('type_products.unexpected_error')]);
        }
    }



}
