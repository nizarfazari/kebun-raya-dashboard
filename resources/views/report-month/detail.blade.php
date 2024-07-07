@extends('layouts.master')
@section('title', 'Laravel')

@section('content')
    <div class="section-header">
        <h1>Pesanan</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Invoices</h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>

        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                            <th>Due Date</th>
                            <th>No Resi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div>{{ $d->no_transaction }}</div>
                                </td>
                                <td class="font-weight-600">
                                    @if (!empty($d->transaction_buyer->first_name) && !empty($d->transaction_buyer->last_name))
                                        {{ $d->transaction_buyer->first_name }} {{ $d->transaction_buyer->last_name }}
                                    @else
                                        Admin
                                    @endif
                                </td>
                                <td>
                                    @if ($d->status == 'PENDING')
                                        <div class="badge badge-primary">PENDING</div>
                                    @elseif($d->status == 'SUDAH-DIBAYAR')
                                        <div class="badge badge-info">SUDAH DIBAYAR</div>
                                    @elseif($d->status == 'DIKIRIM')
                                        <div class="badge badge-warning">MENUNGGU DITERIMA</div>
                                    @elseif($d->status == 'DITERIMA')
                                        <div class="badge badge-success">DITERIMA</div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $d->total_biaya_product + $d->biaya_pengiriman }}</div>
                                </td>
                                <td>{{ $d->created_at }}</td>
                                <td>
                                    @if ($d->no_receipt)
                                        <p class="mb-0">{{ $d->no_receipt }}</p>
                                    @else
                                        <p>No Resi Belum Di inputkan</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

@endsection
@push('page-script')
    <script>
        $('#modal-1').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget); // Button yang membuka modal
            let transactionId = button.data('id'); // Ekstrak info dari atribut data-*
            console.log(transactionId)
            let modal = $(this);
            modal.find('.modal-body #transaction-id').val(transactionId);
        });

        function confirmStatus(orderId) {
            $.ajax({
                url: '/api/transaction/confirm',
                type: 'POST',
                data: {
                    order_id: orderId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    swal('Success!', response.message, 'success');
                    location.reload(); // Reload halaman setelah berhasil
                },
                error: function(response) {
                    swal('Error!', response.responseJSON.message, 'error');
                }
            });
        }


        // $("#swal-6").click(function() {
        //     swal({
        //             title: 'Are you sure?',
        //             text: 'Once deleted, you will not be able to recover this imaginary file!',
        //             icon: 'warning',
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 let button = $(this);
        //                 let orderId = button.data('id'); // Ekstrak info dari atribut data-*
        //                 console.log(orderId)
        //                 // confirmStatus(orderId); // Panggil fungsi untuk konfirmasi status
        //             } else {
        //                 swal('Your imaginary file is safe!');
        //             }
        //         });
        // });

        $(document).on("click", ".swal-button-confirm", function() {
            let button = $(this);
            let orderId = button.data('id');
            swal({
                    title: 'Are you sure?',
                    text: 'Do you want to confirm this order?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: false,
                })
                .then((willConfirm) => {
                    if (willConfirm) {
                        confirmStatus(orderId);
                    } else {
                        swal('Confirmation canceled!');
                    }
                });
        });
    </script>
@endpush
