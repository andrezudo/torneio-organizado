<?php 
$inicio = '';
$times = 'active';
$classificacao = '';
$jogos = '';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Times')
    
@section('content')

                  <div class="container">
                      <div class="row mt-5 mb-4 text-white">
                        <div class="d-flex justify-content-between mb-5">
                          <h2>Nome do campeonato</h2>
                          <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#teamModal">
                            <i class="fa-solid fa-plus"></i> Adicionar time
                          </button>
                        </div>
                      </div>
                  </div>

                  <div class="container">
                      <div class="row">
                        @foreach ($teams as $team)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="/app/players" class="text-decoration-none">
                              <div class="card p-2 text-center m-3">
                                <i class="fa-solid fa-shield-halved"></i> <b>{{$team->name}}</b>
                              </div>
                            </a>  
                          </div>
                        @endforeach
                      </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar time</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/app/team" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="title" class="form-label">Time:</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Nome do time">
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