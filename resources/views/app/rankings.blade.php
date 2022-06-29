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
                        <div class="table-responsive">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Cartões Amarelos</th>
                                    <th scope="col">Gols</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chico</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Drogba</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Lewa</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card card-rankings p-2 m-3">
                        <div class="table-responsive">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Cartões Vermelhos</th>
                                    <th scope="col">Gols</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chico</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Drogba</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Lewa</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                  </div>

@endsection