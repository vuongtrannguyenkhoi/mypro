<div class="well padding-10">
    <section>
        SEO
        <hr/>
    </section>
    <section>
        {{ Form::label('site_title','Site title',array('class'=>'label')) }}
        <label class="input" for="">
            {{ Form::text('site_title', isset($meta) ? $meta->title : '',
            array(
            'id' => 'site_title',
            'class' => 'form-control input-sm',
            'placeholder' => '',
            )
            )}}</label>
    </section>
    <section>
        {{ Form::label('site_meta_description','Meta Description',array('class'=>'label')) }}
        <label class="textarea" for="">
            {{ Form::textarea('site_meta_description',isset($meta) ? $meta->description:'',
            array(
            'id' => 'site_meta_description',
            'class' => 'form-control',
            'placeholder' => '',
            )
            )}}</label>
    </section>
    <section>
        {{ Form::label('site_meta_keywords','Meta Keywords',array('class'=>'label')) }}
        <label class="textarea" for="">
            {{ Form::textarea('site_meta_keywords',isset($meta) ? $meta->keywords:'',
            array(
            'id' => 'site_meta_keywords',
            'class' => 'form-control',
            'placeholder' => '',
            )
            )}}</label>
    </section>
</div>