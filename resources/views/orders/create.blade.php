@extends('layouts.app')

@section('content')
<section class="text-center bg-light">
    <div class="container">
        <form action="{{ route('orders.store') }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
            @include('orders.parts.form')
        </form>
    </div>
</section>
@endsection