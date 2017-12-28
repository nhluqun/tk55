@extends('layouts.app')
@section('content')
  <div class="container">
    <!--创建成功显示消息-->
    <div class="alert alert-success" v-if="submitted">
      创建成功!
    </div>
    <!--页面提交之后阻止刷新-->
    <form @submit.prevent="createDilixzt" method="POST">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
      <legend>创建选择题</legend>
      <!--如果xzttext字段验证失败则添加.has-error-->
      <div class="form-group" :class="{'has-error':errors.da}">
        <label>答案</label>
        <input type="text" name="da" class="form-control" v-model="dilixzt.da" value="{{ old('da') }}">
        <!--如果验证失败通过FormError组件显示错误信息-->
      <!--  <formerror v-if="errors.da" :errors="errors"> -->
      <formerror v-if="errors.da" :errors="errors">
          @{{errors.da.join(',')}}
        </formerror>
      </div>
      <!--如果xzttext字段验证失败则添加.has-error-->
      <div class="form-group" :class="{'has-error':errors.xzttext}">
        <label>题干</label>
        <textarea name="xzttext" class="form-control" rows="5" v-model="dilixzt.xzttext">{{ old('xzttext') }}</textarea>
        <!--如果验证失败通过FormError组件显示错误信息-->
        <formerror v-if="errors.xzttext" :errors="errors">
          @{{errors.xzttext.join(',')}}
        </formerror>
      </div>
      <button type="submit" class="btn btn-primary">创建选择题</button>
    </form>
  </div>
@endsection
