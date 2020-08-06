@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Questions</div>
                    <div></div>
                    <div class="card-body">
                       @foreach($questions as $question)
                           <div class="media mb-5">
                               <div class="media-body">
                                   <h3 class="mt-0">
                                       <a href="{{ $question->url }}">{{ $question->title }}</a>
                                   </h3>
                                   <p class="lead">
                                       Asked By <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                       <small>{{ $question->created_date }}</small></p>
                                   {{ Str::limit ($question->body, 250) }}
                               </div>
                           </div>
                       @endforeach
                        <div class="mt-1">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
