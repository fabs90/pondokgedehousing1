<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    //
    public function incrementCounter(Request $request)
    {
        $entry = Traffic::where('type', 'whatsApp')->first();

        if ($entry) {
            $entry->counter += 1;
            $entry->save();
        } else {
            toast('Terjadi error!', 'error');
            return redirect()->back();
        }

    }

}
