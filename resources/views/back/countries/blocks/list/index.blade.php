<table class="table min-w-full my-4">
    @include('back.countries.blocks.list.header', $countries)
    <tbody>
    @each('back.countries.blocks.list.item', $countries, 'country')
    </tbody>
</table>

{{ $countries->links() }}
