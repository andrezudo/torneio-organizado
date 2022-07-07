@extends('layouts.main')

@section('title','Torneio Organizado - Campeonatos')
    
@section('content')

    <header>

        <section class="mt-5 text-white">
            <div class="container">
                
                <div class="">
                    <h2>{{ $championship->title }}</h2>
                    <p><i class="fa-solid fa-location-dot"></i> {{ $championship->localization }} | <i class="fa-solid fa-calendar-day"></i> 30/02/2021</p>
                    <p><i class="fa-solid fa-dollar-sign"></i> Premiação: R${{ $championship->award }},00</p>
                </div>

                <div class="container mb-5">
                    <div class="mt-5 mb-2">
                        <h3>Times:</h3>
                    </div>

                    <div class="row">
                      @foreach ($teams as $team)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card text-black p-2 text-center m-3">
                              <i class="fa-solid fa-shield-halved"></i> <b>{{$team->name}}</b>
                            </div> 
                        </div>
                      @endforeach
                    </div>

                    
                    <div class="mt-5 mb-4">
                        <h3>Tabela de classificação:</h3>
                    </div>
                    
                    <div class="mb-5 card-rankings p-2">
                        <div class="table-responsive">
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
                    
                    <div class="mt-3 mb-4">
                        <h3>Jogos:</h3>
                    </div>

                    <div class="card-rankings p-2">
                        <hr>
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
                            </div>
                            <hr>
                        @endforeach
                    </div>

                    <div class="mt-5 mb-4">
                        <h3>Estatísticas:</h3>
                    </div>

                    <div class="container mb-5">

                        <div class="barra-navegacao">
                            <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Artilheiros</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Cartões amarelos</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Cartões vermelhos</button>
                                </li>
                            </ul>
                        </div>
        
                            <div class="tab-content" id="myTabContent">
        
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="card-rankings p-2 m-3">
                
                                        @if ( $gols->count() == 0 )
                                            <div class="col-12 mb-5 mt-5 text-white text-center">
                                                <h4>Nenhum artilheiro por enquanto</h4>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table text-white">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Jogador</th>
                                                        <th scope="col">Gols</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($gols as $gol)
                                                        <tr>
                                                            <td>{{$gol->player->name}}</td>
                                                            <td>{{$gol->qtd_gols}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                
                                    </div>
                                </div>
        
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <div class="card-rankings p-2 m-3">
                                        @if ( $amarelos->count() == 0 )
                                            <div class="col-12 mb-5 mt-5 text-white text-center">
                                                <h4>Nenhum amarelado por enquanto</h4>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table text-white">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Jogador</th>
                                                        <th scope="col">Cartões amarelos</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($amarelos as $amarelo)
                                                        <tr>
                                                            <td>{{$amarelo->player->name}}</td>
                                                            <td>{{$amarelo->qtd_amarelos}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                    <div class="card card-rankings p-2 m-3">
                                        @if ( $vermelhos->count() == 0 )
                                            <div class="col-12 mb-5 mt-5 text-white text-center">
                                                <h4>Nenhum vermelhado por enquanto</h4>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table text-white">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Jogador</th>
                                                        <th scope="col">Cartões vermelhos</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($vermelhos as $vermelho)
                                                        <tr>
                                                            <td>{{$vermelho->player->name}}</td>
                                                            <td>{{$vermelho->qtd_vermelhos}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
        
                            </div>
        
                    </div>

                </div>

            </div>
        </section>
    </header>

@endsection   