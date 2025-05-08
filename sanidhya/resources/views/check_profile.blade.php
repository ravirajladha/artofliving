@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Add Donation | {{$data['event_name']}} event</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Add Donation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                    <br>
                    <div class="card-body pt-0">
                        <form action="/check_phone" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="event_id" value="{{$data['event_id']}}">
                                <label for="phone">Enter Phone Number</label>
                                <input type="number" id="phone" name="phone" class="form-control">
                                <br>
                                <label for="type">Type of Donation</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="Individual">Individual</option>
                                    <option value="Corporate">Corporate</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @include("inc_sanidhya.footer")
</div>