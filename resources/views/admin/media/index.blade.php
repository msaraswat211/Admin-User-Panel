@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

        {{--{!! Form::open(['method'=>'DELETE','action'=>'AdminMediaController@deleteMedia', 'class'=>'form-inline']) !!}--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::select('checkBoxArray', ['delete' => 'Delete'],['class'=>'form-control']) !!}--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                  {{--{!! Form::submit('Submit',['class'=>'btn btn-danger']) !!}--}}
                {{--</div>--}}

            {{--{!! Form::close() !!}--}}

      <table class="table table-hover">
          <thead>
            <tr>
                {{--<th><input type="checkbox" class="form-control"></th>--}}
              <th>Id</th>
              <th>Name</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>

          @foreach($medias as $media)
            <tr>
                {{--<td><input type="checkbox" name="checkBoxArray[]" value="{{ $media->id }}" class="form-control"></td>--}}
              <td>{{ $media->id }}</td>
              <td><img src="{{ $media->file }}" alt="" class="img-responsive img-rounded"></td>
              <td>{{ $media->created_at->diffForHumans() }}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $media->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Submit',['class'=>'btn btn-danger']) !!}
                    </div>
                </td>
            </tr>
              @endforeach

          </tbody>
        </table>

@endsection