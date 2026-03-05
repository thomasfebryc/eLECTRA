<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Confirmation;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function show($id)
    {
        $confirmation = Confirmation::with('transaction.user', 'transaction.token')->findOrFail($id);
        return view('admin.confirmations.show', compact('confirmation'));
    }
}
