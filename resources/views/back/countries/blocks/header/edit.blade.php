@component('blocks.header.index')
    @slot('title', __('messages.edit_country')." ".$country->name)
    @slot('description', '')
@endcomponent
