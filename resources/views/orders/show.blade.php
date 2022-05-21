@extends('layouts.app',[
    'title'=> 'Карточка заявки'
    ])
@section('content')
<style>
.card-body p{
    display: flex;
    justify-content: space-between;
}

</style>
<section class="text-center bg-light mt-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card m-auto" style="width: 30rem;display:flex; flex-direction:column; align-items:center;">
                    <div class="card-body" style=" align-items:left">
                        <h5 class="card-title font-monospace">Заявка № {{ $element_order->id}} </h5>
                        <p class="text-start  font-monospace m-0"> <span class="text-muted">Обновлена:</span>{{ $element_order->updated_at}} </p>
                        <p class="text-start  font-monospace m-0"> <span class="text-muted">Создана:</span>{{ $element_order->created_at}} </p>
                        <p class="text-start  font-monospace m-0"> <span class="text-muted">Пользователь:</span>{{ $element_order->user_name}} </p>
                        <p class="text-start  font-monospace m-0"> <span class="text-muted">Менеджер:</span>{{ $element_order->manager_name}} </p>
                        <p class="text-start  font-monospace m-0"> <span class="text-muted">Статус:</span>{{ $element_order->status}}</p>
                        <p class="text-start m-0"> <span class="text-muted  font-monospace ">Заявка:</span>{{ $element_order->message}} </p>
                        <p class="text-start m-0"> <span class="text-muted font-monospace ">Комментарий:</span>{{ $element_order->comment}} </p> 
                        <a href="{{ route('orders.index')}}" class="btn btn-outline-success btn-sm">Вернуться</a>
                        <a href="{{ route('orders.edit',[$element_order->id])}}" class="btn btn-outline-primary btn-sm">Редактировать</a>
                        <form action="{{ route('orders.destroy',$element_order->id)}}" method="POST" enctype="multipart/form-data" style="display:inline-block" onclick="if( confirm('точно хотите удалить карточку')){return true} else {return false}">
                            @csrf
                            @method('DELETE')
<input type="submit" class="btn btn-outline-danger btn-sm" value="Удалить">
                        </form>                       
                       </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection