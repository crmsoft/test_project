<script id="js_employees_datatable_template" type="text/x-custom-template">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('main.actions')
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?php echo route('update-employee', ['id' => '']), '/{{ id }}'; ?>">@lang('employee.update')</a>
            <a class="dropdown-item" href="<?php echo route('remove-employee', ['id' => '']), '/{{ id }}'; ?>">@lang('employee.remove')</a>
        </div>
    </div>
</script>