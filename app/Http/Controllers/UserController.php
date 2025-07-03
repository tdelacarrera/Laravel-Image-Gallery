<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return "index";
    }

    public function store(Request $request){

      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed'
      ]);

        $user = new User();
        $user->name = $request->name;
        $user->email =  $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('images.index')->with('success', 'Usuario creado con éxito');
    }
    public function update(Request $request, Int $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('users.manage')->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.manage')->with('success', 'Usuario eliminado con éxito');
    }

    public function manage()
    {
      $users = User::all();
       return view('users.manage', compact('users'));
      }

 
}
