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
                {!! Form::open(['action' => ['Admin\SystemController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\SystemController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('name', '名称', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('name', $info->name,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('ename', '调用名称', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('ename', $info->ename,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '内容（每项之间用英文逗号隔开）', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::textarea('contents', $info->content,['class' => 'form-control']) !!}
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
    require('page/Admin/system/edit');

    @endscript


@endsection

@section("fis_resource")@parent @require('page/Admin/system/edit.blade.php')@stop