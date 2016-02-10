@extends('app')

@section('content')
    <div class="container">
        <h1>Edit Product: {{ $product->name }}</h1>

        @if ($errors->any())

            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        @endif


        {!! Form::open(['route'=> ['products.update', $product->id], 'method'=>'put']) !!}

        <!-- Name Form Input -->

        <div class="form-group">

            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}

        </div>

        <!-- Description Form Input -->

        <div class="form-group">

            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}

        </div>

        <!-- Price Form Input -->

        <div class="form-group">

            {!! Form::label('price', 'Price:') !!}
            {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}

        </div>

        <!-- Featured Form Input -->

        <div class="form-group">

            {!! Form::label('featured', 'Featured:') !!}
            {!! Form::hidden('featured', false) !!}
            {!! Form::checkbox('featured', null, $product->featured) !!}

        </div>

        <!-- Recommend Form Input -->

        <div class="form-group">


            {!! Form::label('recommend', 'Recommend:') !!}
            {!! Form::hidden('recommend', false) !!}
            {!! Form::checkbox('recommend', null, $product->recommend) !!}

        </div>

        <div class="form-group">

            {!! Form::submit('Save Product', ['class'=> 'btn btn-primary']) !!}

        </div>


        {!! Form::close() !!}

    </div>
@endsection