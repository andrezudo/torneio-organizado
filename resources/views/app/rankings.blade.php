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
                        <div class="table-responsive">
                            <table class="table text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Jogador</th>
                                    <th scope="col">Gols</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>André</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>Drogba</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Lewa</td>
                                        <td>4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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