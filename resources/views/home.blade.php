@extends('layouts.main')

@section('title','Torneio Organizado - Início')
    
@section('content')

<header>
    
    <section class="mt-5 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="card text-white text-center card-infos">
                        <div class="card-body">
                          <h2 class="card-title">Torneio Organizado</h2>
                          <h4 class="card-text">Essa é uma plataforma onde você poderá criar campeonatos e gerenciá-los.</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card text-white card-infos">
                        <div class="card-body">
                          <h5 class="card-title">Crie campeonatos</h5>
                          <p class="card-text">Com esse sistema você poderá criar vários campeonatos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card text-white card-infos">
                        <div class="card-body">
                          <h5 class="card-title">Crie Times</h5>
                          <p class="card-text">Você poderá adicionar todos os times participantes ao seu campeonato.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card text-white card-infos">
                        <div class="card-body">
                          <h5 class="card-title">Adicione Jogadores</h5>
                          <p class="card-text">Você poderá adicionar todos os jogadores aos seus times.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card text-white card-infos">
                        <div class="card-body">
                          <h5 class="card-title">Escolha o formato</h5>
                          <p class="card-text">Você poderá escolher como será o formato do seu campeonato.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="container text-white">
            <h2>Últimos campeonatos iniciados:</h2>
            <hr>

            <div class="row">
            @foreach ($championships as $championship)
                <div class="col-12 col-md-4 mb-5">
                    <div class="card text-center card-infos">
                        <div class="card-body">
                            <h3 class="card-title">{{$championship->title}}</h3>
                            <p class="card-text"><i class="fa-solid fa-user"></i> {{$championship->user->name}}</p>
                            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{$championship->localization}}</p>
                            <p class="card-text"><i class="fas fa-calendar-day"></i> 30/12/2021</p>
                            <a href="/site/campeonato/{{$championship->id}}" class="btn btn-dahsboard mx-2 my-2 btn-sm">
                                <b><i class="fa-solid fa-arrow-pointer"></i> Página</b>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

</header>

@endsection