<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Championship;
use App\Models\Table;

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
