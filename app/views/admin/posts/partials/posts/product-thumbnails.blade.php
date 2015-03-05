<section>
    {{ Form::label('gallery_id','Gallery') }}
    <label class="select" for="">
        <select class="selectpicker form-control input-sm" name="gallery_id">
            <option value="">Select a gallery</option>
            @foreach ($galleries as $gallery)
                <option value="{{$gallery->id}}" @if ( isset($post) && $gallery->id == $post->gallery_id)
                        selected
                        @endif>{{$gallery->name}}</option>
            @endforeach
        </select>
        <i></i>
    </label>
</section>