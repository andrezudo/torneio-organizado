@extends('layouts.main')

@section('title','Torneio Organizado - Campeonatos')
    
@section('content')

    <header>

        <section class="mt-5">
            <div class="container">
                
                <div class="text-white">
                    <h2>{{ $championship->title }}</h2>
                    <p><i class="fa-solid fa-location-dot"></i> {{ $championship->localization }} | <i class="fa-solid fa-calendar-day"></i> 30/02/2021</p>
                    <p><i class="fa-solid fa-dollar-sign"></i> Premiação: R${{ $championship->award }},00</p>
                </div>

                <div class="container">
                    <div class="text-white mt-5 mb-3">
                        <h3>Times:</h3>
                    </div>

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