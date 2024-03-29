@extends('layouts.main')

@section('title','Torneio Organizado - Campeonatos')
    
@section('content')

    <header>

        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="text-white d-flex justify-content-between mb-5">
                        <h2>Meus campeonatos</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-register btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-plus"></i> Adicionar Campeonato
                        </button>
                    </div>

                    @empty( $championships )
                        <div class="col-12 col-md-4 mb-5">
                            <h3>Nenhum campeonato criado.</h3>
                        </div>
                    @endempty

                    @if ( $championships->count() == 0 )
                        <div class="col-12 mb-5 mt-5 text-white text-center">
                            <h3>Nenhum campeonato criado</h3>
                        </div>
                    @endif

                    @foreach ($championships as $championship)
                    <div class="col-12 col-md-4 mb-5">
                        <div class="card text-white text-center card-infos">
                            <div class="card-body">
                                <h3 class="card-title">{{$championship->title}}</h3>
                                <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{$championship->localization}}</p>
                                <p class="card-text"><i class="fas fa-calendar-day"></i> {{ date('d/m/Y', strtotime($championship->start)) }}</p>
                                <p class="card-text"><i class="fas fa-calendar-day"></i> {{ date('d/m/Y', strtotime($championship->end)) }}</p>
                                <a class="btn btn-warning mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditCamp{{$championship->id}}">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                                <a class="btn btn-danger mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteCamp{{$championship->id}}">
                                    <i class="fa-solid fa-trash"></i> Apagar
                                </a>
                                <!--
                                <form style="display: inline-block" action="/app/championship/{{$championship->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dahsboard"><ion-icon name="trash-outline"></ion-icon>Apagar</button>
                                </form>
                                -->
                                <a href="/app/painel/{{ $championship->id }}" class="btn btn-register mb-1 btn-sm">
                                    <i class="fa-solid fa-gear"></i> Gerenciar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Campeonato-->
                    <div class="modal fade" id="modalEditCamp{{$championship->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar campeonato</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/app/update/{{ $championship->id }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                        <label for="title" class="form-label">Campeonato:</label>
                                        <input type="text" class="form-control" id="title" name="title" required placeholder="Nome do Campeonato" value="{{ $championship->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="localization" class="form-label">Local:</label>
                                            <input type="text" class="form-control" id="localization" name="localization" required placeholder="Onde ocorrerá o Campeonato" value="{{ $championship->localization }}">
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
                                        <!--
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
                                        -->
                                        <div class="mb-3">
                                            <label for="return" class="form-label">Ida e Volta:</label>
                                            <select class="form-select" id="return" name="return" aria-label="Default select example">
                                                <option selected value="1">Sim</option>
                                                <option value="0" {{$championship->return == 0 ? "selected='selected'" : ""}}>Não</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start" class="form-label">Data de início:</label>
                                            <input type="date" class="form-control" id="start" name="start" required value="{{ $championship->start }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="end" class="form-label">Data de fim:</label>
                                            <input type="date" class="form-control" id="end" name="end" required value="{{ $championship->end }}">
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

                    <!-- Modal Excluir Campeonato -->
                    <div class="modal fade" id="modalDeleteCamp{{$championship->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <h5>Tem certeza que deseja apagar "{{ $championship->title }}"?</h5>
                                    </div>
                                    <form action="/app/championship/{{$championship->id}}" method="POST">
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
                        <input type="text" class="form-control" id="title" name="title" required placeholder="Nome do Campeonato">
                        </div>
                        <div class="mb-3">
                            <label for="localization" class="form-label">Local:</label>
                            <input type="text" class="form-control" id="localization" name="localization" required placeholder="Onde ocorrerá o Campeonato">
                        </div>
                        <div class="mb-3">
                            <label for="award" class="form-label">Valor da premiação:</label>
                            <input type="text" class="form-control" id="award" name="award" placeholder="Ex: 2500">
                        </div>
                        <div class="mb-3">
                            <label for="modality" class="form-label">Modalidade:</label>
                            <select class="form-select" id="modality" name="modality" aria-label="Default select example">
                                <option selected value="futebol">Futebol</option>
                                <option value="futsal">Futsal</option>
                                <option value="society">Society</option>
                            </select>
                        </div>
                        <!--
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
                        -->
                        <div class="mb-3">
                            <label for="return" class="form-label">Ida e Volta:</label>
                            <select class="form-select" id="return" name="return" aria-label="Default select example">
                                <option selected value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start" class="form-label">Data de início:</label>
                            <input type="date" class="form-control" id="start" name="start" required>
                        </div>
                        <div class="mb-3">
                            <label for="end" class="form-label">Data de fim:</label>
                            <input type="date" class="form-control" id="end" name="end" required>
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