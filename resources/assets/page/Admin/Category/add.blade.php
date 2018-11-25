@extends('/widget/layout/Admin/body.blade.php')

@section('title', empty($info->title)?'添加分类':$info->title)
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
                {!! Form::open(['action' => ['Admin\CategoryController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\CategoryController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', '名称', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!!  Form::text('title', $info->title,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group-separator"></div>
                <div class="form-group">
                    {!! Form::label('ename', '拼音', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!!  Form::text('ename', $info->ename,['class' => 'form-control']) !!}
                    </div>
                </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                {!! Form::label('orderid', '排序id', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!!  Form::text('orderid', $info->orderid,['class' => 'form-control']) !!}
                </div>
            </div>


                <div class="form-group-separator"></div>
                <div class="form-group">
                    {!! Form::label('show', '是否显示', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">

                        {!! Form::select('show', array('1' => '是', '0' => '否'), $info->show,['class' => 'col-sm-4 form-control']) !!}

                    </div>
                </div>
                <div class="form-group-separator"></div>
                <div class="form-group">
                    {!! Form::label('nav', '是否是顶部导航', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">

                        {!! Form::select('nav', array( '0' => '否','1' => '是'), $info->nav,['class' => 'col-sm-4 form-control']) !!}

                    </div>
                </div>

            <div class="form-group-separator"></div>
            <div class="form-group">
                {!! Form::label('pid', '父级栏目', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!!  Form::select('pid', $mylm,$info->pid,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('kind', '栏目类别', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!!   Form::select('kind', ['1' => '普通产品列表', '2' => '带筛选栏','3' => '普通新闻列表','4' => '下载中心'], $info->kind,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pic', '代表图片', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('pic', $info->pic,['class' => 'form-control','id'=>'titlepic']) !!}
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="upload-pic" >上传</button>
                    </div>
                </div>

            <div class="form-group-separator"></div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!!  Form::submit('确认提交',['class' => 'btn btn-purple']) !!}
                </div>
            </div>


            {!! Form::close() !!}

        </div>
    </div> <!-- /container -->


    @script()
    require('../band/edit');

    @endscript

@endsection

