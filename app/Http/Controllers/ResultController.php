<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;
use App\Models\Result;
use App\Models\Statistic;

class ResultController extends Controller
{
    
    public function store(Request $request) {
        
        $result = new Result;
        if(isset($request->team1_goals)) {
            $team1_goals = count($request->team1_goals);

            for ($i = 0; $i < $team1_goals; $i++) {
                if ($request->team1_goals[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "gol";
                    $statistic->player_id = $request->team1_goals[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        }else {
            $team1_goals = 0;
        }
        if(isset($request->team2_goals)) {
            $team2_goals = count($request->team2_goals);

            for ($i = 0; $i < $team2_goals; $i++) {
                if ($request->team2_goals[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "gol";
                    $statistic->player_id = $request->team2_goals[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        }else {
            $team2_goals = 0;
        }

        if (isset($request->team1_yellowcard)) {
            $team1_yellowcard = count($request->team1_yellowcard);

            for ($i = 0; $i < $team1_yellowcard; $i++) {
                if ($request->team1_yellowcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "amarelo";
                    $statistic->player_id = $request->team1_yellowcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team1_yellowcard = 0;
        }
        if (isset($request->team2_yellowcard)) {
            $team2_yellowcard = count($request->team2_yellowcard);

            for ($i = 0; $i < $team2_yellowcard; $i++) {
                if ($request->team2_yellowcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "amarelo";
                    $statistic->player_id = $request->team2_yellowcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team2_yellowcard = 0;
        }

        if (isset($request->team1_redcard)) {
            $team1_redcard = count($request->team1_redcard);

            for ($i = 0; $i < $team1_redcard; $i++) {
                if ($request->team1_redcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "vermelho";
                    $statistic->player_id = $request->team1_redcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team1_redcard = 0;
        }
        if (isset($request->team2_redcard)) {
            $team2_redcard = count($request->team2_redcard);

            for ($i = 0; $i < $team2_redcard; $i++) {
                if ($request->team2_redcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "vermelho";
                    $statistic->player_id = $request->team2_redcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
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

        $deleted_statistics = Statistic::where('game_id', $request->game_id)->delete();

        if(isset($request->team1_goals)) {
            $team1_goals = count($request->team1_goals);

            for ($i = 0; $i < $team1_goals; $i++) {
                if ($request->team1_goals[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "gol";
                    $statistic->player_id = $request->team1_goals[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        }else {
            $team1_goals = 0;
        }
        if(isset($request->team2_goals)) {
            $team2_goals = count($request->team2_goals);

            for ($i = 0; $i < $team2_goals; $i++) {
                if ($request->team2_goals[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "gol";
                    $statistic->player_id = $request->team2_goals[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        }else {
            $team2_goals = 0;
        }

        if (isset($request->team1_yellowcard)) {
            $team1_yellowcard = count($request->team1_yellowcard);

            for ($i = 0; $i < $team1_yellowcard; $i++) {
                if ($request->team1_yellowcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "amarelo";
                    $statistic->player_id = $request->team1_yellowcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team1_yellowcard = 0;
        }
        if (isset($request->team2_yellowcard)) {
            $team2_yellowcard = count($request->team2_yellowcard);

            for ($i = 0; $i < $team2_yellowcard; $i++) {
                if ($request->team2_yellowcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "amarelo";
                    $statistic->player_id = $request->team2_yellowcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team2_yellowcard = 0;
        }

        if (isset($request->team1_redcard)) {
            $team1_redcard = count($request->team1_redcard);

            for ($i = 0; $i < $team1_redcard; $i++) {
                if ($request->team1_redcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "vermelho";
                    $statistic->player_id = $request->team1_redcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team1_id;
                    $statistic->adversary = $request->team2_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team1_redcard = 0;
        }
        if (isset($request->team2_redcard)) {
            $team2_redcard = count($request->team2_redcard);

            for ($i = 0; $i < $team2_redcard; $i++) {
                if ($request->team2_redcard[$i] != '') {
                    $statistic = new Statistic;
                    $statistic->type = "vermelho";
                    $statistic->player_id = $request->team2_redcard[$i];
                    $statistic->game_id = $request->game_id;
                    $statistic->team_id = $request->team2_id;
                    $statistic->adversary = $request->team1_id;
                    $statistic->championship_id = $request->championship_id;
                    $statistic->save();
                }
            }
        } else {
            $team2_redcard = 0;
        }

        /*
        echo $team1_goals.' - '.$team2_goals.'<br>';
        echo $team1_yellowcard.' - '.$team2_yellowcard.'<br>';
        echo $team1_redcard.' - '.$team2_redcard;
        */

        //$result = new Result;
        $result = Result::where('id', '=', $request->id)->firstOrFail();
        $result->championship_id = $request->championship_id;
        $result->game_id = $request->game_id;
        $result->team1_goals = $team1_goals;
        $result->team1_yellowcard = $team1_yellowcard;
        $result->team1_redcard = $team1_redcard;
        $result->team2_goals = $team2_goals;
        $result->team2_yellowcard = $team2_yellowcard;
        $result->team2_redcard = $team2_redcard;

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
        $table1->sg = $table1->sg + ($team1_goals - $team2_goals);
        $table2->sg = $table2->sg + ($team2_goals - $team1_goals);

        if( $team1_goals > $team2_goals){ //vitória do time 1
            $table1->points = $table1->points + 3;
            $table1->victory = $table1->victory + 1;
            $table2->defeat = $table2->defeat + 1;
        }elseif($team1_goals < $team2_goals){ //empate
            $table2->points = $table2->points + 3;
            $table2->victory = $table2->victory + 1;
            $table1->defeat = $table1->defeat + 1;
        }elseif ($team1_goals == $team2_goals) { //vitória do time 2
            $table1->points = $table1->points + 1;
            $table2->points = $table2->points + 1;
            $table2->draw = $table2->draw + 1;
            $table1->draw = $table1->draw + 1;
        }

        $table1->save();
        $table2->save();
        $result->save();
        //Result::findOrFail($request->id)->update($request->all());

        return redirect()->route('games', ['id' => $request->championship_id]);
    }

}
