<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('auth.login');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "req",$request;
        $request->validate([
            'name'=> 'required|string|max:255|unique:users',
            'email' =>  'required|string|email|max:255|unique:users',
            'password' =>  'required|string|min:8|confirmed',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           
            

        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>'user',
            
            // 'photo' => $request->photo,
            

        ]);
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        
                     
            $credentials = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);
    
            // Attempt to authenticate
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                $user = Auth::user();
    
                // Check user role and redirect accordingly
                return match($user->role) {
                    'ADMIN' => redirect()->route('admin'),
                    default => redirect()->route('user.index')
                };
            }
        
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
    
    }
    
    public function dashboardPage(){
        if(Auth::check()){
            return view('admin.dashboard');
        }else{
            return redirect()->route('login');
        }
    }

    public function logout(){
            Auth::logout();
            return view('auth.login');

        

    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
