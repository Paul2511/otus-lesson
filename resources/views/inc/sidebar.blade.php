    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                        <a href="/home" data-active="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span> @lang('navbar.Dashboard')</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ ($category_name === 'records') ? 'active' : '' }}">
                        <a href="#record" data-active="{{ ($category_name === 'records') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'records') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                <span>@lang('navbar.Records')</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'records') ? 'show' : '' }}" id="record" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'simple') ? 'active' : '' }}">
                                <a href="/records/simple">@lang('navbar.Simple')</a>
                            </li>
                            <li class="{{ ($page_name === 'advanced') ? 'active' : '' }}">
                                <a href="/records/advanced">@lang('navbar.Advanced')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ ($category_name === 'statistic') ? 'active' : '' }}">
                        <a href="#statistic" data-active="{{ ($category_name === 'statistic') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'statistic') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                                <span>@lang('navbar.Statistic')</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'statistic') ? 'show' : '' }}" id="statistic" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'online') ? 'active' : '' }}">
                                <a href="/statistic/online">@lang('navbar.Online')</a>
                            </li>
                            <li class="{{ ($page_name === 'efficiency') ? 'active' : '' }}">
                                <a href="/statistic/efficiency">@lang('navbar.Efficiency')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ ($category_name === 'reports') ? 'active' : '' }}">
                        <a href="#reports" data-active="{{ ($category_name === 'reports') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'reports') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>@lang('navbar.Reports')</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'reports') ? 'show' : '' }}" id="reports" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'stat') ? 'active' : '' }}">
                                <a href="/reports/stat">@lang('navbar.Stat')</a>
                            </li>
                            <li class="{{ ($page_name === 'service') ? 'active' : '' }}">
                                <a href="/reports/service">@lang('navbar.Service')</a>
                            </li>
                            <li class="{{ ($page_name === 'processed-calls') ? 'active' : '' }}">
                                <a href="/reports/processed-calls">@lang('navbar.Processed-calls')</a>
                            </li>
                            <li class="{{ ($page_name === 'balance') ? 'active' : '' }}">
                                <a href="/reports/balance">@lang('navbar.Balance')</a>
                            </li>
                            <li class="{{ ($page_name === 'quotas') ? 'active' : '' }}">
                                <a href="/reports/quotas">@lang('navbar.Quotas')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ ($category_name === 'about-us') ? 'active' : '' }}">
                        <a href="/about" data-active="{{ ($category_name === 'about') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'about') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>@lang('navbar.About')</span>
                            </div>
                        </a>
                    </li>

            </ul>

        </nav>

    </div>
    <!--  END SIDEBAR  -->