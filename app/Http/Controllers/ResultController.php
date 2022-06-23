<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;
use App\Models\Result;

class ResultController extends Controller
{
    
    public function store(Request $request) {
        
        $result = new Result;
        if(isset($request->team1_goals)) {
            $team1_goals = count($request->team1_goals);
        }else {
            $team1_goals = 0;
        }
        if(isset($request->team2_goals)) {
            $team2_goals = count($request->team2_goals);
        }else {
            $team2_goals = 0;
        }

        if (isset($request->team1_yellowcard)) {
            $team1_yellowcard = count($request->team1_yellowcard);
        } else {
            $team1_yellowcard = 0;
        }
        if (isset($request->team2_yellowcard)) {
            $team2_yellowcard = count($request->team2_yellowcard);
        } else {
            $team2_yellowcard = 0;
        }

        if (isset($request->team1_redcard)) {
            $team1_redcard = count($request->team1_redcard);
        } else {
            $team1_redcard = 0;
        }
        if (isset($request->team2_redcard)) {
            $team2_redcard = count($request->team2_redcard);
        } else {
            $team2_redcard = 0;
        }

        /*
        echo $team1_goals.' - '.$team2_goals.'<br>';
        echo $team1_yellowcard.' - '.$team2_yellowcard.'<br>';
        echo $team1_redcard.' - '.$team2_redcard;
        */

        $result->championship_id = $request->championship_id;
        $result->game_id = $request->game_id;
        $result->team1_goals = $team1_goals;
        $result->team1_yellowcard = $team1_yellowcard;
        $result->team1_redcard = $team1_redcard;
        $result->team2_goals = $team2_goals;
        $result->team2_yellowcard = $team2_yellowcard;
        $result->team2_redcard = $team2_redcard;
        $result->save();


        $table1 = Table::where('team_id', '=', $request->team1_id)->firstOrFail();
        $table2 = Table::where('team_id', '=', $request->team2_id)->firstOrFail();

        $table1->sg = $table1->sg + ($team1_goals - $team2_goals);
        $table2->sg = $table2->sg + ($team2_goals - $team1_goals);

        if( $team1_goals > $team2_goals){
            $table1->points = $table1->points + 3;
            $table1->victory = $table1->victory + 1;
            $table2->defeat = $table2->defeat + 1;
        }elseif($team1_goals < $team2_goals){
            $table2->points = $table2->points + 3;
            $table2->victory = $table2->victory + 1;
            $table1->defeat = $table1->defeat + 1;
        }elseif ($team1_goals == $team2_goals) {
            $table1->points = $table1->points + 1;
            $table2->points = $table2->points + 1;
            $table2->draw = $table2->draw + 1;
            $table1->draw = $table1->draw + 1;
        }

        $table1->save();
        $table2->save();
        

        return redirect()->route('games', ['id' => $request->championship_id]);
    }

    public function update(Request $request) {

        $result = new Result;
        $result->championship_id = $request->championship_id;
        $result->game_id = $request->game_id;
        $result->team1_goals = $request->team1_goals;
        $result->team1_yellowcard = $request->team1_yellowcard;
        $result->team1_redcard = $request->team1_redcard;
        $result->team2_goals = $request->team2_goals;
        $result->team2_yellowcard = $request->team2_yellowcard;
        $result->team2_redcard = $request->team2_redcard;

        $game = Game::where('id', '=', $request->game_id)->firstOrFail();

        $table1 = Table::where('team_id', '=', $game->team1_id)->firstOrFail();
        $table2 = Table::where('team_id', '=', $game->team2_id)->firstOrFail();

        $result_antigo = Result::findOrFail($request->id);
        //remove o saldo de gols antigo e a pontuação na tabela
        $table1->sg = $table1->sg - ($result_antigo->team1_goals - $result_antigo->team2_goals);
        $table2->sg = $table2->sg - ($result_antigo->team2_goals - $result_antigo->team1_goals);

        if( $result_antigo->team1_goals > $result_antigo->team2_goals){ //vitória do time 1
            $table1->points = $table1->points - 3;
            $table1->victory = $table1->victory - 1;
            $table2->defeat = $table2->defeat - 1;
        }elseif($result_antigo->team1_goals < $result_antigo->team2_goals){ //empate
            $table2->points = $table2->points - 3;
            $table2->victory = $table2->victory - 1;
            $table1->defeat = $table1->defeat - 1;
        }elseif ($result_antigo->team1_goals == $result_antigo->team2_goals) { //vitória do time 2
            $table1->points = $table1->points - 1;
            $table2->points = $table2->points - 1;
            $table2->draw = $table2->draw - 1;
            $table1->draw = $table1->draw - 1;
        }
        
        //adiciona o novo saldo de gols e pontuação na tabela
        $table1->sg = $table1->sg + ($request->team1_goals - $request->team2_goals);
        $table2->sg = $table2->sg + ($request->team2_goals - $request->team1_goals);

        if( $request->team1_goals > $request->team2_goals){ //vitória do time 1
            $table1->points = $table1->points + 3;
            $table1->victory = $table1->victory + 1;
            $table2->defeat = $table2->defeat + 1;
        }elseif($request->team1_goals < $request->team2_goals){ //empate
            $table2->points = $table2->points + 3;
            $table2->victory = $table2->victory + 1;
            $table1->defeat = $table1->defeat + 1;
        }elseif ($request->team1_goals == $request->team2_goals) { //vitória do time 2
            $table1->points = $table1->points + 1;
            $table2->points = $table2->points + 1;
            $table2->draw = $table2->draw + 1;
            $table1->draw = $table1->draw + 1;
        }

        $table1->save();
        $table2->save();
        Result::findOrFail($request->id)->update($request->all());

        return redirect()->route('games', ['id' => $request->championship_id]);
    }

}
