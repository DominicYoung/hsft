@extends('/widget/layout/Admin/body.blade.php')
@section('title',$info->title)
@require('/static/lib/datetimepicker/css/bootstrap-datetimepicker.css')
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

        <div class="box-header with-border">
            <p>已有{{$count}}人报名</p>
        </div>

        <div class="box-body">
        {!! Form::open(['action' => ['Admin\GamesController@update',$info->id],'class'=>'form-horizontal','id'=>'myForm']) !!}

        <div class="form-group">
            {!! Form::label('title', '比赛名称', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                {!!  Form::text('title', $info->title,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('starttime', '比赛开始时间', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                    {!!  Form::text('starttime', $info->starttime,['class' => 'form-control','readonly','id'=>'starttime']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('endtime', '比赛结束时间', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                      {!!  Form::text('endtime', $info->endtime,['class' => 'form-control','readonly','id'=>'endtime']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('address', '比赛地点', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <div class="input-group">
                    {!!  Form::text('address', $info->address,['class' => 'form-control','id'=>'map','readonly']) !!}
                    <div class="input-group-addon infoad" style="cursor: pointer">
                        <i class="glyphicon glyphicon-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>
            <div class="form-group">
                {!! Form::label('house', '详细地址', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('house', $info->house,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('customs', '用户自定义字段', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('customs', $info->customs,['class' => 'form-control']) !!}
                    <span id="helpBlock" class="help-block">字段之间用英文逗号隔开（,）</span>
                </div>
            </div>
        <div class="form-group">
            {!! Form::label('people', '人数上限', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                {!!  Form::number('people', $info->people,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('deadline', '报名截止时间', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                    {!!  Form::text('deadline', $info->deadline,['class' => 'form-control','readonly','id'=>'deadline'])!!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('fee', '报名费用', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                {!!  Form::number('fee', $info->fee,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('groups', '参赛组别', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                {!!  Form::text('groups', $info->groups,['class' => 'form-control']) !!}
                <span id="helpBlock" class="help-block">分组之间用英文逗号隔开（,）</span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('note', '赛程详解', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
                {!!  Form::textarea('note', $info->note,['class' => 'form-control','rows'=>8]) !!}
            </div>
        </div>
            <div class="form-group">
                {!! Form::label('tags', '比赛标签', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('tags', $info->tags,['class' => 'form-control']) !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!!  Form::submit('修改并提交',['class' => 'btn bg-purple btn-flat']) !!}
            </div>
        </div>


        {!! Form::close() !!}

            </div>
    </div> <!-- /container -->



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
    require('./edit');

    @endscript


@endsection

