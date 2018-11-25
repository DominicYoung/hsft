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
                {!! Form::open(['action' => ['Admin\AdminController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\AdminController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('truename', '真实姓名', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('truename', $info->truename,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('account', '账号', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('account', $info->account,['class' => 'form-control']) !!}
                    </div>
                </div>
            <div class="form-group">
                {!! Form::label('password', '密码', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('password', $info->password,['class' => 'form-control']) !!}
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
    require('page/Admin/admin/edit');

    @endscript


@endsection

@section("fis_resource")@parent @require('page/Admin/admin/edit.blade.php')@stop