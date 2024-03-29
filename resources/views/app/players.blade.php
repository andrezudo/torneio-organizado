<?php 
$inicio = '';
$times = 'active';
$classificacao = '';
$jogos = '';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Jogadores')
    
@section('content')

                  <div class="container text-white">
                      <div class="row mt-5 mb-4 ">
                        <div class="d-flex justify-content-between mb-5">
                          <h2>{{$team->name}}</h2>

                          <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#palyerModal">
                            <i class="fa-solid fa-plus"></i> Adicionar jogador
                          </button>
                        </div>
                      </div>
                  </div>

                  <div class="container text-white mb-5">
                      <h3>Jogadores:</h3>
                      <hr>

                      @if ( $players->count() == 0 )
                          <div class="col-12 mb-5 mt-5 text-white text-center">
                              <h3>Nenhum jogador</h3>
                          </div>
                      @endif

                      @foreach ($players as $player)
                        <div class="d-flex justify-content-between">
                          <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModalEdit{{$player->id}}"><i class="fa-solid fa-user"></i> {{$player->name}}</a>
                          <!--
                          <form style="display: inline-block" action="/app/delete-player/{{$player->id}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger mx-2 my-2 btn-sm"><i class="fa-solid fa-trash"></i></button>
                          </form>
                          -->
                          <a class="btn btn-danger mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeletePlayer{{$player->id}}">
                              <i class="fa-solid fa-trash"></i>
                          </a>
                          <!--<a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>-->
                        </div>
                        <hr>

                        <!-- Modal -->
                        <div class="modal fade" id="palyerModalEdit{{$player->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title text-black" id="exampleModalLabel">Editar jogador</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form action="/app/update-player/{{ $player->id }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="mb-3">
                                        <label for="title" class="form-label">Jogador:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do jogador" value="{{ $player->name }}">
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

                      <!-- Modal Excluir jogador -->
                      <div class="modal fade" id="modalDeletePlayer{{$player->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body text-black">
                                      <div>
                                          <h5>Tem certeza que deseja apagar o jogador "{{ $player->name }}"?</h5>
                                      </div>
                                      <form action="/app/delete-player/{{$player->id}}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                              <button type="submit" class="btn btn-primary"><ion-icon name="trash-outline"></ion-icon>Sim</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>

                      @endforeach

                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="palyerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar jogador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/app/player" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="title" class="form-label">Jogador:</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Nome do jogador">
                                  <input type="text" class="form-control" id="team_id" name="team_id" value="{{$team->id}}" style="display: none;">
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