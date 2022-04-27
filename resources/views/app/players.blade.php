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
                          <h2>Nome do time</h2>

                          <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#palyerModal">
                            <i class="fa-solid fa-plus"></i> Adicionar jogador
                          </button>
                        </div>
                      </div>
                  </div>

                  <div class="container text-white">
                      <h3>Jogadores:</h3>
                      <hr>

                      @foreach ($players as $player)
                        <div class="d-flex justify-content-between">
                          <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModalEdit"><i class="fa-solid fa-user"></i> {{$player->name}}</a>
                          <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <hr>

                        <!-- Modal -->
                        <div class="modal fade" id="palyerModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Editar jogador</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form action="/championship" method="POST">
                                      @csrf
                                      <div class="mb-3">
                                        <label for="title" class="form-label">Jogador:</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do jogador">
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
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Fulano</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Caça Rato</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Pica-Pau</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Lulinha</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Fred</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#palyerModal"><i class="fa-solid fa-user"></i> Nelson</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                      </div>
                      <hr>
                    -->
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
                            <form action="/championship" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="title" class="form-label">Jogador:</label>
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Nome do jogador">
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