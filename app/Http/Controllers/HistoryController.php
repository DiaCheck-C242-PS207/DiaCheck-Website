<?php

namespace App\Http\Controllers;

use App\Models\Predictions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Predictions::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('pages.history', [
            'title' => 'History - DiaCheck',
            'active' => 'profile',
            'histories' => $histories,
        ]);
    }

    public function destroy($id)
    {
        $prediction = Predictions::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$prediction) {
            return redirect()->route('history.index')->with('error', 'History not found or you do not have permission to delete it.');
        }

        $prediction->delete();

        return redirect()->route('history.index')->with('success', 'History deleted successfully!');
    }
}
