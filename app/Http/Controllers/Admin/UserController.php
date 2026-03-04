<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        $totalUsers = User::count();
        
        return view('admin.users.index', compact('users', 'totalUsers'));
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Prevent deleting admin accounts
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        // Store user name before deletion for success message
        $userName = $user->name;

        // Note: Orders are NOT deleted when user is deleted
        // The user_id in orders will be set to NULL (nullOnDelete foreign key constraint)
        // This preserves order history and revenue data for reporting purposes

        // Delete the user
        $user->delete();

        return redirect()->back()->with('success', "Akun pengguna {$userName} berhasil dihapus.");
    }
}
