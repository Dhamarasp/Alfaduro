@extends('app')

@section('content')
    <div class="card shadow-lg border-3">
        <div class="card-header text-center border-2">
            <h3>Riwayat</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="fw-bold text-center">
                        <tr>
                            <td>No Nota</td>
                            <td>Nama Kasir</td>
                            <td>Tanggal</td>
                            <td>Jam</td>
                            <td>Jumlah</td>
                            <td>Pembayaran</td>
                            <td>Detail</td>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                        <tr>
                            <td>0001</td>
                            <td>Bima</td>
                            <td>21 September 2024</td>
                            <td>12:15</td>
                            <td>Rp. 75.000</td>
                            <td>
                                <span class="badge text-bg-success">Cash</span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-info-circle"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>0001</td>
                            <td>Bima</td>
                            <td>21 September 2024</td>
                            <td>12:15</td>
                            <td>Rp. 75.000</td>
                            <td>
                                <span class="badge text-bg-primary">Qris</span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#transactionDetailModal"><i class="bi bi-info-circle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="transactionDetailModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Transaction Summary Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Cashier Name:</strong> John Doe</p>
                            <p><strong>Transaction Date:</strong> 2024-11-21</p>
                            <p><strong>Transaction ID:</strong> #TRX123456</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Total Amount:</strong> $120.00</p>
                            <p><strong>Payment Method:</strong> Credit Card</p>
                            <p><strong>Status:</strong> <span class="badge bg-success">Completed</span></p>
                        </div>
                    </div>
    
                    <!-- Items Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Product A</td>
                                    <td>2</td>
                                    <td>$25.00</td>
                                    <td>$50.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Product B</td>
                                    <td>1</td>
                                    <td>$70.00</td>
                                    <td>$70.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                                    <td><strong>$120.00</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">
                        <i class="bi bi-printer"></i> Print
                    </button>
                    <button type="button" class="btn btn-success">
                        <i class="bi bi-receipt"></i> Save Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>
    
@endsection