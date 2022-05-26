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
                                <!--
                                <a type="button" href="/app/gerar-jogos" class="btn btn-register">
                                    <i class="fa-solid fa-plus"></i> Adicionar jogo
                                </a>
                                -->
                                <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#gameModal">
                                    <i class="fa-solid fa-plus"></i> Adicionar jogo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>  
                
                <div class="container mt-5 text-white">  

                      <hr>
                      @foreach ($games as $game)

                      <div class="text-center d-flex justify-content-evenly">
                          <div>
                              <p>{{$game->team1->name}} <i class="fa-solid fa-shield-halved"></i></p>
                          </div>
                          <div>
                              <span><b>{{$game->team1_goals}}</b> </span>
                              <span> X </span>
                              <span> <b>{{$game->team2_goals}}</b></span>
                          </div>
                          <div>
                            <p><i class="fa-solid fa-shield-halved"></i> {{$game->team2->name}}</p>
                        </div>
                        <button type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#resultModal{{$game->id}}">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                      <hr>

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