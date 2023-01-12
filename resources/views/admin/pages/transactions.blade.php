@extends('admin.layouts.base')
@section('title', 'Transactions')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">

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
                            <table id="transaction-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Package</th>
                                        <th>User</th>
                                        <th>Amount Transaction</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{!! $item->id !!}</td>
                                            <td>{!! $item->package->name !!}</td>
                                            <td>{!! $item->user->name !!}</td>
                                            <td>{!! $item->amount !!}</td>
                                            <td>{!! $item->transaction_code !!}</td>
                                            <td>{!! $item->status !!}</td>
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
        $("#transaction-list").DataTable();
    </script>
@endsection
