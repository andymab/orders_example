@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="list-group">
                        @if (Auth::user()->is_User())
                        <a href="{{route('orders.create')}}" class="list-group-item list-group-item-action">Создать заявку</a>
                        @endif
                        <a href="{{route('orders.index')}}" class="list-group-item list-group-item-action">
                            @if (Auth::user()->is_User())
                            Мои заявки
                            @else 
                            Журнал заявок
                            @endif
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
