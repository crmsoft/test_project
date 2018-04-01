@extends('layouts.app')

@section('content')

    <!-- action button template, mustache js render -->
    @include('templates.employee-action-buttons')
    <!-- end template -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @lang('employee.employees')
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table
                                id="js_employees_datatable"
                                data-ajax-url="{{route('list-employees')}}"
                                class="table">
                            <thead>
                                <tr>
                                    <th>@lang('employee.id')</th>
                                    <th>@lang('employee.name')</th>
                                    <th>@lang('employee.surname')</th>
                                    <th>@lang('employee.company')</th>
                                    <th>@lang('employee.email')</th>
                                    <th>@lang('employee.phone')</th>
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
