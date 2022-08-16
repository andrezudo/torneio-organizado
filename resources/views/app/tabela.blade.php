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

          <div class="row mt-5 mb-4 text-white">
            <div class="d-flex justify-content-between mb-5">
              <div class="text-white">
                <h2>Classificação do campeonato</h2>
              </div>
              <div>
                <!--<p><small>P = Pontos | V = Vitórias | E = Empates | D = Derrotas | SG = Saldo de gols</small></p>-->
              </div>
            </div>
          </div>
          

                <div class="mt-5 mb-5">
    
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

                <!--
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
                -->


            </div>


@endsection