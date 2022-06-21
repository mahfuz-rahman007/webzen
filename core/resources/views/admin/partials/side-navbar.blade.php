@php
    $lang_code = $currentLang->code;
@endphp

<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-light-primary">
    <!-- Sidebar -->
    <div class="sidebar pt-0 mt-0">
        <!-- Sidebar user panel (optional) -->
        <div class="header-logo px-5 py-2">
            <a href="{{ route('admin.dashboard') }}" class="name text-dark" target="_blank">
                <img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
            </a>
        </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }} " class="nav-link @if(request()->path() == 'admin/dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
              </a>
            </li>

            <li
                class="nav-item has-treeview
                @if (request()->path() == 'admin/basicinfo') menu-open
                @elseif(request()->path() == 'admin/seoinfo') menu-open
                @elseif(request()->path() == 'admin/custom-css') menu-open
                @elseif(request()->path() == 'admin/slinks') menu-open
                @elseif(request()->path() == 'admin/email-config') menu-open
                @elseif(request()->path() == 'admin/scripts') menu-open
                @elseif(request()->path() == 'admin/cookie-alert') menu-open
                @elseif(request()->path() == 'admin/page-visibility') menu-open
                @elseif(request()->is('admin/slinks/edit/*')) menu-open @endif">
                <a href="#"
                    class="nav-link
                    @if (request()->path() == 'admin/basicinfo') active
                    @elseif(request()->path() == 'admin/seoinfo') active
                    @elseif(request()->path() == 'admin/custom-css') active
                    @elseif(request()->path() == 'admin/slinks') active
                    @elseif(request()->path() == 'admin/scripts') active
                    @elseif(request()->path() == 'admin/cookie-alert') active
                    @elseif(request()->path() == 'admin/email-config') active
                    @elseif(request()->path() == 'admin/page-visibility') active
                    @elseif(request()->is('admin/slinks/edit/*')) active @endif">
                    <i class="nav-icon fas fas fa-cog"></i>
                    <p>
                        {{ __('General Setting') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('admin.setting.basicinfo') . '?language=' . $lang_code }}"
                            class="nav-link @if (request()->path() == 'admin/basicinfo') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Basic Information') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mail.config') }}" class="nav-link @if (request()->path() == 'admin/email-config') active @endif">

                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Email Configuration') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.slinks') }}"
                            class="nav-link @if (request()->path() == 'admin/slinks') active
                        @elseif(request()->is('admin/slinks/edit/*')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Social Links') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.seoinfo') . '?language=' . $lang_code }}"
                            class="nav-link @if (request()->path() == 'admin/seoinfo') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('SEO Information') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.scripts') }}"
                            class="nav-link @if (request()->path() == 'admin/scripts') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Scripts') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pagevisibility') }}"
                            class="nav-link  @if (request()->path() == 'admin/page-visibility') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Pages Visibility') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cookiealert') . '?language=' . $lang_code }}"
                            class="nav-link  @if (request()->path() == 'admin/cookie-alert') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Cookie Alert') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customcss') }}"
                            class="nav-link  @if (request()->path() == 'admin/custom-css') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Custom CSS') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.package') . '?language=' . $lang_code }}"
                    class="nav-link
                    @if (request()->path() == 'admin/package') active
                    @elseif(request()->path() == 'admin/package/add') active
                    @elseif(request()->is('admin/package/edit/*')) active @endif">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>
                        {{ __('Packages') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.home') . '?language=' . $lang_code }}" class="nav-link
                @if(request()->path() == 'admin/home') active
                @endif">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    {{ __('Home') }}
                  </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.about') . '?language=' . $lang_code }}" class="nav-link
                @if(request()->path() == 'admin/about') active
                @endif">
                  <i class="nav-icon fas fa-user-alt"></i>
                  <p>
                    {{ __('About') }}
                  </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.funfact'). '?language=' . $lang_code }}" class="nav-link
                @if(request()->path() == 'admin/funfact') active
                @elseif(request()->path() == 'admin/funfact/add') active
                @elseif(request()->is('admin/funfact/edit/*')) active
                @endif">
                    <i class="nav-icon fas fa-smile-beam"></i>
                    <p>
                        {{ __('Funfact') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.service') . '?language=' . $lang_code }} " class="nav-link
                    @if(request()->path() == 'admin/service') active
                    @elseif(request()->path() == 'admin/service/add') active
                    @elseif(request()->is('admin/service/edit/*')) active
                    @endif">
                    <i class="nav-icon fas fa-magic"></i>
                    <p>
                        {{ __('Services') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.testimonial') . '?language=' . $lang_code }}" class="nav-link
                    @if(request()->path() == 'admin/testimonial') active
                    @elseif(request()->path() == 'admin/testimonial/add') active
                    @elseif(request()->is('admin/testimonial/edit/*')) active
                    @endif">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                        {{ __('Testimonial') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.currency'). '?language=' . $lang_code}}" class="nav-link
                    @if(request()->path() == 'admin/currency') active
                    @elseif(request()->path() == 'admin/currency/add') active
                    @elseif(request()->is('admin/currency/edit/*')) active
                    @endif">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        {{ __('Currency') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.team'). '?language=' . $lang_code}}" class="nav-link
                    @if(request()->path() == 'admin/team') active
                    @elseif(request()->path() == 'admin/team/add') active
                    @elseif(request()->is('admin/team/edit/*')) active
                    @endif">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Team') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.faq'). '?language=' . $lang_code }}" class="nav-link
                @if(request()->path() == 'admin/faq') active
                @elseif(request()->path() == 'admin/faq/add') active
                @elseif(request()->is('admin/faq/edit/*')) active
                @endif">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>
                        {{ __('Faq') }}
                    </p>
                </a>
            </li>


            <li class="nav-item has-treeview
                @if(request()->path() == 'admin/blog') menu-open
                @elseif(request()->path() == 'admin/blog/blog-category') menu-open
                @elseif(request()->path() == 'admin/blog/blog-category/add') menu-open
                @elseif(request()->path() == 'admin/blog/add') menu-open
                @elseif(request()->is('admin/blog/blog-category/edit/*')) menu-open
                @elseif(request()->is('admin/blog/edit/*')) menu-open
                @endif">
                <a href="#" class="nav-link
                        @if(request()->path() == 'admin/blog') active
                        @elseif(request()->path() == 'admin/blog/blog-category') active
                        @elseif(request()->path() == 'admin/blog/blog-category/add') active
                        @elseif(request()->path() == 'admin/blog/add') active
                        @elseif(request()->is('admin/blog/blog-category/edit/*')) active
                        @elseif(request()->is('admin/blog/edit/*')) active
                        @endif">
                    <i class="nav-icon fab fa-blogger-b"></i>
                    <p>
                        {{ __('Blog') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.bcategory'). '?language=' . $lang_code }}" class="nav-link
                            @if(request()->path() == 'admin/blog/blog-category') active
                            @elseif(request()->path() == 'admin/blog/blog-category/add') active
                            @elseif(request()->is('admin/blog/blog-category/edit/*')) active
                            @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Blog Categories') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.blog'). '?language=' . $lang_code }}" class="nav-link
                            @if(request()->path() == 'admin/blog') active
                            @elseif(request()->path() == 'admin/blog/add') active
                            @elseif(request()->is('admin/blog/edit/*')) active
                            @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Blog') }}</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.client') }}" class="nav-link
                @if(request()->path() == 'admin/client') active
                @elseif(request()->path() == 'admin/client/add') active
                @elseif(request()->is('admin/client/edit/*')) active
                @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    {{ __('Client') }}
                  </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.dynamic_page') . '?language=' . $lang_code }}"
                    class="nav-link @if (request()->path() == 'admin/dynamic-page') active @endif">

                    <i class="nav-icon  fab fa-sith"></i>
                    <p>
                        {{ __('Dynamic Page') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.language.index') }}" class="nav-link
                    @if(request()->path() == 'admin/languages') active
                    @elseif(request()->path() == 'admin/language/add') active
                    @elseif(request()->is('admin/language/21/edit')) active
                    @elseif(request()->is('admin/language/*/edit/keyword')) active
                    @endif">
                    <i class="nav-icon fas fa-language"></i>
                    <p>
                        {{ __('Language') }}
                    </p>
                </a>
            </li>
          <li class="nav-item">
            <a href="{{  route('admin.footer'). '?language=' . $lang_code }}" class="nav-link @if(request()->path() == 'admin/footer') active @endif">
              <i class="nav-icon fas fa-feather-alt"></i>
              <p>
                {{ __('Footer') }}
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
