<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Oportunity;
use App\Models\TypeProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ProductsController extends Controller
{

    /**
     * Display a listing of the products.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $r = Product::where('id', '<>', '0');
        if (isset($input['id']) and $input['id'] <> 0) {
            $r->where('id', '=', $input['id']);
        }
        /*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
        $products = $r->with('oportunity', 'typeproduct', 'user')->paginate(25);
        //$products = Product::with('oportunity','typeproduct','user')->paginate(25);

        return view('products.index', compact('products'));
    }

    public function productsOportunityChange(Request $request)
    {
        $input = $request->all();
        //dd($input);
        $r = Product::where('id', '<>', '0');
        if (isset($input['producto']) and $input['producto'] <> "") {
            $r->where('producto', 'like', "%" . $input['producto'] . "%");
        }

        $productos = $r->get();
        //dd($productos->toArray());
        return $productos->toArray();
        //return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        $oportunities = Oportunity::pluck('descripcion', 'id')->all();
        $typeProducts = TypeProduct::pluck('producto', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $oportunity_id = $request->get('oportunity_id');

        return view('products.create', compact('oportunities', 'typeProducts', 'users', 'users', 'oportunity_id'));
    }

    /**
     * Store a new product in the storage.
     *
     * @param App\Http\Requests\ProductsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ProductsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $data['usu_mod_id'] = Auth::user()->id;
            $data['usu_alta_id'] = Auth::user()->id;
            $producto = Product::create($data);
            $oportunidad = Oportunity::find($data['oportunity_id']);
            $oportunidad->product()->attach($producto->id);


            return redirect()->route('oportunities.oportunity.show', $data['oportunity_id'])
                ->with('success_message', trans('products.model_was_added'));
        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('products.unexpected_error')]);
        }
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::with('oportunity', 'typeproduct', 'user')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        if (isset($_GET['oportunidad'])) {
            $oportunity_id = $_GET['oportunidad'];
        }

        $product = Product::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion', 'id')->all();
        $typeProducts = TypeProduct::pluck('producto', 'id')->all();
        $users = User::pluck('name', 'id')->all();


        return view('products.edit', compact('product', 'oportunities', 'typeProducts', 'users', 'users', 'oportunity_id'));
    }

    /**
     * Update the specified product in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ProductsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ProductsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $product = Product::findOrFail($id);
            $data['usu_mod_id'] = Auth::user()->id;

            $producto = $product->update($data);
            if (isset($data['oportunity_id'])) {
                $oportunidad = $data['oportunity_id'];
                return redirect()->route('oportunities.oportunity.show', $oportunidad)
                    ->with('success_message', trans('products.model_was_updated'));
            } else {
                return redirect()->route('products.product.index')
                    ->with('success_message', trans('products.model_was_updated'));
            }
        } catch (Exception $exception) {
            //dd($exception->getMessage();
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('products.unexpected_error')]);
        }
    }

    /**
     * Remove the specified product from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.product.index')
                ->with('success_message', trans('products.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('products.unexpected_error')]);
        }
    }
}
