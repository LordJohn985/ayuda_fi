@if($show)
    <h2 class="margin-bottom-20">Post a Comment</h2>

    <form class="sky-form comment-style" id="sky-form3" method="post" >
        {{ csrf_field() }}
        <input type="hidden" id="reply_to" name="reply_to" />
        <fieldset>
            <div class="sky-space-30">
                @include('includes.form-error', ['field' => 'message'])
                <div>
                    <textarea class="form-control enter-comment-area" placeholder="Write comment here ..." id="message" name="message" rows="8">{{old('message')}}</textarea>
                </div>
            </div>
            <p style="text-align: right"><button class="btn-u" style="margin-top: 20px" type="submit">Send</button></p>
        </fieldset>
    </form>
@endif