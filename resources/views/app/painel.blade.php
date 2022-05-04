<?php 
$inicio = 'active';
$times = '';
$classificacao = '';
$jogos = '';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Inicio')
    
@section('content')

                  <div class="container">
                      <div class="d-flex justify-content-between mt-5">
                        <div class="text-white">
                            <h2>{{ $championship->title }}</h2>
                            <p><i class="fa-solid fa-location-dot"></i> {{ $championship->localization }} | <i class="fa-solid fa-calendar-day"></i> 30/02/2021</p>
                            @if ($championship->award != '')
                                <p><i class="fa-solid fa-dollar-sign"></i> Premiação: R${{ $championship->award }},00</p>
                            @endif
                        </div>
                        <div class="">
                          <a href="/site/campeonato/{{$championship->id}}" class="btn btn-dahsboard mx-2 my-2"><b><i class="fa-solid fa-arrow-pointer"></i> Página</b></a>

                          <button type="button" class="btn btn-register mx-2 my-2" data-bs-toggle="modal" data-bs-target="#modalEditCamp{{$championship->id}}">
                            <i class="fa-solid fa-pen"></i> Editar
                          </button>
                          <form style="display: inline-block" action="/app/championship/{{$championship->id}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger mx-2 my-2"><i class="fa-solid fa-trash"></i> Apagar</button>
                          </form>
                        </div>
                      </div>
                  </div>

                  <div class="container">
                      <div class="text-white mt-5 mb-3">
                          <h3>Times</h3>
                      </div>

                      <div class="row">
                        @foreach ($teams as $team)
                          <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="/app/players/{{$team->id}}" class="text-decoration-none">
                              <div class="card p-2 text-center m-3">
                                <i class="fa-solid fa-shield-halved"></i> <b>{{$team->name}}</b>
                              </div>
                            </a>  
                          </div>
                        @endforeach
                      </div>
                  </div>

                  <!--
                  <div class="container">
                    <div class="text-white mt-5">
                        <h3>Times:</h3>
                        <div>
                          foreach ($teams as $team)
                            <h2>{ $team->name}</h2>  
                          endforeach
                        </div>
                        <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Adicionar time
                        </button>
                    </div>
                </div>
                -->

                <!-- Modal Editar Campeonato-->
                <div class="modal fade" id="modalEditCamp{{$championship->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Crie seu campeonato</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="/app/update/{{ $championship->id }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="mb-3">
                                  <label for="title" class="form-label">Campeonato:</label>
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Campeonato" value="{{ $championship->title }}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="localization" class="form-label">Local:</label>
                                      <input type="text" class="form-control" id="localization" name="localization" placeholder="Onde ocorrerá o Campeonato" value="{{ $championship->localization }}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="award" class="form-label">Valor da premiação:</label>
                                      <input type="text" class="form-control" id="award" name="award" placeholder="Ex: 2500" value="{{ $championship->award }}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="modality" class="form-label">Modalidade:</label>
                                      <select class="form-select" id="modality" name="modality" aria-label="Default select example" value="{{ $championship->modality }}">
                                          <option selected value="futebol">Futebol</option>
                                          <option value="futsal" {{$championship->modality == 'futsal' ? "selected='selected'" : ""}}>Futsal</option>
                                          <option value="society" {{$championship->modality == 'society' ? "selected='selected'" : ""}}>Society</option>
                                      </select>
                                  </div>
                                  <div class="mb-3 d-flex justify-content-center">
                                      <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="mata_mata" id="mata_mata" value="1">
                                          <label class="form-check-label" for="mata_mata">Mata-mata</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="groups" id="groups" value="2">
                                          <label class="form-check-label" for="groups">Fase de grupos</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="running_stitches" id="running_stitches" value="3">
                                          <label class="form-check-label" for="running_stitches">Pontos corridos</label>
                                      </div>
                                  </div>
                                  <div class="mb-3">
                                      <label for="return" class="form-label">Ida e Volta:</label>
                                      <select class="form-select" id="return" name="return" aria-label="Default select example">
                                          <option selected value="1">Sim</option>
                                          <option value="0" {{$championship->return == 0 ? "selected='selected'" : ""}}>Não</option>
                                      </select>
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

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/championship" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="title" class="form-label">Time:</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Nome do time">
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