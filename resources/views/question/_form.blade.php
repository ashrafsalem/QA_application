@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" id="question-title" value="{{ old('title', $question->title) }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <string>{{ $errors->first('title') }}</string>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="question-body">Explain Your Question</label>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body', $question->body) }}</textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback">
            <string>{{ $errors->first('body') }}</string>
        </div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>
