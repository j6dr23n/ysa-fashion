<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
/**
 * Login Using Facebook
 */
 public function loginUsingFacebook()
 {
    return Socialite::driver('facebook')->redirect();
 }

 public function callbackFromFacebook()
 {
  try {
       $user = Socialite::driver('facebook')->user();

       $saveUser = User::updateOrCreate([
           'facebook_id' => $user->getId(),
       ],[
           'name' => $user->getName(),
           'email' => $user->getEmail(),
           'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);

       Auth::login($saveUser);

       return redirect()->route('index.page');
       } catch (\Throwable $th) {
          throw $th;
       }
   }
   /**
  * Redirect the user to the Google authentication page.
  *
  * @return \Illuminate\Http\Response
  */
   public function loginUsingGoogle()
   {
      return Socialite::driver('google')->redirect();
   }

   public function callbackFromGoogle()
   {
      try {
         $user = Socialite::driver('google')->user();
  
         $saveUser = User::updateOrCreate([
             'google_id' => $user->getId(),
         ],[
             'name' => $user->getName(),
             'email' => $user->getEmail(),
             'password' => Hash::make($user->getName().'@'.$user->getId())
              ]);
  
         Auth::login($saveUser);
  
         return redirect()->route('index.page');
         } catch (\Throwable $th) {
            throw $th;
         }
   }
}
