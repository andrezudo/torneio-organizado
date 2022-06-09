<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;
use App\Models\Game;
use App\Models\Player;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::all();

        return view('app.teams',['teams' => $teams]);
    }

    public function teams($id) {

        //$user = auth()->user();
        $championship = Championship::findOrFail($id);
        //$championship = $request->session()->get('championship');
        $teams = $championship->teams;    

        return view('app.teams', ['teams' => $teams]);
    }

    public function store(Request $request) {
        $team = new Team;
        $team->name = $request->name;
        $user = auth()->user();
        $team->user_id = $user->id;
        $team->championship_id = $request->championship_id;
        $team->save();

        $table = new Table;
        $table->championship_id = $request->championship_id;
        $table->team_id = $team->id;
        $table->points = 0;
        $table->victory = 0;
        $table->defeat = 0;
        $table->draw = 0;
        $table->sg = 0;
        $table->save();

        //selecionar todos os times com id diferente do criado
        $teams = Team::where('id', '!=', $team->id)->where('championship_id', '=', $request->championship_id)->get();

        foreach ($teams as $teamm) {
            $game = new Game;
            $game->championship_id = $request->championship_id;
            $game->team1_id = $team->id;
            $game->team2_id = $teamm->id;
            $game->team1_goals = 0;
            $game->team2_goals = 0;
            $game->round = 1;
            $game->save();

            $championship = Championship::where('id', '=', $request->championship_id)->firstOrFail();
            if( $championship->return == 1){
                $game2 = new Game;
                $game2->championship_id = $request->championship_id;
                $game2->team1_id = $teamm->id;
                $game2->team2_id = $team->id;
                $game2->team1_goals = 0;
                $game2->team2_goals = 0;
                $game2->round = 1;
                $game2->save();
            }
        }

        //inserir jogadores enviados
        for ($i = 0; $i < count($request->name_players); $i++) {
            if ($request->name_players[$i] != '') {
                $player = new Player;
                $player->name = $request->name_players[$i];
                $player->team_id = $team->id;
                $player->save();
            }
        }

        return redirect()->route('teams', ['id' => $request->championship_id]);
        //return redirect('/app/teams');
    }

    public function destroy($id) {
        $team = Team::findOrFail($id);
        $championship_id = $team->championship_id;
        Team::findOrFail($id)->delete();

        return redirect()->route('teams', ['id' => $championship_id]);
        //return redirect('/app/teams');
    }

    public function update(Request $request){
        Team::findOrFail($request->id)->update($request->all());
        $team = Team::findOrFail($request->id);
        $championship_id = $team->championship_id;

        return redirect()->route('teams', ['id' => $championship_id]);
        //return redirect('/app/teams');
    }
}
