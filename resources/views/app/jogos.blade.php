<?php 
$inicio = '';
$times = '';
$classificacao = '';
$jogos = 'active';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Jogos')
    
@section('content')
                
                  <div class="container mt-5 text-white">

                      <hr>
                      <div class="text-center d-flex justify-content-evenly">
                          <div>
                              <p>Time 1 <i class="fa-solid fa-shield-halved"></i></p>
                          </div>
                          <div>
                              <span><b>3</b> </span>
                              <span> X </span>
                              <span> <b>2</b></span>
                          </div>
                          <div>
                            <p><i class="fa-solid fa-shield-halved"></i> Time 1</p>
                        </div>
                      </div>
                      <hr>

                      <div class="text-center d-flex justify-content-evenly">
                        <div>
                            <p>Time 3 <i class="fa-solid fa-shield-halved"></i></p>
                        </div>
                        <div>
                            <span><b>0</b> </span>
                            <span> X </span>
                            <span> <b>2</b></span>
                        </div>
                        <div>
                          <p><i class="fa-solid fa-shield-halved"></i> Time 4</p>
                      </div>
                    </div>
                    <hr>

                    <div class="text-center d-flex justify-content-evenly">
                        <div>
                            <p>Time 5 <i class="fa-solid fa-shield-halved"></i></p>
                        </div>
                        <div>
                            <span><b>1</b> </span>
                            <span> X </span>
                            <span> <b>1</b></span>
                        </div>
                        <div>
                          <p><i class="fa-solid fa-shield-halved"></i> Time 6</p>
                      </div>
                    </div>
                    <hr>
                      
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="palyerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar jogador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/championship" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="title" class="form-label">Jogador:</label>
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Nome do jogador">
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