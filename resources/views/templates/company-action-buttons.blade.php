<script id="js_companies_datatable_template" type="text/x-custom-template">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('main.actions')
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?php echo route('update-company', ['id' => '']), '/{{ id }}'; ?>">@lang('company.update')</a>
            <a class="dropdown-item" href="<?php echo route('remove-company', ['id' => '']), '/{{ id }}'; ?>">@lang('company.remove')</a>
        </div>
    </div>
</script>