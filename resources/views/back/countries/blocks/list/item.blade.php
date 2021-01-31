<?php /** @var Country $country */

use App\Models\Country; ?>
<tr>
    <td class="border-b-2 border-gray-300 text-center tracking-wider">{{ $country->id }}</td>
    <td class="border-b-2 border-gray-300 text-center tracking-wider">
        <a class="text-blue-600 hover:text-black" href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_SHOW, $country->id) }}">
            {{ $country->name }} ({{ $country->continent_name }})
        </a>
    </td>
    <td class="border-b-2 border-gray-300 text-center tracking-wider">{{ $country->status }}</td>
    <td class="border-b-2 border-gray-300 text-center tracking-wider">{{ $country->created_at }}</td>
</tr>
