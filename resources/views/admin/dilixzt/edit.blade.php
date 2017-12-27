@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑（选择题）</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>更新失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/dilixzts') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="da" value="{{$dilixzt->da }}" class="form-control" required="required" placeholder="请输入标题">
                        <br>
                        {{ $dilixzt->xzttext }}
                        <textarea name="xzttext"  rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $dilixzt->xzttext }}</textarea>
                        <br>
                        <button class="btn btn-lg btn-info">更新</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
