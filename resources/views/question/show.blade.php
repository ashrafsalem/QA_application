@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back To All Questions</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="this question is useful"
                                   class="vote-up {{ Auth::guest()? 'off': '' }}"
                                   onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit()">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form id="up-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count">{{$question->votes_count}}</span>

                                <a title="this question is not useful"
                                   class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                                   onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit()">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form id="down-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>

                                <a title="click to add this question to favorites questions (click it again to undo)"
                                   class="favorite mt-2  {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '' ) }}"
                                    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favorites-count">{{ $question->favorites_count }}</span>
                                    <form id="favorite-question-{{ $question->id }}" action="/questions/{{$question->id}}/favorited" method="post">
                                        @csrf
                                        @if($question->is_favorited)
                                            @method('DELETE')
                                        @endif
                                    </form>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right  mt-2">
                                    <span class="text-muted">Question at: {{ $question->createdDate }}</span>
                                    <div class="media">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">
                                                {{ $question->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('answers._index', [
            'answers' => $question->answers,
            'answersCount' =>  $question->answers_count
        ])
        @include('answers._create')
    </div>
@endsection
