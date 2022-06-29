<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;

class StatisticController extends Controller
{
    public function statistics($id) {

        //SELECT player_id,COUNT(`player_id`) AS qtd FROM `statistics` WHERE `type` = 'gol' GROUP BY player_id ORDER BY qtd DESC;
        $gols = Statistic::selectRaw('count(*) as qtd_gols, player_id')
                ->with('player')
                ->where('championship_id', '=', $id)
                ->groupBy('player_id')
                ->limit(3)
                ->get();

        //echo $gols;
        return view('app.rankings', ['gols' => $gols]);
    }
}
