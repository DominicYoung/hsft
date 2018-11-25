@extends('/widget/layout/Admin/body.blade.php')
@include('UEditor::head')
@section('title',empty($info->title)?$info->title:'添加')
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


        <div class="box-body">
            @if(empty($info->id))
                {!! Form::open(['action' => ['Admin\NewsController@store'],'class'=>'form-horizontal']) !!}
            @else
                {!! Form::open(['action' => ['Admin\NewsController@update',$info->id],'class'=>'form-horizontal']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', '名称', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!!  Form::text('title', $info->title,['class' => 'form-control']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('ename', '链接英文名称', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('ename', $info->ename,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('re_line', '显示到首页产品线', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::number('re_line', $info->re_line,['class' => 'form-control']) !!}
                        <p>填0则不推荐；填写任意数字则显示到首页，数字越大越靠前</p>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('re_chan', '显示到首页产品推荐', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::number('re_chan', $info->re_chan,['class' => 'form-control']) !!}
                        <p>填0则不推荐；填写任意数字则显示到首页，数字越大越靠前</p>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('titlepic', '代表图片', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('titlepic', $info->titlepic,['class' => 'form-control','id'=>'titlepic']) !!}
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="upload-pic" >上传</button>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('category', '父级栏目', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::select('category', $mylm,$info->category,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', '简介', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::textarea('description', $info->description,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('file', '文件地址(下载栏目用)', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('file', $info->file,['class' => 'form-control','id'=>'fileurl']) !!}
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="upload-file" >上传</button>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('filename', '文件名称(下载栏目用)', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('filename', $info->filename,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('yuyan', '文件语言(下载栏目用)', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('yuyan', $info->yuyan,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('filekind', '文件类别(下载栏目用)', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('filekind', $info->filekind,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('keyword', '关键词', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('keyword', $info->keyword,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('seo', 'seo描述', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        {!!  Form::text('seo', $info->seo,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">国家</label>
                    <div class="col-sm-10">
                        @foreach($list['country'] as $vo)
                            <label >
                                <input type="checkbox" name="country[]" value="{{$vo}}"
                                       @if(isset($info['country'])&&in_array($vo,explode(',',$info['country'])))
                                       checked="true"
                                       @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">品牌</label>
                    <div class="col-sm-10">
                        @foreach($list['band'] as $vo)
                            <label >
                                <input type="checkbox" name="band[]" value="{{$vo}}"
                                       @if(isset($info['band'])&&in_array($vo,explode(',',$info['band'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">量程</label>
                    <div class="col-sm-10">
                        @foreach($list['liangcheng'] as $vo)
                            <label >
                                <input type="checkbox" name="liangcheng[]" value="{{$vo}}"
                                       @if(isset($info['liangcheng'])&&in_array($vo,explode(',',$info['liangcheng'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">外型</label>
                    <div class="col-sm-10">
                        @foreach($list['waixing'] as $vo)
                            <label >
                                <input type="checkbox" name="waixing[]" value="{{$vo}}"
                                       @if(isset($info['waixing'])&&in_array($vo,explode(',',$info['waixing'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">材质</label>
                    <div class="col-sm-10">
                        @foreach($list['caizhi'] as $vo)
                            <label >
                                <input type="checkbox" name="caizhi[]" value="{{$vo}}"
                                       @if(isset($info['caizhi'])&&in_array($vo,explode(',',$info['caizhi'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类</label>
                    <div class="col-sm-10">
                        @foreach($list['fenlei'] as $vo)
                            <label >
                                <input type="checkbox" name="fenlei[]" value="{{$vo}}"
                                       @if(isset($info['fenlei'])&&in_array($vo,explode(',',$info['fenlei'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"> 测量轴</label>
                    <div class="col-sm-10">
                        @foreach($list['celiangzhou'] as $vo)
                            <label >
                                <input type="checkbox" name="celiangzhou[]" value="{{$vo}}"
                                       @if(isset($info['celiangzhou'])&&in_array($vo,explode(',',$info['celiangzhou'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"> 进线方式</label>
                    <div class="col-sm-10">
                        @foreach($list['jinxianfangshi'] as $vo)
                            <label >
                                <input type="checkbox" name="jinxianfangshi[]" value="{{$vo}}"
                                       @if(isset($info['jinxianfangshi'])&&in_array($vo,explode(',',$info['jinxianfangshi'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"> 用途</label>
                    <div class="col-sm-10">
                        @foreach($list['yongtu'] as $vo)
                            <label >
                                <input type="checkbox" name="yongtu[]" value="{{$vo}}"
                                       @if(isset($info['yongtu'])&&in_array($vo,explode(',',$info['yongtu'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"> 压力</label>
                    <div class="col-sm-10">
                        @foreach($list['yali'] as $vo)
                            <label >
                                <input type="checkbox" name="yali[]" value="{{$vo}}"
                                       @if(isset($info['yali'])&&in_array($vo,explode(',',$info['yali'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">  输出</label>
                    <div class="col-sm-10">
                        @foreach($list['shuchu'] as $vo)
                            <label >
                                <input type="checkbox" name="shuchu[]" value="{{$vo}}"
                                       @if(isset($info['shuchu'])&&in_array($vo,explode(',',$info['shuchu'])))
                                       checked="true"
                                        @endif >

                                {{$vo}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '文章内容（用于非产品页面）', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="nr" name="content" type="text/plain">{!!$info->content!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('shuxing', '产品属性', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="shuxing" name="shuxing" type="text/plain">{!!$info->shuxing!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('gaishu', '概述', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="gaishu" name="gaishu" type="text/plain">{!!$info->gaishu!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('texing', '特性', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="texing" name="texing" type="text/plain">{!!$info->texing!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('canshu', '参数', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="canshu" name="canshu" type="text/plain">{!!$info->canshu!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('dinghuo', '订货', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="dinghuo" name="dinghuo" type="text/plain">{!!$info->dinghuo!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('xinghao', '型号', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="xinghao" name="xinghao" type="text/plain">{!!$info->xinghao!!}</script>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('chicuntu', '尺寸图', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <script id="chicuntu" name="chicuntu" type="text/plain">{!!$info->chicuntu!!}</script>
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
    require('./edit');

    @endscript


@endsection

