<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
 
        $incomingFields=$request->validate(['name'=>'required','email'=>['required','email', Rule::unique('users','email')], 'password'=>'required']);       
        $incomingFields['password']=bcrypt($incomingFields['password']); //thats the shortcut of;  $incomingFields['password'] = Hash::make($incomingFields['password']);

        $user=User::create($incomingFields);//saves the new user into the users table using Laravel's built-in User model.,( which its model is called User)
        auth()->login($user);    //tells us that to automatically login the authenticated user, not need to manually login
        session()->flash("success","you we're log-in and registered successflyy");
   
    return redirect('/home'); //that authenticated user automatilly retrn him to home page;
 // that '/home' is url and not page;
}


public function login(Request $request){
    // Check that the form inputs 'loginname' and 'loginpassword' are filled
    $inputFields = $request->validate([
        'loginname' => 'required',
        'loginpassword' => 'required', 
    ]);

    if (auth()->attempt(['name' => $inputFields['loginname'], 'password' => $inputFields['loginpassword']])) {  //The purpose of attempt is to try logging the user in by checking if the provided credentials match a user in the database.
         
// MEANS ->Look for a user with the given name (username). Check if the given password matches the stored hashed password. If both match, log the user in and return true. If not, return false.

        $request->session()->regenerate();  // If successful, create a new session ID for security     
        return redirect('home');// Send the user to the homepage or dashboard
    }
else{
    return back()->withErrors([  // If login fails, go back to the login form with an error message
        'loginError' => 'Invalid login credentials.',
    ])->withInput();
    }
}

public function aloneNotes(){
// $notes = Post::all();  // if we may use this, it will shwo all posts of any one
  
// $notes = []; is a safe default.Prevents errors when no user is logged in.
$notes = [];
if (auth()->check()){
    $notes = auth()->user()->usersNotes()->latest()->get();

}
return view('home_page',['notes'=>$notes] );  //MEANS: Load the view called home_page.blade.php Inside that view, give me access to a variable called $notes that contains the value of the $notes array from the controller

// auth()->check(): Checks if a user is logged in.
// auth()->user(): Gets the currently authenticated user.
// usersNotes(): This is a custom relationship method (probably a hasMany or similar) defined in your User model.
// latest(): Orders the posts by the created_at column in descending order (newest first).
// view('home', [...]): Loads the home.blade.php view and passes the posts.

// $posts = [];
// simply initializes an empty array called $posts.
// It ensures that $posts is always defined, even if the user is not logged in.

// If the user is not authenticated (auth()->check() is false), then $posts remains an empty array.
// This avoids errors like “undefined variable” in your Blade view (home.blade.php), where you are expecting a posts variable.
}

public function logout(){
    auth()->logout();
    return redirect('/');
}

}