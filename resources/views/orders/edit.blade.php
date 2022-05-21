@extends('layouts.app',[
    'title'=>'Редактирование карточки'
    ])
@section('content')
<section class="text-center bg-light mt-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('orders.update',[$element->id]) }}" method="POST" enctype="multipart/form-data" class="catalog edit">
                    @method('PATCH')
                    @include('orders.parts.form')
                </form>
            </div>
        </div>
    </div>
</section>
@endsection