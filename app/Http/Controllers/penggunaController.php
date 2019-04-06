<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use View;
use Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class penggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Gate::allows('isAdmin')){
        return view('error');
      }
      $tampilUser = user::all();
      return view('pengguna.lihat-pengguna', compact('tampilUser'));
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
        if(!Gate::allows('isAdmin')){
          return view('error');
      }
        $validator = Validator::make(Input::all(),  User::Rules(), User::$messages);
        if ($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        else {
          $user = new User();
          $user -> name = $request -> name;
          $user -> email = $request -> email;
          $user -> role = $request -> role;
          $user ->  password = Hash::make($request -> password);
          $user->save();
          return redirect('/pengguna');
        }
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      if(!Gate::allows('isAdmin')){
        return view('error');
      }
      $validator = Validator::make(Input::all(),  User::RulesUpdate(), User::$messagesUpdate);
      if ($validator->fails())
           {
              return Redirect::back()->withErrors($validator)->withInput();
          }
      else {
        $user = User::findOrFail($request->id_pengguna_update);
        $user -> name = $request -> nama_pengguna_update;
        $user -> email = $request -> email_pengguna_update;
        $user -> role = $request -> role_pengguna_update;
        $user->save();
        return redirect('/pengguna');
      }
    }

    public function ganti_password(Request $request){
      if(!Gate::allows('isAdmin')){
        return view('error');
      }

      $id_user = $request->id_pengguna_update;
      $nama_pengguna = User::where('id', $id_user)
                        ->select('users.name as nama')
                        ->first();
      // return response()->json([$id_user]);
      return view('pengguna.update_password', compact('id_user','nama_pengguna'));
    }

    public function update_pass(Request $request){
      if(!Gate::allows('isAdmin')){
        return view('error');
      }
      $validator = Validator::make(Input::all(),  User::RulesPass(), User::$messagesPass);
      if($validator->passes()){
        $user = User::findOrFail($request->id_user);
        $user ->  password = Hash::make($request -> password);
        $user->save();
        return redirect('/pengguna');
      }else{
        $id_user = $request->id_user;
        $nama_pengguna = User::where('id', $id_user)
                          ->select('users.name as nama')
                          ->first();
        $data = compact('id_user', 'nama_pengguna');
        return View::make('pengguna.update_password', $data)->withErrors($validator);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      if(!Gate::allows('isAdmin')){
        return view('error');
      }
      $user = User::findOrFail($request->id);
      $user->delete();

      return back();
    }
}
