<section style="width:200px">
    {{ Form::label('event_date','Project date',array('class'=>'label')) }}
    <div class="input-group date" id="event_date" data-date="" data-date-format="yyyy-mm-dd">
        {{ Form::text('event_date',null,
        array('class'=>'form-control')) }}
        <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                                                </span>
    </div>
</section>
<section>
    <section>
        <div id="content-base-thumb">
            <img id="base-thumb" src="{{ url($post->featured_thumb) }}" alt="User Image">
        </div>
    </section>
    <section>
        <label class="label">Featured image(Homepage featured project photo)</label>
        <label for="file-featured-photo" class="input input-file">
            <div class="button"><input type="file" name="file-featured-photo" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
        </label>
    </section>
</section>
