@php
    $title = 'Men Collection';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('collection'). ">Our Collection</a>
                <a href=" .route('collection.men'). ">Men</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Hot Deals Area --}}
    <section class="collection-group-area section_gap">
        <div class="container-fluid">
            <div class="grid row ml-0 mr-0">
                @for ($i = 1; $i <= number_files('men'); $i++)
                    <div class="col-12 col-md-6 col-lg-4 grid-item">
                        <div class="card">
                            <img src="{{ asset('customer/img/collection/men/' .$i. '.jpg') }}" class="card-img-top" alt="collection-image">
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        @include('customer.layouts.partials._collection_pub')
    </section>

@endsection
