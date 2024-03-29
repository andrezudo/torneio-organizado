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
                          <h2>{{session('championship')->title}}</h2>
                          <div>
                            @if ( session('championship')->initiated == '0' )
                              <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#teamModal">
                                <i class="fa-solid fa-plus"></i> Adicionar time
                              </button>
                            @else
                              <button type="button" class="btn btn-register" disabled>
                                <i class="fa-solid fa-futbol"></i> Campeonato Iniciado
                              </button>
                            @endif
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="container">

                    @if ( $teams->count() == 0 )
                        <div class="col-12 mb-5 mt-5 text-white text-center">
                            <h3>Nenhum time adicionado</h3>
                        </div>
                    @endif

                      <div class="row">
                        @foreach ($teams as $team)
                          <div class="col-lg-3 col-md-4 col-sm-6">
                              <div class="card p-2 text-center m-3">
                                <i class="fa-solid fa-shield-halved"></i> <b>{{$team->name}}</b>
                                <div class="">
                                  <a href="/app/players/{{$team->id}}" class="btn btn-register mx-2 my-2 btn-sm"><b><i class="fa-solid fa-eye"></i></b></a>
        
                                  <button type="button" class="btn btn-warning mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditTime{{$team->id}}">
                                    <i class="fa-solid fa-pen"></i>
                                  </button>
                                  @if ( session('championship')->initiated == '0' )
                                    <!--
                                    <form style="display: inline-block" action="/app/team/{{$team->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-2 my-2 btn-sm"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    -->
                                    <a class="btn btn-danger mx-2 my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteTeam{{$team->id}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                  @endif
                                </div>
                              </div>
                          </div>

                          <!-- Modal editar time-->
                          <div class="modal fade" id="modalEditTime{{$team->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Editar time</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/app/update-team/{{ $team->id }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                          <div class="mb-3">
                                            <label for="title" class="form-label">Time:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do time" value="{{ $team->name }}">
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

                          <!-- Modal Excluir time -->
                          <div class="modal fade" id="modalDeleteTeam{{$team->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <div>
                                              <h5>Tem certeza que deseja apagar o time "{{ $team->name }}"?</h5>
                                          </div>
                                          <form action="/app/team/{{$team->id}}" method="POST">
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

                  <!-- Modal Adicionar Time-->
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
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nome do time">
                                    <input type="text" class="form-control" id="championship_id" name="championship_id" value="{{session('championship')->id}}" style="display: none;">
                                  </div>
                                  <hr>
                                  <div class="mb-3 container1">
                                    <label for="title" class="form-label">Jogadores:</label>
                                    <div class="row mb-2">
                                      <div class="col-11">
                                        <input type="text" class="form-control" id="name_player" name="name_players[]" placeholder="Nome do jogador">
                                      </div>
                                      <a class="btn btn-primary col-1 add_form_field"><i class="fa-solid fa-plus"></i></a>
                                    </div>
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


<script>
  $(document).ready(function() {
      var max_fields = 10;
      var wrapper = $(".container1");
      var add_button = $(".add_form_field");

      var x = 1;
      $(add_button).click(function(e) {
          e.preventDefault();
          if (x < max_fields) {
              x++;
              $(wrapper).append(`<div class="row mb-2">
                                      <div class="col-11">
                                        <input type="text" class="form-control" id="name_player" name="name_players[]" placeholder="Nome do jogador">
                                      </div>
                                      <a class="delete btn btn-primary col-1"><i class="fa-solid fa-minus"></i></a>
                                 </div>
                                `); //add input box
          } else {
              alert('You Reached the limits')
          }
      });

      $(wrapper).on("click", ".delete", function(e) {
          e.preventDefault();
          $(this).parent('div').remove();
          x--;
      })
  });
</script>

@endsection