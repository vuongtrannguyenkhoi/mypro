<section>
    {{ Form::label('page_id','Page') }}
    <label class="select" for="">
        <select class="selectpicker form-control input-sm" name="page_id">
            @foreach ($pages as $page)
                <option value="{{$page->id}}" @if ( isset($page_id) && $page->id == $page_id)
                    selected
                @endif>{{$page->name}}</option>
            @endforeach
        </select>
        <i></i>
    </label>

</section>
<section>
    {{ Form::label('template','Template') }}
    <label class="select" for="">
        <select class="selectpicker form-control input-sm" name="template">
            @foreach ($templates as  $_template)
                <option value="{{$_template->template}}" @if (isset($template) && $_template->template == $template)
                        selected
                        @endif>{{$_template->name}}</option>
            @endforeach
        </select>
        <i></i>
    </label>
</section>