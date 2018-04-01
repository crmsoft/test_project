@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{
                            isset($employee) ?
                                __('employee.edit-employee',[ 'employee' => $employee->full_name ]):
                                __('employee.add-employee')
                        }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('store-employee')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($employee))
                                <input type="hidden" name="employee_id" value="{{$employee->id}}">
                            @endif

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('employee.name')</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') ? old('first_name') : (isset($employee) ? $employee->first_name:'') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('employee.last-name')</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') ? old('last_name') : (isset($employee) ? $employee->last_name:'') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('employee.company')</label>

                                <div class="col-md-6">
                                    <select name="company_id" class="form-control">
                                        <?php $current_company = isset($employee) ? $employee->company_id:0; ?>
                                        @foreach($companies as $company)
                                            <option {{ $company->id == $current_company ? 'selected':'' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('employee.e-mail')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ? old('email') : (isset($employee) ? $employee->email:'') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('employee.phone')</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ? old('phone') : (isset($employee) ? $employee->phone:'') }}">

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($employee) ? __('employee.update') : __('employee.submit') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
