<?php 
$inicio = '';
$times = '';
$classificacao = 'active';
$jogos = '';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Classificação')
    
@section('content')
                
        <div class="container mt-5">
              <nav class="barra-navegacao">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active tabua-nav" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fase de grupos</button>
                  <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Mata-mata</button>
                </div>
              </nav>

              <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    
                        <div class="table-responsive mt-5">
                            <table class="table text-white">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Time</th>
                                    <th scope="col">P</th>
                                    <th scope="col">V</th>
                                    <th scope="col">E</th>
                                    <th scope="col">D</th>
                                    <th scope="col">SG</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ( $tables as $table )
                                    <tr>
                                      <th scope="row">{{$loop->iteration}}º</th>
                                      <td>{{ $table->team->name }}</td>
                                      <td><b>{{ $table->points }}</b></td>
                                      <td>{{ $table->victory }}</td>
                                      <td>{{ $table->draw }}</td>
                                      <td>{{ $table->defeat }}</td>
                                      <td>{{ $table->sg }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                  <div class="mt-5 mb-5">
                    <div class="bracket text-white">
                      <div class="round">
                        <div class="match">
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 1
                            </div>
                            <div><span><b>3</b></span></div>
                          </div>
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 2
                            </div>
                            <div><span><b>0</b></span></div>
                          </div>
                        </div>
                        <div class="match">
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 3
                            </div>
                            <div><span><b>1</b></span></div>
                          </div>
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 4
                            </div>
                            <div><span><b>2</b></span></div>
                          </div>
                        </div>
                      </div>
                      <div class="round">
                        <div class="match">
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 1
                            </div>
                            <div><span><b>0</b></span></div>
                          </div>
                          <div class="team d-flex justify-content-between">
                            <div>
                              <i class="fa-solid fa-shield-halved"></i> Time 4
                            </div>
                            <div><span><b>2</b></span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>

            </div>


@endsection