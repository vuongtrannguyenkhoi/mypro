<!-- row -->
<div class="row">

    <div class="col-sm-12">

        <div class="well fill">

            <table class="table table-striped table-forum">
                <thead>
                <tr>
                    <th colspan="2">
                        <a href="#forums/{{$forum->id}}/{{$forum->slug }}">{{ $forum->name }}</a> > {{ $topic->name }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <!-- Post -->
                <tr>
                    <td class="text-center">
                        <a href="">
                            <strong>{{ $topic->author->username }}</strong></a>
                    </td>
                    <td>Ngày đăng: <em>{{ $topic->postedAtPresenter() }}</em></td>
                </tr>
                <tr>
                    <td class="text-center" style="width: 12%;">
                        <div class="push-bit">
                            <a href="">
                                @if ($topic->author->profile)
                                    {{ $topic->author->profile->avata() }}
                                @else
                                <img src="{{ url('frontend/images/default-avata.png') }}"/>
                                @endif
                            </a>
                        </div>
                    </td>
                    <td>
                       {{ $topic->content }}
                    </td>
                </tr>
                <!-- end Post -->
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
        $('meta[name=keywords]').attr('content', "{{ $topic->meta_keywords }}");
        $('meta[name=description]').attr('content', "{{ $topic->meta_descriptions }}");
</script>
<!-- end row -->