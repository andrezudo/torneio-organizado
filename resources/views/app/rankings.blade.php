<?php 
$inicio = '';
$times = '';
$classificacao = '';
$jogos = '';
$rankings = 'active';
?>

@extends('layouts.plataforma')

@section('title','Rankings')
    
@section('content')
                
                  <div class="container my-5">

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
                                        <th scope="col">Cartões Amarelos</th>
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

@endsection