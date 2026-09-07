@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Brand</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ dd($data) }} --}}
                                @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{ $row->id }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <p>
                                            <a href="/brand/edit/{{ $row->id }}" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                                <i class="mdi mdi-account-edit  "></i>
                                                <span class="hide-menu">Edit</span>
                                            </a>
                                        </p>
                                        <p>
                                            <a href="/brand/delete/{{ $row->id }}" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                                <i class="mdi mdi-delete  "></i>
                                                <span class="hide-menu">Delete</span>
                                            </a>
                                        </p>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <a href="/brand/add" class="btn btn-success">Add Brand</a>
                </div>
            </div>
        </div>
    </div>
</div>
                
@endsection