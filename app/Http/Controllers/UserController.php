<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "req", $request;
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' =>  'required|string|email|max:255|unique:users',
            'password' =>  'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users',

            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
            'phone.regex' => 'Please enter a valid phone number.',
            'phone.unique' => 'This phone number is already registered.',


        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'phone' => $request->phone,

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
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.'
        ]);
        $remember = $request->has('remember');

        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check user role and redirect accordingly
            return match ($user->role) {
                'ADMIN' => redirect()->route('admin.dashboard'),
                default => redirect()->route('user.index')
            };
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
            
        ])->onlyInput('email');
        
    }

    // public function dashboardPage()
    // {
    //     if (Auth::check()) {
    //         return view('admin.dashboard');
    //     } else {
    //         return redirect()->route('login');
    //     }
    // }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }
    public function show(string $id)
    {
        //
    }

    public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ], [
        'email.exists' => 'We cannot find a user with that email address.'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
}

public function showResetForm(Request $request)
{
    return view('auth.reset-password', ['token' => $request->token]);
}

public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ],
    ], [
        'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.'
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
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

    public function manageUsers()
    {
        $users = User::where('role', '!=', 'ADMIN')->latest()->paginate(10);
        return view('admin.User.manageuser', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.User.edituser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'role' => 'required|in:user,ADMIN'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
    public function showProfile()
{
    $user = Auth::user();
    return view('user.profile', compact('user'));
}

public function editProfile()
{
    $user = Auth::user();
    return view('user.edit-profile', compact('user'));
}

public function updateProfile(Request $request)
{
    try {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:users,phone,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'phone.regex' => 'Please enter a valid phone number.',
            'phone.unique' => 'This phone number is already registered.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2MB.'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/profile'), $photoName);
            $data['photo'] = 'uploads/profile/' . $photoName;
        }

        try {
            User::where('id', $user->id)->update($data);
            return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your profile. Please try again.');
        }
    } catch (\Exception $e) {
        Log::error('Profile update error: ' . $e->getMessage());
        return back()->with('error', 'An error occurred while updating your profile. Please try again.');
    }
}
}
