@extends('layouts.admin.app')

@section('title','Delivery Man Preview')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <i class="tio-user"></i>
                </span>
                <span>{{$dm['f_name'].' '.$dm['l_name']}}</span>
            </h1>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'info'])}}"  aria-disabled="true">{{__('messages.info')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])}}"  aria-disabled="true">{{__('messages.transaction')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'timelog'])}}"  aria-disabled="true">{{translate('messages.timelog')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'conversation'])}}"  aria-disabled="true">{{translate('messages.conversations')}}</a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5 mt-2">
            <div class="card-header flex-wrap border-0">
                <h5 class="card-header-title">{{ __('messages.order')}} {{ __('messages.transactions')}}</h5>
                <div>
                    <input type="date" class="form-control" onchange="set_filter('{{route('admin.delivery-man.preview',['id'=>$dm->id, 'tab'=> 'transaction'])}}',this.value, 'date')" value="{{$date}}">
                </div>
            </div>
            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap justify-content-between table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>{{__('messages.order')}} {{__('messages.id')}}</th>
                                <th>{{__('messages.delivery_fee')}} {{__('messages.earned')}}</th>
                                <th>{{__('messages.date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($digital_transaction = \App\Models\OrderTransaction::where('delivery_man_id', $dm->id)
                        ->when($date, function($query)use($date){
                            return $query->whereDate('created_at', $date);
                        })->paginate(25))
                        @foreach($digital_transaction as $k=>$dt)
                            <tr>
                                <td scope="row">{{$k+$digital_transaction->firstItem()}}</td>
                                <td><a href="{{route('admin.order.details',$dt->order_id)}}">{{$dt->order_id}}</a></td>
                                <td>{{$dt->original_delivery_charge}}</td>
                                <td>{{$dt->created_at->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(!$digital_transaction)
                    <div class="empty--data">
                        <img src="{{asset('/assets/admin/img/empty.png')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
                </div>
            </div>
            <!-- End Body -->
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                                        {{-- <div>
                        1-15 of 380
                    </div> --}}
                    <div>
                        {!!$digital_transaction->links()!!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
<script>
    function request_alert(url, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>
@endpush
