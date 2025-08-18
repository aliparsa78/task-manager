<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function profile_image(Request $request)

    {
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        // Remove the last photo if exist
        
        
        if($request->hasFile('profile')){
            if($user->profile && Storage::disk('public')->exists($user->profile)){
                Storage::disk('public')->delete($user->profile);
            }
           
            $image = $request->profile;
            $filename = time().'_'.$image->getClientOriginalName();
            $filePath=$image->storeAs('Profile', $filename , 'public');
            $user->profile = $filename;
            $user->update();
            return redirect('/profile')->with('success','Car information has been added successfuly ');
        }else{
            return "no";
        }
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 
       
        
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
