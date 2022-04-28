<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    /*public function players() {   

        return view('app.players');
    }*/

    public function players($id) {

        $team = Team::findOrFail($id);
        $players = $team->players;

        return view('app.players', ['players' => $players, 'team' => $team]);
    }

    public function update(Request $request){
        Player::findOrFail($request->id)->update($request->all());
        $team = Player::findOrFail($request->id)->team_id;

        //return redirect('/app/teams');
        return redirect()->route('players', ['id' => $team]);
    }

    public function destroy($id) {
        $team = Player::findOrFail($id)->team_id;
        Player::findOrFail($id)->delete();

        //return redirect('/app/teams');
        return redirect()->route('players', ['id' => $team]);
    }

    public function store(Request $request) {
        $player = new Player;
        $player->name = $request->name;
        $player->team_id = $request->team_id;

        $player->save();

        return redirect()->route('players', ['id' => $request->team_id]);
        
    }

}
