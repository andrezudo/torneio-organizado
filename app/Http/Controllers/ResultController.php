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
        $result->championship_id = $request->championship_id;
        $result->game_id = $request->game_id;
        $result->team1_goals = $request->team1_goals;
        $result->team1_yellowcard = $request->team1_yellowcard;
        $result->team1_redcard = $request->team1_redcard;
        $result->team2_goals = $request->team2_goals;
        $result->team2_yellowcard = $request->team2_yellowcard;
        $result->team2_redcard = $request->team2_redcard;
        $result->save();


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

        $table1->save();
        $table2->save();
        

        return redirect()->route('games', ['id' => $request->championship_id]);
    }

}
