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

                <div class="container">
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

                    <div class="mt-3 mb-4">
                        <h3>Jogos:</h3>
                    </div>

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

            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crie seu campeonato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/app/championship" method="POST">
                        @csrf
                        <div class="mb-3">
                        <label for="title" class="form-label">Campeonato:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Campeonato">
                        </div>
                        <div class="mb-3">
                            <label for="localization" class="form-label">Local:</label>
                            <input type="text" class="form-control" id="localization" name="localization" placeholder="Onde ocorrerá o Campeonato">
                        </div>
                        <div class="mb-3">
                            <label for="modality" class="form-label">Modalidade:</label>
                            <select class="form-select" id="modality" name="modality" aria-label="Default select example">
                                <option selected value="futebol">Futebol</option>
                                <option value="futsal">Futsal</option>
                                <option value="society">Society</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="forma" id="mata_mata" value="1">
                                <label class="form-check-label" for="mata_mata">Mata-mata</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="forma" id="groups" value="2">
                                <label class="form-check-label" for="groups">Fase de grupos</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="forma" id="running_stitches" value="3">
                                <label class="form-check-label" for="running_stitches">Pontos corridos</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="return" class="form-label">Ida e Volta:</label>
                            <select class="form-select" id="return" name="return" aria-label="Default select example">
                                <option selected value="1">Sim</option>
                                <option value="0">Não</option>
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

    </header>

@endsection   