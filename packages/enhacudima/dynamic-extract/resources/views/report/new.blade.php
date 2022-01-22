@extends('extract-view::vendor.layouts.master')

@section('title','Dynamic Extract | Reports')

@section('content_header')
    <a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
@stop

@section('content')
    <div class="row">
    @foreach($data as $report)
        @if(config('dynamic-extract.auth') ? Auth::user()->can($report->can) : true)
        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$report->name}}</h5>
            <p class="card-text">{{$report->comments}}.</p>
            <div class="text-end">
                <a href="{{url('report/config/open',$report->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-cloud-download-alt"></i></a>
            </div>
        </div>
        </div>
        @endif
    @endforeach
    </div>

@stop
