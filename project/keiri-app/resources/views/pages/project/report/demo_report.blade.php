@extends('layouts.app')

@section('title', __('Report | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb
                :title="'Project'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Report', 'url' => route('showViewReportDemo')],
                ]"
            />

            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('exportReportDemo') }}" class="btn btn-outline-success">Export</a>
                        </div>

                        <div class="d-flex gap-3">
                            <form class="row row-cols-lg-auto g-2" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <input type="file" name="import_file" class="form-control @error('import_file') is-invalid @enderror">
                                    @error('import_file')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-secondary">Import</button>
                                </div>
                            </form>

                            <div>
                                <a href="" class="btn btn-outline-primary">Download template</a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>User</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
