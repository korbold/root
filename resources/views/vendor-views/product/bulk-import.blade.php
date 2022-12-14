@extends('layouts.vendor.app')

@section('title',__('messages.Food Bulk Import'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="{{asset('public/assets/admin/img/export.png')}}" alt="">
                </div>
                {{__('messages.foods')}} {{__('messages.bulk_import')}}
            </h1>
        </div>
        <div class="card mb-2">
            <div class="card-body">
                <div class="export-steps style-2">
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>{{ translate('STEP 1') }}</h5>
                            <p>
                                {{ translate('Download Excel File') }}
                            </p>
                        </div>
                    </div>
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>{{ translate('STEP 2') }}</h5>
                            <p>
                                {{ translate('Match Spread sheet data according to instruction') }}
                            </p>
                        </div>
                    </div>
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>{{ translate('STEP 3') }}</h5>
                            <p>
                                {{ translate('Validate data and and complete import') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="jumbotron pt-1 pb-4 mb-0" style="background: white">
                    <h2 class="mb-3 text-primary">Instructions</h2>
                    <p>1. Download the format file and fill it with proper data.</p>

                    <p>2. You can download the example file to understand how the data must be filled.</p>

                    <p>3. Once you have downloaded and filled the format file, upload it in the form below and
                        submit.</p>

                    <p> 4. After uploading foods you need to edit them and set image and variations.</p>

                    <p> 5. You can get category id from their list, please input the right ids.</p>

                    <p> 6. Don't forget to fill all the fields </p>

                    <p>7. For veg food enter '1' and for non-veg enter '0' on veg field.</p>

                </div>
                <div class="text-center pb-4">
                    <h3 class="mb-3 export--template-title">{{ translate('Download Spreadsheet Template') }}</h3>
                    <div class="btn--container justify-content-center export--template-btns">
                        <a href="{{asset('public/assets/restaurant_panel/foods_bulk_format.xlsx')}}" download="" class="btn btn-dark">{{ translate('Template with Existing Data') }}</a>
                        <a href="{{asset('public/assets/restaurant_panel/foods_bulk_format_nodata.xlsx')}}" download="" class="btn btn-dark">{{ translate('Template without Data') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <form class="product-form" action="{{route('vendor.food.bulk-import')}}" method="POST"
                enctype="multipart/form-data">
            @csrf
            <div class="card rest-part">
                <div class="card-body">
                    <h4 class="mb-3 mt-2    ">{{ translate('Import Restaurants') }}</h4>
                    <div class="custom-file custom--file">
                        <input type="file" name="products_file" class="form-control" id="bulk__import">
                        <label class="custom-file-label" for="bulk__import">{{ translate('Choose File') }}</label>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset">{{__('messages.reset')}}</button>
                        <button type="submit" class="btn btn--primary">{{__('messages.Submit')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')

@endpush
