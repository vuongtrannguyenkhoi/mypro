<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-title txt-color-blueDark">
                User profile <span>&gt;
			 Update profile</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well well-sm">
                {{ Form::model($userProfile,array(
                'route' => array('portal.user-profile.update'),
                'class' => 'smart-form',
                'files'  => true
                )) }}
                <fieldset>
                    <div class="row">
                        <section class="col col-lg-3">
                            <img src="{{ url($userProfile->thumb) }}" alt="" style="width: 100px"/>
                            <label class="label">Hình đại diện</label>
                            <label for="file" class="input input-file">
                                <div class="button">
                                    <input type="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <section class="col col-lg-3">
                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                {{ Form::text('first_name',null,
                                array(
                                'id' => 'first_name',
                                'class' => 'form-control input-sm',
                                'placeholder' => 'First name',
                                'required'
                                )
                                )}}
                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <section class="col col-lg-3">
                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                {{ Form::text('last_name',null,
                                array(
                                'id' => 'last_name',
                                'class' => 'form-control input-sm',
                                'placeholder' => 'Last name',
                                'required'
                                )
                                )}}
                            </label>
                        </section>
                    </div>
                </fieldset>
                <div class="form-actions text-align-left">
                    <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
