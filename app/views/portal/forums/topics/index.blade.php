<!-- row -->
<div class="row">

<div class="col-sm-12">

<div class="well">

<table class="table table-striped table-forum">
<thead>
<tr>
    <th colspan="2">{{ $forum->name }}</th>
    <th class="hidden-xs hidden-sm" style="width: 200px;">Người đăng</th>
</tr>
</thead>
<tbody>
<!-- TR -->
@foreach ($topics as $topic)
<tr>
    <td colspan="2">
        <h4><a href="#forums/topics/{{$topic->id}}/{{$topic->slug}}">
                {{ $topic->name }}
            </a>
        </h4>
    </td>
    <td class="hidden-xs hidden-sm">đăng bởi
        <a href="javascript:void(0);">{{ $topic->author->username }}</a>
        <br>
        <small><i>{{ $topic->postedAtPresenter() }}</i></small>
    </td>
</tr>
@endforeach
<!-- end TR -->
</tbody>
</table>

<div class="text-center">
    {{ $topics->links() }}
</div>

</div>
</div>

</div>

<!-- end row -->
