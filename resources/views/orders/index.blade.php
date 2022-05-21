<?php
//use Illuminate\Support\Carbon;
//Carbon::parse($item->updated_at)->diffForHumans()
?>

@extends('layouts.app',[
'title'=>"Заявки"
])

@section('content')

<nav class="nav justify-content-between">
    @if (Auth::user()->is_User())
    <a class="nav-link" href="{{route('orders.create') }}">Создать заявку</a>
    @endif
<!-- Button trigger modal -->
    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#filter">
    <div class="flex items-center ">
    <span>Настройки таблицы</span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"  id="Outline" viewBox="0 0 24 24" stroke-linejoin="round" width="22" ><path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/><path d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"/></svg>
    </div>
</button>

    
  </nav>


<section class="text-center bg-light py-4">
    <table class="table">
        <thead>
            <tr>
                <th>Дата </th>
                @if (!Auth::user()->is_User())
                <th>Пользователь</th>
                @endif
                @if (!Auth::user()->is_Manager())
                <th>Ответственный</th>
                @endif
                {{-- &darr;  &uarr; --}}
                <th>Статус </th>
                <th>Заявка</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($orders as $item)
            <tr>
                <td scope="row">{{$item->updated_at}}</td>
                @if (!Auth::user()->is_User())
                <td>{{$item->user_name}}</td>
                @endif
                @if (!Auth::user()->is_Manager())
                <td>{{$item->manager_name}}</td>
                @endif
                <td>{{$item->status}}</td>
                <td>{{ \Str::limit($item->message,30) }}</td>
                <td><a name="" id="" class="btn btn-link" href="{{route('orders.show',$item->id)}}" role="button">Выбрать</a>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row">
       <div class="col-md-12">
           <!-- pagination::bootstrap-4 -->
        {{ $orders->appends(['date_first' => filter_input(INPUT_GET,'date_first'),'date_last' => filter_input(INPUT_GET,'date_last'),'date_sort' => filter_input(INPUT_GET,'date_sort'),'status' => filter_input(INPUT_GET,'status')])->links('vendor.pagination.bootstrap-4') }}       
       </div>     
        </div>
    </div>
    

    

</section>


<!-- Modal -->
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <form action="{{ route('orders.index') }}" method="GET" name="filtr" enctype="multipart/form-data" >
  
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Настройка таблицы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 d-flex justify-content-between">
                    <label for="date_first" class="form-label p-2 m-0">Период с:</label>
                    <input type="date" name="date_first" id="date_first" >
                    <label for="date_last" class="form-label p-2 m-0">по:</label>
                    <input type="date"  name="date_last" id="date_last" >
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <label for="date_sort" class="col-4 form-label p-2 m-0">Сортировать дату:</label>
                    <div class="input-group">
                        <select name="date_sort" class="form-control col-8" id="date_sort">
                            <option value="">Без сортировки</option>
                            <option value="desc" {{ filter_input(INPUT_GET,'date_sort') ==='desc' ? 'selected' :'' }} >В начале новые</option>
                            <option value="asc" {{ filter_input(INPUT_GET,'date_sort') ==='asc' ? 'selected' :'' }}>В начале старые</option>
                         </select>
                    </div>
                </div> 
                <div class="mb-3 d-flex justify-content-between">
                    <label for="status" class="col-4  form-label p-2 m-0">Показывать cтатус:</label>
                    <div class="input-group">
                        <select name="status" class="form-control col-8" id="status">
                            <option value="">Показывать Все</option>
                            <option value="Active" {{ filter_input(INPUT_GET,'status') ==='Active' ? 'selected' :'' }}>Active</option>
                            <option value="Resolved" {{ filter_input(INPUT_GET,'status') ==='Resolved' ? 'selected' :'' }}>Resolved</option>
                         </select>
                    </div>
                </div>  
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-outline-primary btn-sm">Применить</button>  
            </div>
        </div>
    </div>
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', InitdateOrder);
    function get_date(){
        var d = new Date();
        return d.toISOString().split("T")[0];
    }
    function InitdateOrder(){
    var datelast = document.querySelector('#date_last');
    var datefirst = document.querySelector('#date_first');
    datelast.value = "{{ filter_input(INPUT_GET,'date_last')}}";
    datefirst.value = "{{ filter_input(INPUT_GET,'date_first')}}";
    if(!datelast.value){
        datelast.value = get_date();
        datelast.max = get_date();
    } 

}
</script>
@endsection