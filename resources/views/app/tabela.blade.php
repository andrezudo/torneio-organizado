<?php 
$inicio = '';
$times = '';
$classificacao = 'active';
$jogos = '';
$rankings = '';
?>

@extends('layouts.plataforma')

@section('title','Classificação')
    
@section('content')
                
                  <div class="container">
                        <div class="table-responsive mt-5">
                            <table class="table text-white">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Time</th>
                                    <th scope="col">P</th>
                                    <th scope="col">J</th>
                                    <th scope="col">V</th>
                                    <th scope="col">SG</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>4 de Julho</td>
                                    <td><b>12</b></td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>20</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Parnayba</td>
                                    <td><b>9</b></td>
                                    <td>4</td>
                                    <td>3</td>
                                    <td>2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Internacional</td>
                                    <td><b>6</b></td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Barras</td>
                                    <td><b>5</b></td>
                                    <td>4</td>
                                    <td>1</td>
                                    <td>1</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Pumas</td>
                                    <td><b>1</b></td>
                                    <td>4</td>
                                    <td>0</td>
                                    <td>-4</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>

@endsection