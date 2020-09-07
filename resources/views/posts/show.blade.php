@extends('layout')
@section('meta-title',$post->title ?? config('app.name'))
@section('meta-description', $post->excerpt)
@section('content')
    <article class="post container">

        @include( $post->viewType() )

        <div class="content-post">
            @include('posts.header')
            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
                {!! $post->body !!}
            </div>

            <footer class="container-flex space-between">
                @include('partials.social-links',['description' => $post->title])
                @include('posts.tags')
            </footer>
            <div class="comments">
                <div class="divider"></div>
                <div id="disqus_thread"></div>
                @include('partials.discus-script')

            </div><!-- .comments -->
        </div>
    </article>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush

