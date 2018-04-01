@extends('layouts.app')

@section('content')

<!-- action button template, mustache js render -->
@include('templates.company-action-buttons')
<!-- end template -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="card">
                <div class="card-header">
                    @lang('company.companies')
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table
                            id="js_companies_datatable"
                            data-ajax-url="{{route('list-companies')}}"
                            class="table">
                        <thead>
                            <tr>
                                <th>@lang('company.id')</th>
                                <th>@lang('company.logo')</th>
                                <th>@lang('company.name')</th>
                                <th>@lang('company.email')</th>
                                <th>@lang('company.phone')</th>
                                <th>@lang('company.fax')</th>
                                <th>@lang('company.address')</th>
                                <th>@lang('company.website')</th>
                                <th>@lang('main.created_at')</th>
                                <th>@lang('main.actions')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
