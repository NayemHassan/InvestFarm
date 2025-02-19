@extends('backend.admin.main_dashboard')
@section('content')


<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$totalSaving ??  0}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-cart fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Saving Amount</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$inhandBalamce->total_balance ??  0}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-cart fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0"> Hand Cash</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$dueProfit ??  0}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-cart fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Due Profit</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$inhandBalamce->total_profit ??  0}} TK</h5>
                    <div class="ms-auto">
                        <i class='bx bx-dollar fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Collection Profit</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$totalFines}}</h5>
                    <div class="ms-auto">
                        <i class='bx bx-group fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Fine</p>
                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-ibiza">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">5630</h5>
                    <div class="ms-auto">
                        <i class='bx bx-envelope fs-3 text-white'></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Messages</p>
                    <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->



<div class="card radius-10">
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
