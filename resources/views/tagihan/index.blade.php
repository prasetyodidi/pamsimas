@extends('kerangka.master')
@section('content')

<!-- Basic Tables start -->
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Tagihan Pelanggan</h4>
                    <a class="btn btn-primary" href="{{ route('tagihan.create') }}">Tambah Baru</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>   
                    @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>         
                @endif
                <div class="card-content">
                    <div class="card-body">
                        
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pelanggan</th>
                                        <th>Periode</th>
                                        <th>Pemakaian</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tagihans as $tagihan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $tagihan->no_pelanggan }}</td>
                                            <td>{{ $tagihan->periode }}</td> 
                                            <td>{{ $tagihan->jml_pemakaian }}</td>
                                            <td>{{ $tagihan->total}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-warning mx-1" href="{{ route('tagihan.edit', $tagihan->id) }}">Update</a>
                                                    <form action="{{ route('tagihan.destroy', $tagihan->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
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
</section>
<!-- Basic Tables end -->

@endsection