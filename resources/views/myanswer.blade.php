@extends('layouts.app')

@section('content')

<div class="container   ">
    <div class="row justify-content-between">
        <div class="col-3">
            <h3>My Answer</h3>
        </div>
    </div>
    <div class="row justify-content-end">
        <div></div>
    </div>
</div>



@foreach ($answers as $answer)
<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center"> 
                        <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">{{ $answer->name }}</a>
                            <div class="text-muted small">{{ $answer->created_at }}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>Member since <strong>01/1/2019</strong></div>
                            <div><strong>134</strong> posts</div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p>{{ $answer->the_answer }}</p>
                </div>

                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>

                    <div class="px-4 pt-3"> 
                        <form method="POST" action="{{ route('thread')}}"> 
                            <input type="hidden" name="id" value="{{ $answer->id_question }}">
                            @csrf
                                <button class="btn btn-primary">
                                    {{ __('See Thread') }}
                                </button>
                               
                            </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection