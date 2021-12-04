<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;



class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $users = User::all();
       return$users;
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
           'email' => 'required|email|unique:users,email',
           'password' => 'required|max:8',
       ]);
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Str::slug($request->password);
       
      $user->save();
       return response()->json([
           'success' => 'users has been added!',
           'data' =>$user,
       ]);
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      return User::find($id);
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
        'name' => 'nullable',
        'email' => 'nullable|email|unique:users,email,'.$id,
        'password' => 'nullable|max:8',
    ]);
   $user = new User();
   $user->name = $request->name;
   $user->email = $request->email;
   $user->password = Str::slug($request->password);
    
   $user->save();
    return response()->json([
        'success' => 'users has been added!',
        'data' =>$user,
    ]);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       User::find($id)->delete();
       return response()->json(['success' => 'delete successfully!']);
   }
}
