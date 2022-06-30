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
                ->where('type', '=', 'gol')
                ->groupBy('player_id')
                ->orderByDesc('qtd_gols')
                ->get();
        
        $amarelos = Statistic::selectRaw('count(*) as qtd_amarelos, player_id')
                ->with('player')
                ->where('championship_id', '=', $id)
                ->where('type', '=', 'amarelo')
                ->groupBy('player_id')
                ->orderByDesc('qtd_amarelos')
                ->get();

        $vermelhos = Statistic::selectRaw('count(*) as qtd_vermelhos, player_id')
                ->with('player')
                ->where('championship_id', '=', $id)
                ->where('type', '=', 'vermelho')
                ->groupBy('player_id')
                ->orderByDesc('qtd_vermelhos')
                ->get();

        //echo $gols;
        return view('app.rankings', ['gols' => $gols, 'amarelos' => $amarelos, 'vermelhos' => $vermelhos]);
    }
}
