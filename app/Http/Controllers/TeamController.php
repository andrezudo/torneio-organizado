<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Championship;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::all();

        return view('app.teams',['teams' => $teams]);
    }

    public function teams($id) {

        //$user = auth()->user();
        $championship = Championship::findOrFail($id);
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

        return redirect('/app/teams');
    }

    public function destroy($id) {
        Team::findOrFail($id)->delete();

        return redirect('/app/teams');
    }

    public function update(Request $request){
        Team::findOrFail($request->id)->update($request->all());

        return redirect('/app/teams');
    }
}
