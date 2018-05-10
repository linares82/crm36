<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\Oportunity;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;

class NotesController extends Controller
{

    /**
     * Display a listing of the notes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Note::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$notes = $r->with('oportunity','user')->paginate(25);
		//$notes = Note::with('oportunity','user')->paginate(25);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new note.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('notes.create', compact('oportunities','users','users'));
    }

    /**
     * Store a new note in the storage.
     *
     * @param App\Http\Requests\NotesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $request->all();
            //dd($data);
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $nota=Note::create($data);
            return $nota;
            /*return redirect()->route('oportunities.oportunity.show', $nota->oportunity_id)
                             ->with('success_message', trans('notes.model_was_added'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('notes.unexpected_error')]);
        }
    }

    /**
     * Display the specified note.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $note = Note::with('oportunity','user')->findOrFail($id);

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified note.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $oportunities = Oportunity::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();

        return view('notes.edit', compact('note','oportunities','users','users'));
    }

    /**
     * Update the specified note in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\NotesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, NotesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $note = Note::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $note->update($data);
            return $note;
            /*return redirect()->route('notes.note.index')
                             ->with('success_message', trans('notes.model_was_updated'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('notes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified note from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();

            return $note;
            /*return redirect()->route('notes.note.index')
                             ->with('success_message', trans('notes.model_was_deleted'));
*/
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('notes.unexpected_error')]);
        }
    }



}
