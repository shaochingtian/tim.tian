@extends('inheritance.layouts') {{--继承模板--}}

@section('header')  {{--替换原section中内容--}}
    @parent {{--原始模板中的也显示，即父模板--}}
    hadfh
@endsection

@section('content') {{--没有@parent功能--}}
    section 内容1

{{--模板中输出PHP变量--}}
<p>{{ $name }}</p>

{{--模板中调用PHP代码--}}
<p>{{ date('Y-m-d H:i:s') }}</p>
<p>{{ in_array($name,$arry) ? 'true':'false' }}
<p>{{ var_dump($arry) }}</p>
<p>{{isset($name)?$name:'default1'}}</p>
<p>{{$name or 'default'}}</p>
{{--原样输出，加@--}}
<p>@{{ $name }}</p>

{{--引入子视图,并传值--}}
@include('student.common',['message'=>'error!!!!!'])


{{--模板的流程控制 if,unless,for,foreach,forelse--}}
@if($name == 'tsq')
    i'm tsq.
@elseif($name == 'jack')
    i'm jack
@else
    who am i?
@endif
<br>
@if(in_array($name,$arry))
    true
@else
    false
@endif
<br>
@unless($name != 'tsq')
    我是tsq
@else
    我不是tsq
@endunless
<br>
@for($i=0; $i<10; $i++)
    {{ $i }}
@endfor
{{-- foreach 数组遍历 --}}
@foreach($students as $stu)
    {{ $stu->age }}
@endforeach
{{-- forelse 特殊循环,$stu如果有值则运行,无值显示null --}}
@forelse($students as $stu)
    {{ $stu->name }}<br>
@empty
    null
@endforelse

@stop

@section('footer')
    模板中的URL
    {{--url通过路由名称生成  action通过控制器的方法  rout通过路由别名生成URL--}}
    <a href="{{ url('section2') }}">url</a>
    <br>
    <a href="{{ action('StudentController@section1') }}">action</a>
    <br>
    <a href="{{ route('url') }}">route</a>
@endsection






