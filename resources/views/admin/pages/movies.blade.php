@extends('admin.layouts.base')
@section('title', 'Movies')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <a href="{{ route('admin.movie.create') }}" class="btn btn-primary">Create Movie</a>
                        </div>
                    </div>

                    @if (session()->has('success'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success">
                                    {!! session('success') !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <table id="movie-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Small Thumbnail</th>
                                        <th>Large Thumbnail</th>
                                        <th>Categories</th>
                                        <th>Casts</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-center" width="20%">
                                                <img src="{{ asset('storage/thumbnail/' . $item->small_thumbnail) }}"
                                                    alt="" width="50%">
                                            </td>
                                            <td class="text-center" width="20%">
                                                <img src="{{ asset('storage/thumbnail/' . $item->large_thumbnail) }}"
                                                    alt="" width="30%">
                                            </td>
                                            <td>{!! $item->categories !!}</td>
                                            <td>{!! $item->casts !!}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.movie.edit', $item->id) }}"
                                                    class="btn btn-secondary btn-sm m-1"
                                                    title="Edit Movie: {!! $item->title !!}"><i
                                                        class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalConfirm{!! $item->id !!}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="modal fade" id="modalConfirm{!! $item->id !!}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modalConfirm{!! $item->id !!}Title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Deletion Movie</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure want to delete this movie?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No</button>
                                                                <form action="{!! route('admin.movie.delete', $item->id) !!}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-outline-danger" type="submit"
                                                                        title="Delete Movie: {!! $item->title !!}">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#movie-list").DataTable();
    </script>
@endsection
