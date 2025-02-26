@extends('backend.admin.main_dashboard')
@section('content')


<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class=" col-6 col-md-3">
        <div class="card radius-10 bg-gradient-ohhappiness ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{number_format($totalSaving ??  0,2)}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-wallet fs-3 text-white'></i>
                
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 95%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Savings Summary</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{number_format($inhandBalamce->total_balance ??  0,2)}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-money fs-3 text-white'></i>
                     
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Cash on Hand</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white">{{ number_format($inhandBalamce->total_profit ?? 0, 2) }} TK</h5>

                    <div class="ms-auto">
                        <i class='bx bx-dollar fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Profit Collected</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card radius-10" style="background: linear-gradient(to right, #00008B, #1E3A5F);">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white">{{ number_format($dueProfit ?? 0, 2) }} TK</h5>

                    <div class="ms-auto">
                        <i class='bx bx-credit-card fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Remaining Profit</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-down-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
  
    <div class="col-6 col-md-3">
        <div class="card radius-10 bg-gradient-ibiza">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white">{{ number_format($totalFines ?? 0, 2) }} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-error fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Fine Summary</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card radius-10 " style="background: linear-gradient(to right, #FF0080, #8A2BE2);">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white"> 0 TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-wallet-alt fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Expense</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-down-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3 justify-content-center ">
        <div class="card radius-10 " style="background: linear-gradient(to right,rgb(255, 115, 0),rgb(44, 38, 37));">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white">{{ number_format($remeningDue ?? 0, 2) }}TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-wallet-alt fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">All Sales Due </p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-down-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
 
</div><!--end row-->

<div class="row">

@foreach($savings as $saving)
    <div class="{{ $loop->last ? 'col-12 col-md-3' : 'col-6 col-md-3' }}">
    <div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="{{ asset($saving->member->photo ?  $saving->member->photo : 'headphones.png') }}" class="rounded-circle p-1 border" width="70" height="70" alt="...">
            <div class="flex-grow-1 ms-3">
                <h5 class="mt-0">{{ $saving->member->name ?? 'N/A' }}</h5>
                <p class="mb-0">{{ $saving->total_savings }}</p>
            </div>
        </div>
    </div>
    </div>
    </div>
    @endforeach
 
</div>

<div class="card radius-10 ">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">Monthly Collection</h5>
            </div>
            <div class="font-22 ms-auto ">
           <div class="d-flex ">
             <select id="yearFilter" class="form-select mx-2">
                    <option value="">Select Year</option>
                    @for ($i = 2023; $i <= now()->year; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <select id="monthFilter" class="form-select ">
                    <option value="">Select Month</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
                    @endfor
                </select></div>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="savingsTableBody">
                    <!-- AJAX Data Load Here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .text-wrap {
    /* display: inline-block; */
    word-wrap: break-word;
    white-space: normal;
    max-width: 100px; /* Adjust width as per your table layout */
}
@media (max-width: 576px) {  /* Small devices (sm) */
    .row {
        --bs-gutter-x: 0.5rem; /* গ্যাপ কমানো হয়েছে */
    }
}

</style>
<script>
    $(document).ready(function() {
        function fetchSavings() {
            let year = $('#yearFilter').val();
            let month = $('#monthFilter').val();
                // console.log(year, month);
            $.ajax({
                url: "{{ route('savings.filter') }}",
                type: "GET",
                data: { year: year, month: month },
                success: function(response) {
                    let rows = "";
                    response.forEach(function(saving) {
                        let note = saving.note ?? 'N/A';
                    // Wrapping note inside a <span> with CSS class for word wrapping
                    note = `<span class="text-wrap">${note}</span>`;

                        rows += `
                            <tr>
                            <td>${saving.member ? saving.member.name : 'N/A'}</td>
                                <td>${saving.month}</td>
                                <td>${saving.amount}</td>
                                <td class="text-wrap"> ${note}</td>
                                <td>
                                   <div class="badge rounded-pill ${saving.status === 'Paid' ? 'bg-light-success text-success' : 'bg-light-danger text-danger'} w-100">
                                        ${saving.status === 'Paid' ? 'Paid' : 'Unpaid'}
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    $('#savingsTableBody').html(rows);
                }
            });
        }

        $('#yearFilter, #monthFilter').change(function() {
            fetchSavings();
        });

        fetchSavings(); // Initial Load
    });
</script>
@endsection
