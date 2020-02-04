<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajador;
use Illuminate\Support\Facades\Storage;

class TrabajadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Trabajador::where('user_id', auth()->id())->get();
        }else{
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'office' => 'required',
            'salary' => 'required|integer',
            'hours' => 'required|integer',
            'avatar' => 'required'
        ]);

        $trabajador = new Trabajador();
        $trabajador->avatar = $request->avatar;
        $trabajador->name = $request->name;
        $trabajador->lastname = $request->lastname;
        $trabajador->email = $request->email;
        $trabajador->position = $request->position;
        $trabajador->salary = $request->salary;
        $trabajador->hours = $request->hours;
        $trabajador->office = $request->office;
        $trabajador->user_id = auth()->id();
        $trabajador->save();

        return $trabajador;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->where('_id',$id)->first();

        return ($trabajador) ? $trabajador : response('El usuario no existe', 500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'office' => 'required',
            'salary' => 'required|integer',
            'hours' => 'required|integer',
            'avatar' => 'required'
        ]);

        $trabajador = Trabajador::where('user_id', auth()->id())->where('_id',$id)->first();
        $trabajador->avatar = $request->avatar;
        $trabajador->name = $request->name;
        $trabajador->lastname = $request->lastname;
        $trabajador->email = $request->email;
        $trabajador->position = $request->position;
        $trabajador->salary = $request->salary;
        $trabajador->hours = $request->hours;
        $trabajador->office = $request->office;
        $trabajador->user_id = auth()->id();
        $trabajador->save();

        return $trabajador;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trabajador = Trabajador::where('user_id', auth()->id())->where('_id',$id)->first();
        $trabajador->delete();

        return response('Perfil eliminado correctamente', 200);
    }

    /**
     * Upload user image
     *
     * @return \Illuminate\Http\Response
     */

    public function fileStore(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = time().$uploadedFile->getClientOriginalName();

        Storage::disk('public')->putFileAs(
          'files/',
          $uploadedFile,
          $filename
        );
    
        return response()->json(['success'=>$filename]);
    }
}
