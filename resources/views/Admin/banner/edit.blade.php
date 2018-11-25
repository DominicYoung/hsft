@extends('widget/layout/Admin/body.blade.php')
@section('title',empty($info->title)?$info->title:'添加banner')
@require('static/lib/datetimepicker/css/bootstrap-datetimepicker.css')
@section('body')
    <div class="box box-primary">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="box-body">
            @if(empty($info->id))
                {!! Form::open(['action' => ['Admin\BannerController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\BannerController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('url', '跳转链接', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('url', $info->url,['class' => 'form-control']) !!}
                    <p>链接前面要加http://</p>
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('img', '代表图片', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('img', $info->img,['class' => 'form-control','id'=>'titlepic']) !!}
                        <p>尺寸：1920*450像素</p>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="upload-pic" >上传</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <img id="pre" src="{{$info->img or ''}}" width="400" alt="">
                    </div>

                </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!!  Form::submit('确认提交',['class' => 'btn bg-purple btn-flat']) !!}
                </div>
            </div>


            {!! Form::close() !!}

        </div>
    </div> <!-- /container -->
    @script()
    require('page/Admin/banner/edit');

    @endscript


@endsection

@section("fis_resource")@parent @require('page/Admin/banner/edit.blade.php')@stop