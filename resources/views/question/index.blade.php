@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>All Questions</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask A New Question</a>
                            </div>
                        </div>

                    </div>
                    <div></div>
                    <div class="card-body">
                        @include('layouts._messages')
                        @foreach($questions as $question)
                           <div class="media mb-5">
                               <div class="d-flex flex-column counters">
                                   <div class="vote">
                                       <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes) }}
                                   </div>
                                   <div class="status {{ $question->status }}">
                                       <strong>{{ $question->answers }}</strong> {{ Str::plural('answer', $question->answers) }}
                                   </div>
                                   <div class="view">
                                       {{ $question->views .' '. Str::plural('view', $question->views) }}
                                   </div>
                               </div>
                               <div class="media-body">
                                   <h3 class="mt-0">
                                       <div class="d-flex align-items-center">
                                           <a href="{{ $question->url }}">{{ $question->title }}</a>
                                           <div class="ml-auto">
                                               <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-small btn-outline-info">Edit</a>
                                               <form action="{{ route('questions.destroy', $question->id) }}" class="form-style" method="post">
                                                   @csrf
                                                   @method('delete')
                                                   <button type="submit" class="btn btn-outline-danger btn-small" onclick="return confirm('are you sure ?');">Delete</button>
                                               </form>
                                           </div>
                                       </div>

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
