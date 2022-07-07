<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;
use App\Models\Result;

class GameController extends Controller
{
    public function gerarJogos() {
        
    }

    public function games($id) {

        //$user = auth()->user();
        $championship = Championship::findOrFail($id);
        //$championship = $request->session()->get('championship');
        $teams = $championship->teams;
        //$games = $championship->games;
        $games = Game::with('team1','team2','result','gols','amarelos','vermelhos')->where('championship_id', '=', $id)->get();

        return view('app.jogos', ['teams' => $teams, 'games' => $games]);
    }

    public function store(Request $request) {
        $championship = Championship::where('id', '=', $request->championship_id)->firstOrFail();
        $championship->initiated = '1';
        $championship->save();
        $request->session()->put('championship', $championship);

        $game = new Game;
        $game->championship_id = $request->championship_id;
        $game->team1_id = $request->team1_id;
        $game->team2_id = $request->team2_id;
        //$game->team1_goals = $request->team1_goals;
        $game->team1_goals = 0;
        //$game->team2_goals = $request->team2_goals;
        $game->team2_goals = 0;
        $game->round = 1;
        $game->save();

        /*$model = User::where('votes', '>', 100)->firstOrFail();
        $table1 = Table::findOrFail($request->team1_id);
        $table2 = Table::findOrFail($request->team2_id);*/
        $table1 = Table::where('team_id', '=', $request->team1_id)->firstOrFail();
        $table2 = Table::where('team_id', '=', $request->team2_id)->firstOrFail();

        $table1->sg = $table1->sg + ($request->team1_goals - $request->team2_goals);
        $table2->sg = $table2->sg + ($request->team2_goals - $request->team1_goals);

        if( $request->team1_goals > $request->team2_goals){
            $table1->points = $table1->points + 3;
            $table1->victory = $table1->victory + 1;
            $table2->defeat = $table2->defeat + 1;
        }elseif($request->team1_goals < $request->team2_goals){
            $table2->points = $table2->points + 3;
            $table2->victory = $table2->victory + 1;
            $table1->defeat = $table1->defeat + 1;
        }elseif ($request->team1_goals == $request->team2_goals) {
            $table1->points = $table1->points + 1;
            $table2->points = $table2->points + 1;
            $table2->draw = $table2->draw + 1;
            $table1->draw = $table1->draw + 1;
        }

        //$table1->save();
        //$table2->save();

        return redirect()->route('games', ['id' => $request->championship_id]);

        /*
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
        */

        //return redirect('/app/teams');
    }
    
}
