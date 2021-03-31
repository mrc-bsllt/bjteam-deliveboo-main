@extends('layouts.backend')

@section("main")

<div class="select_year">
  <label for="select" style="font-size: 18px; font-weight: 700">Seleziona l'anno</label>
  <select name="" id="select" v-model="year" @change="filterByYear">
    <option value="2021">2021</option>
    <option value="2020">2020</option>
    <option value="2019">2019</option>
  </select>
</div>

<div id="chart_box" class="container" style="position: relative; height:100%; width:80vw;">    
  <div class="myChart_container">
    <canvas id="myChart"></canvas>
  </div>
  <div class="turn_to_see">
    <i class="fas fa-mobile-alt"></i>
    <i class="fas fa-sync-alt"></i>
    <p>Turn your phone for better visualization of the chart</p>
  </div>
    
</div>
  
@endsection
