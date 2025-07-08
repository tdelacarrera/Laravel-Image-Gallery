<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
      $users = User::orderBy('id', 'asc')->paginate(10);
       return view('users.index', compact('users'));
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
            'password' => 'nullable|string|min:8|confirmed'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
          $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito');
    }

    public function register(){
        return view('users.register');
    }

    public function login(){
        return view('users.login');
    }

}
