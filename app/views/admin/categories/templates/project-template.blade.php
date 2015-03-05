
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