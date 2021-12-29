@extends('layouts.app')

@section('content')
@include('layouts.nav')
<style>
    .resomer {
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 25px;
        -webkit-line-clamp: 2;
        height: 55px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
</style>
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 20px">

            <style>
                .breadcrumb {
                    background: white;
                }
            </style>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm" style="border: 1px solid rgba(0,0,0,.125);">
                    <li class="breadcrumb-item">Danh sách báo cáo chương truyện tranh</li>
                </ol>
            </nav>


            <div class="card">
                <div class="card-header shadow-sm" style="background: white; font-size: 18px">
                    @if (session('status'))
                    <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                    @endif

                    @role('admin')
                    @php
                    $count_reportError = count($reportErrTranh);
                    @endphp

                    <button type="button" class="btn btn-success mb-3">
                        Tổng báo cáo <span class="badge badge-light">{{$count_reportError}}</span>
                    </button>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người báo lỗi</th>
                                <th scope="col">Lý do</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ở chương truyện</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($reportErrTranh as $key => $reportError)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <th scope="row">{{$reportError->user->name}}</th>
                                <th scope="row">
                                    @if($reportError->chonloi==0)
                                    <span class="text text-danger">Tranh có cảnh nhạy cảm</span>
                                    @elseif($reportError->chonloi==1)
                                    <span class="text text-danger">Truyện tranh vi phạm bản quyền</span>
                                    @elseif($reportError->chonloi==2)
                                    <span class="text text-danger">Tranh có cảnh nóng </span>
                                    @elseif($reportError->chonloi==3)
                                    <span class="text text-danger">Tranh bạo hành</span>
                                    @else
                                    <span class="text text-danger">Báo cáo khác</span>
                                    @endif
                                </th>
                                <th scope="row">{{$reportError->noidung}}</th>



                                <th scope="row"><a href="{{url('xem-chapter-tranh/'.$reportError->chaptertranh->truyen->slug_truyen.'/'.$reportError->chaptertranh->slug_chaptertranh)}}">{{$reportError->chaptertranh->truyen->tentruyen}}</a></th>

                                <th scope="row">
                                    <form action="{{route('report.destroy',[ $reportError -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa thông báo này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </th>


                            </tr>
                            @endforeach




                        </tbody>



                    </table>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection