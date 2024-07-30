@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Transaksi</h1>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction['product']['name'] }}</td>
                                        <td>Rp{{ number_format($transaction['product']['price'], 0, ',', '.') }}</td>
                                        <td>
                                            @if ($transaction['status'] == 'pending')
                                                <span class="badge rounded-pill text-bg-warning">{{ $transaction['status'] }}</span>
                                            @elseif ($transaction['status'] == 'success')
                                                <span class="badge rounded-pill text-bg-success">{{ $transaction['status'] }}</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-danger">{{ $transaction['status'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction['created_at'] }}</td>
                                        <td>
                                        <div class="d-flex">
                                            @if ($transaction['status'] == 'pending')
                                                <form action="{{ route('checkout-process') }}" method="POST" class="button-form mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $transaction['id'] }}">
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $transaction['product']['id'] }}">
                                                    <input type="hidden" name="price"
                                                        value="{{ $transaction['product']['price'] }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                                                </form>

                                                <form action="{{ route('transaction.cancel', $transaction['id']) }}" method="POST" class="button-form mr-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                                </form>

                                                <form action="{{ route('transaction.destroy', $transaction['id']) }}" method="POST" class="button-form mr-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-times"></i> 
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
