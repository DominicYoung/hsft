@extends('widget/layout/Admin/body.blade.php')
@section('title',empty($info->title)?$info->title:'添加人员')
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
                {!! Form::open(['action' => ['Admin\BandController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\BandController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', '名称', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('title', $info->title,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('description', '描述', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::textarea('description', $info->description,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('seo', 'seo描述', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('seo', $info->seo,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('keyword', '关键词', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('keyword', $info->keyword,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('titlepic', '代表图片', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('titlepic', $info->titlepic,['class' => 'form-control','id'=>'titlepic']) !!}
                        <p>230*150像素</p>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="upload-pic" >上传</button>
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
    require('page/Admin/band/edit');

    @endscript


@endsection

@section("fis_resource")@parent @require('page/Admin/band/edit.blade.php')@stop