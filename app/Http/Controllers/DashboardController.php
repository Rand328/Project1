<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
 
class DashboardController extends Controller
{
 
 //use AuthorizesRequests, ValidatesRequests; Laravel already includes this trait so gives error
 
   
 public function dashboard()
 {
     $userRoles = [];
     $authUser = Auth::user();
 
     // Check if the authenticated user is an admin
     if ($authUser && $authUser->role === 'admin') {
         // Fetch only the relevant user data for admins
         $userRoles = User::select('id', 'name', 'role')->get();
     }
 
     return view('dashboard', ['userRoles' => $userRoles, 'authUser' => $authUser]);
 }

}