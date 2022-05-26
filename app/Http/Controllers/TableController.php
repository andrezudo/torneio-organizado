<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Table;

class TableController extends Controller
{
    public function tabela($id) {

        //$championship = Championship::findOrFail($id);
        //$tables = $championship->tables;
        
        /*$tables = Table::where('Championship_id', '=', $id)
                    ->orderBy('points', 'desc')
                    ->orderBy('victory', 'desc')
                    ->orderBy('sg', 'desc')
                    ->orderBy('id', 'asc')
                    ->get();*/
        
        $tables = Table::with('team')
                    ->where('Championship_id', '=', $id)
                    ->orderBy('points', 'desc')
                    ->orderBy('victory', 'desc')
                    ->orderBy('sg', 'desc')
                    ->orderBy('id', 'asc')
                    ->get();

        return view('app.tabela', ['tables' => $tables]);
    }
}
