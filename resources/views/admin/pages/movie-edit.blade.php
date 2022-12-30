@extends('admin.layouts.base')
@section('title', 'Edit Movie')
@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- Alert Here --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.movie.update', $movie->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="e.g Guardian of The Galaxy" value="{!! $movie->title !!}">
                        </div>
                        <div class="form-group">
                            <label for="trailer">Trailer</label>
                            <input type="text" class="form-control" id="trailer" name="trailer"
                                placeholder="Trailer Video url" value="{!! $movie->trailer !!}">
                        </div>
                        <div class="form-group">
                            <label for="movie">Movie</label>
                            <input type="text" class="form-control" id="movie" name="movie"
                                placeholder="Movie Video url" value="{!! $movie->movie !!}">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="1h 39m"
                                value="{!! $movie->duration !!}">
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date" id="release-date" data-target-input="nearest">
                                <input type="text" name="release_date" class="form-control datetimepicker-input"
                                    data-target="#release-date" value="{!! $movie->release_date !!}" />
                                <div class="input-group-append" data-target="#release-date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="casts">Casts</label>
                            <input type="text" class="form-control" id="casts" name="casts"
                                placeholder="Jackie Chan" value="{!! $movie->casts !!}">
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <input type="text" class="form-control" id="categories" name="categories"
                                placeholder="Action, Fantasy" value="{!! $movie->categories !!}">
                        </div>
                        <div class="form-group">
                            <label for="small-thumbnail">Small Thumbnail</label>
                            <input type="file" class="form-control" name="small_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="large-thumbnail">Large Thumbnail</label>
                            <input type="file" class="form-control" name="large_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="short-about">Short About</label>
                            <input type="text" class="form-control" id="short-about" name="short_about"
                                placeholder="Awesome Movie" value="{!! $movie->short_about !!}">
                        </div>
                        <div class="form-group">
                            <label for="about">About</label>
                            <input type="text" class="form-control" id="about" name="about"
                                placeholder="Awesome Movie" value="{!! $movie->about !!}">
                        </div>
                        <div class="form-group">
                            <label>Featured</label>
                            <select class="custom-select" name="featured">
                                <option value="0" @if ($movie->featured == '0') selected @endif>No</option>
                                <option value="1" @if ($movie->featured == '1') selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#release-date").datetimepicker({
            format: 'yyyy-MM-DD'
        });
    </script>
@endsection
