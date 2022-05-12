<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;

class GameController extends Controller
{
    public function gerarJogos() {
        
    }

    public function games($id) {

        //$user = auth()->user();
        $championship = Championship::findOrFail($id);
        //$championship = $request->session()->get('championship');
        $teams = $championship->teams;
        $games = $championship->games;

        return view('app.jogos', ['teams' => $teams, 'games' => $games]);
    }

    public function store(Request $request) {
        $game = new Game;
        $game->championship_id = $request->championship_id;
        $game->team1_id = $request->team1_id;
        $game->team2_id = $request->team2_id;
        $game->team1_goals = $request->team1_goals;
        $game->team2_goals = $request->team2_goals;
        $game->round = 1;
        $game->save();

        $table1 = new Table;
        $table1->championship_id = $request->championship_id;
        $table1->team_id = $request->team1_id;
        $table1->sg = ($request->team1_goals - $request->team2_goals);
        $table1->victory = 0;
        $table1->defeat = 0;
        $table1->draw = 0;
        if ($request->team1_goals > $request->team2_goals) {
            $table1->points = 3;
            $table1->victory = 1;
        }elseif ($request->team1_goals < $request->team2_goals) {
            $table1->points = 0;
            $table1->defeat = 1;
        }elseif ($request->team1_goals == $request->team2_goals) {
            $table1->points = 1;
            $table1->draw = 1;
        }
        $table1->save();

        $table2 = new Table;
        $table2->championship_id = $request->championship_id;
        $table2->team_id = $request->team2_id;
        $table2->sg = ($request->team2_goals - $request->team1_goals);
        $table2->victory = 0;
        $table2->defeat = 0;
        $table2->draw = 0;
        if ($request->team2_goals > $request->team1_goals) {
            $table2->points = 3;
            $table2->victory = 1;
        }elseif ($request->team2_goals < $request->team1_goals) {
            $table2->points = 0;
            $table2->defeat = 1;
        }elseif ($request->team1_goals == $request->team2_goals) {
            $table2->points = 1;
            $table2->draw = 1;
        }
        $table2->save();


        return redirect()->route('games', ['id' => $request->championship_id]);
        //return redirect('/app/teams');
    }
    
}
