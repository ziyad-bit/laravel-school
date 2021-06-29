
<div class="parent2 d-flex justify-content-center">
    <form  id="questionForm">
        @foreach ($questions as $question)
        <div class="card bg-light mb-3" style="max-width: 24rem;">
            <div class="card-header"><span style="font-size: 20px">{{$page_request}}</span>-<span>  {{$question->question}}?</span></div>
            <div class="card-body">
                
                    @csrf
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="choice" value="choice1"
                                > {{$question->choice1}}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="choice" value="choice2"
                                > {{$question->choice2}}
                        </label>
                    </div>
                    @if ($question->choice3)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="choice" value="choice3"
                                    > {{$question->choice3}}
                            </label>
                        </div>
                    @endif
    
                    @if ($question->choice4)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="choice" value="choice4"
                                    > {{$question->choice4}}
                            </label>
                        </div>
                    
                    @endif
    
                    @if ($question->choice5)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="choice" value="choice5"
                                    > {{$question->choice5}}
                            </label>
                        </div>
                    @endif
                    <input type="hidden" name='id' value="{{$question->id}}">
                    <input type="hidden" name="agax" value="1">
            </div>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary" >next</button>
        </form>
</div>

