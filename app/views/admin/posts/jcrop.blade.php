<?php
$img = Image::make($link);
?>
<form id="form-jcrop" class="smart-form">
    <input type="hidden" id="x" name="x" />
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="hidden" id="maxWidth" value="{{$img->width()}}"/>
    <input type="hidden" id="maxHeight" value="{{ $img->height() }}"/>
    <input type="hidden" name="file" id="file"  value="{{$link}}"/>
    <fieldset>
        <div class="row">
            <div class="col col-8">
                <section>
                    <div id="content-base-photo">
                        <img src="{{ url($link) }}" id="jcrop" alt="User Image" @if ($img->width() > 500)
                            style="width: 100%;"
                        @else
                            style="width: auto"
                        @endif>
                    </div>
                </section>
            </div>
            <div class="col col-4">
                <section>
                    Original dimensions {{$img->width()}} × {{$img->height()}}
                </section>
                <section class="photo-submit group-input">
                        <label class="input" style="width:4em;">
                            <input type="text" id="photo-scale-width" onkeyup="scaleChanged(1,1);" value="{{$img->width()}}">
                        </label>
                        x
                        <label class="input" style="width:4em;">
                            <input type="text" id="photo-scale-height" onkeyup="scaleChanged(1,0);" style="width:4em;" value="{{$img->height()}}">
                        </label>
                        <label class="input" style="width:4em;">
                            <button class="btn btn-sm btn-primary" id="photo-submit-scale" onclick="scale();return false;">Scale</button>
                        </label>
                    </section>
                <section>
                    <hr/>
                </section>
                <section class="photo-submit group-input">
                    Selection:
                    <label class="input" style="width:4em;">
                        <input type="text" id="photo-sel-width" onkeyup="setNumSelection();">
                    </label>
                    x
                    <label class="input" style="width:4em;">
                        <input type="text" id="photo-sel-height" onkeyup="setNumSelection();">
                    </label>
                    <label class="input" style="width:4em;">
                        <button class="btn btn-sm btn-primary" id="photo-submit-crop" onclick="crop();return false;">Crop</button>
                    </label>
                </section>
                </div>
        </div>
    </fieldset>
</form>
<script>

    // run pagefunction on load
    loadScript("{{url('backend/plugins/jcrop/jquery.Jcrop.min.js')}}", function() {
        loadScript("{{ url('backend/plugins/jcrop/jquery.color.js')}}", jcrop);
    });
    var jcrop_api;
    var message = $('#alert');
    function jcrop(){

        $('#jcrop').Jcrop({
            trueSize: [{{$img->width()}},{{$img->height()}}],
            onChange : updatePreview,
            onSelect : updatePreview
        }, function() {

            jcrop_api = this;

        });
        function updatePreview(c) {
                showCoords(c);
        };
        function showCoords(c) {

            $('#x').val(Math.round(c.x));
            $('#y').val(Math.round(c.y));
            $('#w').val(Math.round(c.w));
            $('#h').val(Math.round(c.h));
            $('#photo-sel-width').val(Math.round(c.w));
            $('#photo-sel-height').val(Math.round(c.h));
        };

    }
    $( "#form-jcrop" ).on( "submit", function( event ) {
        event.preventDefault();
        var data = $( this ).serialize();

        $.ajax({
            type: 'POST',
            data:data,
            url: "{{ url('api/v1/jcrop/save')}}" ,
            beforeSend: function(){

            },
            success: function(response){
                var res = $.parseJSON(response);
                console.log(res);
                $('#content-base-thumb').html('<img id="base-thumb" src="'+res.thumb+'" alt="User Image">');
                $('#get-jcrop').prop('href','http://localhost/cms/admin/api/v1/jcrop?link='+res.photo);
                remove();
            }
        });
    });

    function scaleChanged(photoId,inputChanged){
        var inputs = $('.photo-submit').find('input');
        var widthEl = $('#photo-scale-width');
        var heightEl = $('#photo-scale-height');
        var oWidth = $('#maxWidth').val();
        var oHeight = $('#maxHeight').val();
        var ratio = oWidth/oHeight;  // Used for aspect ratio

        switch(inputChanged){
            case 0:
                    //change width
                var width = heightEl.val() * ratio;
                    widthEl.prop('value', Math.floor(width) );
                break;
            case 1:
                    //change height
                var height = widthEl.val() / ratio;
                    heightEl.prop('value',Math.floor(height));
                break;
        }
    }

    function scale(){
        $.ajax({
            type:'post',
            data: {
                file: $('#file').val(),
                scaleW:$('#photo-scale-width').val(),
                scaleH:$('#photo-scale-height').val()
            },
            url:'{{ url('api/v1/jcrop/scale') }}',
            success: function(rs){
                var scalePhoto = $.parseJSON(rs);
                var d = new Date();
                $('#jcrop').attr('src',scalePhoto.url+'?'+ d.getTime());
                jcrop_api.setImage(scalePhoto.url+'?'+ d.getTime());
                $('#alert').find('.message').text(scalePhoto.message);
                message.fadeIn(1000,function(){
                    message.fadeOut(5000);
                });
            }
        });
    }

    function setNumSelection(){
        var w = $('#photo-sel-width').val();
        var h = $('#photo-sel-height').val();
        if(!w || !h) return;
        var selectObj = jcrop_api.tellSelect();
        var x1 = selectObj.x;
        var y1 = selectObj.y;
        var x2,y2;
        x2 = parseInt(w) + x1;
        y2 = parseInt(h) + y1;
        jcrop_api.setSelect([ selectObj.x,selectObj.y,x2,y2]);
    }

    function crop(){
        $.ajax({
            type:'post',
            data: {
                file: $('#file').val(),
                x:$('#x').val(),
                y:$('#y').val(),
                w:$('#w').val(),
                h:$('#h').val()
            },
            url:'{{ url('api/v1/jcrop/crop') }}',
            success: function(rs){
                console.log(rs);
                var cropPhoto = $.parseJSON(rs);
                var d = new Date();
                $('#jcrop').attr('src',cropPhoto.url+'?'+ d.getTime());
                $('#photo').attr('src',cropPhoto.url+'?'+ d.getTime());
                jcrop_api.setImage(cropPhoto.url+'?'+ d.getTime());
                $('#alert').find('.message').text(cropPhoto.message);
                message.fadeIn(1000,function(){
                    message.fadeOut(5000);
                });
                $('#photo-sel-width').val('');
                $('#photo-sel-height').val('');
            }
        });
    }
</script>

