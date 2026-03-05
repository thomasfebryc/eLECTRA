<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Dashboard admin.
     */
    public function index()
    {
        $transactions = DB::table('transactions')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $totalAdmins = User::where('role', 'admin')->count();
        $totalUsers = User::count();

        return view('admin', compact('transactions', 'totalAdmins', 'totalUsers'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function promote($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->back()->with('info', 'User ini sudah merupakan admin.');
        }

        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User berhasil dipromosikan menjadi admin.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return redirect()->route('admin.users')->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

  public function billing()
{
    $bills = Bill::with('user')->orderByDesc('created_at')->get();

    return view('admin.billing.index', compact('bills'));
}

    
}
