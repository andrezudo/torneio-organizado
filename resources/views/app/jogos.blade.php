<?php 
$inicio = '';
$times = '';
$classificacao = '';
$jogos = 'active';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Jogos')
    
@section('content')

                <div class="container">
                    <div class="row mt-5 mb-4 text-white">
                        <div class="d-flex justify-content-between mb-5">
                            <h2>Jogos do campeonato</h2>
                            <div>
                                @if ( session('championship')->initiated == '0' )
                                    <a type="button" href="/app/iniciar-campeonato/{{session('championship')->id}}" class="btn btn-register">
                                        <i class="fa-solid fa-circle-play"></i> Inicar campeonato
                                    </a>
                                @else
                                    <button type="button" class="btn btn-register" disabled>
                                        <i class="fa-solid fa-futbol"></i> Campeonato Iniciado
                                    </button>
                                @endif
                                <!--
                                <a type="button" href="/app/gerar-jogos" class="btn btn-register">
                                    <i class="fa-solid fa-plus"></i> Adicionar jogo
                                </a>
                                -->
                                <!--
                                <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#gameModal">
                                    <i class="fa-solid fa-plus"></i> Adicionar jogo
                                </button>
                                -->
                            </div>
                        </div>
                    </div>
                </div>  
                
                <div class="container mt-5 mb-5 text-white">

                    <hr>

                    @if ( $games->count() == 0 )
                        <div class="col-12 mb-5 mt-5 text-white text-center">
                            <h3>Nenhuma partida por enquanto</h3>
                        </div>
                    @endif

                      @foreach ($games as $game)

                      <div class="text-center d-flex justify-content-around">
                        <div class="d-flex justify-content-evenly w-75">
                          <div class="text-center w-25">
                              <p>{{$game->team1->name}} <i class="fa-solid fa-shield-halved"></i></p>
                          </div>
                          <div class="d-flex justify-content-evenly">
                              <div class="mx-2">
                                @if ( $game->result == null)
                                    <p><span><b></b> </span></p> 
                                @else
                                    <p><span><b>{{$game->result->team1_goals}}</b> </span></p>
                                @endif
                              </div>
                              <div class="mx-2">
                                <p><span> X </span></p>
                              </div>
                              <div class="mx-2">
                                @if ( $game->result == null)
                                    <P> <span><b></b></span></P>
                                @else
                                    <P><span><b> {{$game->result->team2_goals}}</b></span></P>
                                @endif
                              </div>
                          </div>
                          <div class="text-center w-25">
                            <p><i class="fa-solid fa-shield-halved"></i> {{$game->team2->name}}</p>
                          </div>
                        </div>
                        <div>
                            @if ( session('championship')->initiated == '1' )
                                @if ( $game->result == null)
                                    <!--
                                    <button style="background: #8BC34A;border-color: #8BC34A;" type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#resultModal{{$game->id}}">
                                        <i class="fas fa-futbol"></i>
                                    </button>
                                    -->
                                    <button style="background: #8BC34A;border-color: #8BC34A;" type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#resultTesteModal{{$game->id}}">
                                        <i class="fas fa-futbol"></i>
                                    </button>
                                @else
                                    <!--
                                    <button type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#resultEditModal{{$game->id}}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    -->
                                    <button type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#resultEditModalTest{{$game->id}}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                @endif
                            @endif
                        </div>
                      </div>
                      <hr>

                      @if ($game->result != null)
                      <!-- Modal Editar Resultado-->
                      <div class="modal fade" id="resultEditModal{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content text-black">
                            <div class="modal-header">
                            <h5 class="modal-title text-black" id="exampleModalLabel">Editar Resultado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/app/update-result/{{$game->result->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                        <input type="text" class="form-control" id="game_id" name="game_id" value="{{$game->id}}" style="display: none;">
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-label">{{$game->team1->name}}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team1_goals">Gols:</label>
                                                <input type="number" class="form-control" id="team1_goals" name="team1_goals" value="{{$game->result->team1_goals}}">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team1_yellowcard">Cartões amarelos:</label>
                                                <input type="number" class="form-control" id="team1_yellowcard" name="team1_yellowcard" value="{{$game->result->team1_yellowcard}}">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team1_redcard">Cartões amarelos:</label>
                                                <input type="number" class="form-control" id="team1_redcard" name="team1_redcard" value="{{$game->result->team1_redcard}}">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-label">{{$game->team2->name}}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team2_goals">Gols:</label>
                                                <input type="number" class="form-control" id="team2_goals" name="team2_goals" value="{{$game->result->team2_goals}}">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team2_yellowcard">Cartões amarelos:</label>
                                                <input type="number" class="form-control" id="team2_yellowcard" name="team2_yellowcard" value="{{$game->result->team2_yellowcard}}">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="team2_redcard">Cartões vermelhos:</label>
                                                <input type="number" class="form-control" id="team2_redcard" name="team2_redcard" value="{{$game->result->team2_redcard}}">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                      </div>

                      <!-- Modal Editar Resultado Teste-->
                      <div class="modal fade" id="resultEditModalTest{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content text-black">
                                <div class="modal-header">
                                <h5 class="modal-title text-black" id="exampleModalLabel">Editar Resultado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/app/update-result/{{$game->result->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                            <input type="text" class="form-control" id="game_id" name="game_id" value="{{$game->id}}" style="display: none;">
                                            <input type="text" class="form-control" id="team1_id" name="team1_id" value="{{$game->team1_id}}" style="display: none;">
                                            <input type="text" class="form-control" id="team2_id" name="team2_id" value="{{$game->team2_id}}" style="display: none;">
                                        </div>
                                        <div class="mb-5">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>{{$game->team1->name}}</h4>
                                                </div>
                                                <div class="col-sm-4 container-gols-t1{{$game->id}}">
                                                    <label class="form-label">Gols</label>
                                                    <a class="btn btn-sm btn-primary add_gol_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->gols as $team1_goals)
                                                        @if ($team1_goals->team_id == $game->team1->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team1_goals" name="team1_goals[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team1->players as $playerr1)
                                                                        <option value="{{$playerr1->id}}" {{$team1_goals->player_id == $playerr1->id ? "selected='selected'" : ""}}>{{$playerr1->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-4 container-ca-t1{{$game->id}}">
                                                    <label class="form-label">Cartões amarelos</label>
                                                    <a class="btn btn-sm btn-primary add_ca_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->amarelos as $team1_yellowcards)
                                                        @if ($team1_yellowcards->team_id == $game->team1->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team1_yellowcard" name="team1_yellowcard[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team1->players as $playerr1)
                                                                        <option value="{{$playerr1->id}}" {{$team1_yellowcards->player_id == $playerr1->id ? "selected='selected'" : ""}}>{{$playerr1->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-4 container-cv-t1{{$game->id}}">
                                                    <label class="form-label">Cartões vermelhos</label>
                                                    <a class="btn btn-sm btn-primary add_cv_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->vermelhos as $team1_redcards)
                                                        @if ($team1_redcards->team_id == $game->team1->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team1_redcard" name="team1_redcard[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team1->players as $playerr1)
                                                                        <option value="{{$playerr1->id}}" {{$team1_redcards->player_id == $playerr1->id ? "selected='selected'" : ""}}>{{$playerr1->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>  
                                        </div>
                                        <hr>
                                        <div class="mb-3 mt-5">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>{{$game->team2->name}}</h4>
                                                </div>
                                                <div class="col-sm-4 container-gols-t2{{$game->id}}">
                                                    <label class="form-label">Gols</label> 
                                                    <a class="btn btn-sm btn-primary add_gol_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->gols as $team2_goals)
                                                        @if ($team2_goals->team_id == $game->team2->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team2_goals" name="team2_goals[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team2->players as $playerr2)
                                                                        <option value="{{$playerr2->id}}" {{$team2_goals->player_id == $playerr2->id ? "selected='selected'" : ""}}>{{$playerr2->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-4 container-ca-t2{{$game->id}}">
                                                    <label class="form-label">Cartões amarelos</label>
                                                    <a class="btn btn-sm btn-primary add_ca_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->amarelos as $team2_yellowcards)
                                                        @if ($team2_yellowcards->team_id == $game->team2->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team2_yellowcard" name="team2_yellowcard[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team2->players as $playerr2)
                                                                        <option value="{{$playerr2->id}}" {{$team2_yellowcards->player_id == $playerr2->id ? "selected='selected'" : ""}}>{{$playerr2->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-4 container-cv-t2{{$game->id}}">
                                                    <label class="form-label">Cartões vermelhos</label>
                                                    <a class="btn btn-sm btn-primary add_cv_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                                    @foreach ($game->vermelhos as $team2_redcards)
                                                        @if ($team2_redcards->team_id == $game->team2->id)
                                                            <div class="row mt-2">
                                                                <div class="col-10">
                                                                    <select class="form-select" id="team2_redcard" name="team2_redcard[]" aria-label="Default select example">
                                                                        <option selected value="futebol">Selecione o Jogador</option>
                                                                        @foreach ( $game->team2->players as $playerr2)
                                                                        <option value="{{$playerr2->id}}" {{$team2_redcards->player_id == $playerr2->id ? "selected='selected'" : ""}}>{{$playerr2->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>
                      @endif

                      <!-- Modal adicionar Resultado-->
                      <div class="modal fade" id="resultModal{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content text-black">
                            <div class="modal-header">
                            <h5 class="modal-title text-black" id="exampleModalLabel">Adicionar Resultado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/app/result" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                        <input type="text" class="form-control" id="game_id" name="game_id" value="{{$game->id}}" style="display: none;">
                                        <input type="text" class="form-control" id="team1_id" name="team1_id" value="{{$game->team1_id}}" style="display: none;">
                                        <input type="text" class="form-control" id="team2_id" name="team2_id" value="{{$game->team2_id}}" style="display: none;">
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-label">{{$game->team1->name}}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team1_goals" name="team1_goals" placeholder="Gols">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team1_yellowcard" name="team1_yellowcard" placeholder="Cartões amarelos">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team1_redcard" name="team1_redcard" placeholder="Cartões vermelhos">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-label">{{$game->team2->name}}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team2_goals" name="team2_goals" placeholder="Gols">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team2_yellowcard" name="team2_yellowcard" placeholder="Cartões amarelos">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="team2_redcard" name="team2_redcard" placeholder="Cartões vermelhos">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                      </div>

                      <!-- Modal adicionar Resultado Teste-->
                      <div class="modal fade" id="resultTesteModal{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content text-black">
                            <div class="modal-header">
                            <h5 class="modal-title text-black" id="exampleModalLabel">Adicionar Resultado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/app/result" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                        <input type="text" class="form-control" id="game_id" name="game_id" value="{{$game->id}}" style="display: none;">
                                        <input type="text" class="form-control" id="team1_id" name="team1_id" value="{{$game->team1_id}}" style="display: none;">
                                        <input type="text" class="form-control" id="team2_id" name="team2_id" value="{{$game->team2_id}}" style="display: none;">
                                    </div>
                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>{{$game->team1->name}}</h4>
                                            </div>
                                            <div class="col-sm-4 container-gols-t1{{$game->id}}">
                                                <label class="form-label">Gols</label> 
                                                <a class="btn btn-sm btn-primary add_gol_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                            <div class="col-sm-4 container-ca-t1{{$game->id}}">
                                                <label class="form-label">Cartões amarelos</label>
                                                <a class="btn btn-sm btn-primary add_ca_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                            <div class="col-sm-4 container-cv-t1{{$game->id}}">
                                                <label class="form-label">Cartões vermelhos</label>
                                                <a class="btn btn-sm btn-primary add_cv_t1{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>  
                                    </div>
                                    <hr>
                                    <div class="mb-3 mt-5">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>{{$game->team2->name}}</h4>
                                            </div>
                                            <div class="col-sm-4 container-gols-t2{{$game->id}}">
                                                <label class="form-label">Gols</label> 
                                                <a class="btn btn-sm btn-primary add_gol_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                            <div class="col-sm-4 container-ca-t2{{$game->id}}">
                                                <label class="form-label">Cartões amarelos</label>
                                                <a class="btn btn-sm btn-primary add_ca_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                            <div class="col-sm-4 container-cv-t2{{$game->id}}">
                                                <label class="form-label">Cartões vermelhos</label>
                                                <a class="btn btn-sm btn-primary add_cv_t2{{$game->id}}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                      </div>

                      <script>
                        $(document).ready(function() {
                      
                            //adicionar gols time 1 
                            var container_gols_t1 = $(".container-gols-t1{{$game->id}}");
                            var add_button_gt1 = $(".add_gol_t1{{$game->id}}");
                            var x_gt1 = 1;
                            $(add_button_gt1).click(function(e) {
                                e.preventDefault();
                                x_gt1++;
                                $(container_gols_t1).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team1_goals" name="team1_goals[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team1->players as $playerr1)
                                              <option value="{{$playerr1->id}}">{{$playerr1->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_gols_t1).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x_gt1--;
                            })
                            // fim add gols t1
                      
                            //adicionar cartões amarelos time 1
                            var container_ca_t1 = $(".container-ca-t1{{$game->id}}");
                            var add_button_cat1 = $(".add_ca_t1{{$game->id}}");
                            var x_cat1 = 1;
                            $(add_button_cat1).click(function(e) {
                                e.preventDefault();
                                x_cat1++;
                                $(container_ca_t1).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team1_yellowcard" name="team1_yellowcard[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team1->players as $playerr)
                                              <option value="{{$playerr->id}}">{{$playerr->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_ca_t1).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x_cat1--;
                            })
                            // fim add ca t1
                      
                            //adicionar cartões vermelhos time 1
                            var container_cv_t1 = $(".container-cv-t1{{$game->id}}");
                            var add_button_cvt1 = $(".add_cv_t1{{$game->id}}");
                            var x_cvt1 = 1;
                            $(add_button_cvt1).click(function(e) {
                                e.preventDefault();
                                x_cvt1++;
                                $(container_cv_t1).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team1_redcard" name="team1_redcard[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team1->players as $playerr)
                                              <option value="{{$playerr->id}}">{{$playerr->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_cv_t1).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x_cvt1--;
                            })
                            // fim add cv t1
                      
                            //adicionar gols time 2  
                            var container_gols_t2 = $(".container-gols-t2{{$game->id}}");
                            var add_button = $(".add_gol_t2{{$game->id}}");
                            var x = 1;
                            $(add_button).click(function(e) {
                                e.preventDefault();
                                x++;
                                $(container_gols_t2).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team2_goals" name="team2_goals[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team2->players as $playerr)
                                              <option value="{{$playerr->id}}">{{$playerr->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_gols_t2).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x--;
                            })
                            // fim add gols t2
                      
                            //adicionar cartões amarelos time 2
                            var container_ca_t2 = $(".container-ca-t2{{$game->id}}");
                            var add_button_cat2 = $(".add_ca_t2{{$game->id}}");
                            var x_cat2 = 1;
                            $(add_button_cat2).click(function(e) {
                                e.preventDefault();
                                x_cat2++;
                                $(container_ca_t2).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team2_yellowcard" name="team2_yellowcard[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team2->players as $playerr)
                                              <option value="{{$playerr->id}}">{{$playerr->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_ca_t2).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x_cat2--;
                            })
                            // fim add ca t2
                      
                            //adicionar cartões vermelhos time 2
                            var container_cv_t2 = $(".container-cv-t2{{$game->id}}");
                            var add_button_cvt2 = $(".add_cv_t2{{$game->id}}");
                            var x_cvt2 = 1;
                            $(add_button_cvt2).click(function(e) {
                                e.preventDefault();
                                x_cvt2++;
                                $(container_cv_t2).append(`
                                  <div class="row mt-2">
                                      <div class="col-10">
                                          <select class="form-select" id="team2_redcard" name="team2_redcard[]" aria-label="Default select example">
                                              <option selected value="futebol">Selecione o Jogador</option>
                                              @foreach ( $game->team2->players as $playerr)
                                              <option value="{{$playerr->id}}">{{$playerr->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <a class="btn btn-sm btn-primary delete col-2"><i class="fa-solid fa-minus"></i></a>
                                  </div>
                                  `); //add input box
                            });
                      
                            $(container_cv_t2).on("click", ".delete", function(e) {
                                e.preventDefault();
                                $(this).parent('div').remove();
                                x_cavt2--;
                            })
                            // fim add cv t2
                      
                        });
                      </script>
                      
                      @endforeach

                    <!--
                    <div class="text-center d-flex justify-content-evenly">
                        <div>
                            <p>Time 3 <i class="fa-solid fa-shield-halved"></i></p>
                        </div>
                        <div>
                            <span><b>0</b> </span>
                            <span> X </span>
                            <span> <b>2</b></span>
                        </div>
                        <div>
                          <p><i class="fa-solid fa-shield-halved"></i> Time 4</p>
                        </div>
                    </div>
                    <hr>
                    -->
                      
                  </div>

                  <!-- Modal adicionar jogo-->
                  <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Adicionar jogo</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="/app/game" method="POST">
                                  @csrf
                                  <div class="mb-3">
                                    <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                  </div>
                                  <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <select id="team1_id" name="team1_id" class="form-select" aria-label="Default select example">
                                                <option selected>Selecione o primeiro time</option>
                                                @foreach ($teams as $team)
                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5" style="display: none;">
                                            <input type="number" class="form-control" id="team1_goals" name="team1_goals" placeholder="Gols">
                                        </div>
                                    </div>  
                                  </div>
                                  <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <select id="team2_id" name="team2_id" class="form-select" aria-label="Default select example">
                                                <option selected>Selecione o primeiro time</option>
                                                @foreach ($teams as $team)
                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5" style="display: none;">
                                            <input type="number" class="form-control" id="team2_goals" name="team2_goals" placeholder="Gols">
                                        </div>
                                    </div>  
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                      <button type="submit" class="btn btn-primary">Salvar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                  </div>

@endsection