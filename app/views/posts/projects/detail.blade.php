@extends('master')

@section('content')
    <div class="sub-nav">
        <a href='{{ url("{$parentCategory->controller}/{$parentCategory->slug}")}}'>Tất cả</a>
        @foreach ($subCategories as $subCategory)
            <a href='{{ url("{$parentCategory->controller}/{$parentCategory->slug}/{$subCategory->slug}") }}'>{{ $subCategory->name }}</a>
        @endforeach
        <div class="project-search-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm dự án">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                  </span>
            </div><!-- /input-group -->
        </div>
    </div>
    <div class="body-project padding-top-bottom-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="project-content">
                        <a href='{{ url("{$parentCategory->controller}/{$parentCategory->slug}/{$category->slug}") }}' class="back-to-category">{{ $category->name }}</a>
                        <h3 class="project-title">{{ $post->name }}</h3>
                        <div class="project-content-detail">
                            {{ $post->content }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="comments">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'blueskymaypro'; // required: replace example with your forum shortname

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        </div>
    </div>
@stop