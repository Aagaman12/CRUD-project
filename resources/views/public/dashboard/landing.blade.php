@extends('layouts.public')

@section('title', ' Home')

@section('content')
    @include('public.sections.hero')
    @include('public.sections.how-it-works')
    @include('public.sections.products')
    @include('public.sections.testimonials')
    @include('public.sections.about-us')
@endsection