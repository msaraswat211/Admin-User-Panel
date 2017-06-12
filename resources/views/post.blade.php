@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{ $post->user->name }}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : $post->photoPlaceholder() }}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{!! $post->body !!}</p>

        <hr>

        <!-- Blog Comments -->

        {{--flash massage--}}
        @if(session()->has('comment_message'))

            <p>{{ session('comment_message') }}</p>

        @endif

        @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
                {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            {!! Form::label('body','Comment:') !!}
                            {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>3]) !!}
                        </div>

                        <div class="form-group">
                          {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}

        </div>

        @endif

        <hr>

        <!-- Posted Comments -->

        @if(count($comments)>0)

            @foreach($comments as $comment)

        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img height="64" class="media-object" src="{{ $comment->photo }}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->author }}
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </h4>
                {{ $comment->body }}

            @if(count($comment->replies) >0)

                @foreach($comment->replies as $replies)

                    @if($replies->is_active==1)

            <!-- Nested Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{ $replies->photo }}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $replies->author }}
                            <small>{{ $replies->created_at->diffForHumans() }}</small>
                        </h4>
                        {{ $replies->body }}
                    </div>
                </div>
                <!-- End Nested Comment -->

            @endif

            @endforeach

            @endif
                <br>

                    {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}

                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <div class="form-group">
                                {!! Form::label('body','Reply:') !!}
                                {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>'2']) !!}
                            </div>

                            <div class="form-group">
                              {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                            </div>



                        {!! Form::close() !!}
            </div>
        </div>

        @endforeach

        @endif

@endsection