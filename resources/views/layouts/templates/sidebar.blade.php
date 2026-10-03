@php
$menus =
[
[
"label" => 'Dashboard',
"route" => route("admin.dashboard"),
"icon" => 'fas fa-th',
'active' => 'admin.dashboard',
'menu_permission'=>['Dashboard'],
'active_contain'=>'',
],
[
"label" => 'Menu',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-cubes',
'active_contain'=>'admin.category.index,admin.category.create,admin.category.edit,admin.subcategory.index,admin.subcategory.create,admin.subcategory.edit',
'menu_permission'=>['Category List','Category Create','Category Edit/Update','Category Delete','SubCategory
List','SubCategory Create','SubCategory Edit/Update','SubCategory Delete'],
"child" =>
[
[
"label" => 'Menu List',
"route" => route("admin.category.index"),
"active"=>'admin.category.index',
'smenu_permission'=>['Category List'],
],
[
"label" => 'New Menu',
"route" => route("admin.category.create"),
"active"=>'admin.category.create',
'smenu_permission'=>['Category Create'],
],
[
"label" => 'Sub-Menu List',
"route" => route("admin.subcategory.index"),
"active"=>'admin.subcategory.index',
'smenu_permission'=>['SubCategory List'],
],
[
"label" => 'New Sub-Menu',
"route" => route("admin.subcategory.create"),
"active"=>'admin.subcategory.create',
'smenu_permission'=>['SubCategory Create'],
],
],
],
[
"label" => __('Slider List'),
"route" => route("admin.slider.index"),
"icon" => 'fas fa-th',
'active' => 'admin.slider.index',
'menu_permission'=>['Slider List'],
'active_contain'=>'',
],

[
"label" => 'News',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-newspaper',
'active_contain'=>'admin.news.index,admin.news.create,admin.news.edit',
'menu_permission'=>['News List','News Create','News Edit/Update','News Delete'],
"child" =>
[
[
"label" => 'News List',
"route" => route("admin.news.index"),
"active"=>'admin.news.index',
'smenu_permission'=>['News List'],
],
[
"label" => 'Add News',
"route" => route("admin.news.create"),
"active"=>'admin.news.create',
'smenu_permission'=>['News Create'],
],
],
],

[
"label" => 'Notice',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-bullhorn',
'active_contain'=>'admin.notice.index,admin.notice.create,admin.notice.edit',
'menu_permission'=>['Notice List','Notice Create','Notice Edit/Update','Notice Delete'],
"child" =>
[
[
"label" => 'Notice List',
"route" => route("admin.notice.index"),
"active"=>'admin.notice.index',
'smenu_permission'=>['Notice List'],
],
[
"label" => 'Add Notice',
"route" => route("admin.notice.create"),
"active"=>'admin.notice.create',
'smenu_permission'=>['Notice Create'],
],
],
],

[
"label" => 'Location',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-map-marker-alt',
'active_contain'=>'admin.location.index,admin.location.create,admin.location.edit',
'menu_permission'=>['Location List','Location Create','Location Edit/Update','Location Delete'],
"child" =>
[
[
"label" => 'Location List',
"route" => route("admin.location.index"),
"active"=>'admin.location.index',
'smenu_permission'=>['Location List'],
],
[
"label" => 'Location Create',
"route" => route("admin.location.create"),
"active"=>'admin.location.create',
'smenu_permission'=>['Location Create'],
],
],
],

[
"label" => 'Image & Videos Album',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-layer-group',
'active_contain'=>'admin.album_category.index,admin.album_image.index,admin.album_image.create,admin.album_image.edit,admin.album_video.index,admin.album_video.create,admin.album_video.edit',
'menu_permission'=>['Album Category List','Album Image List','Album Image Create','Album Image Edit/Update','Album Video
List','Album Video Create','Album Video List Edit/Update','Album Video Delete'],
"child" =>
[

[
"label" => 'Album Category List',
"route" => route("admin.album_category.index"),
"active"=>'admin.album_category.index',
'smenu_permission'=>['Album Category List'],
],
[
"label" => 'Album Image List',
"route" => route("admin.album_image.index"),
"active"=>'admin.album_image.index,admin.album_image.create,admin.album_image.edit',
'smenu_permission'=>['Album Image List'],
],
[
"label" => 'Album Video List',
"route" => route("admin.album_video.index"),
"active"=>'admin.album_video.index,admin.album_video.create,admin.album_video.edit',
'smenu_permission'=>['Album Video List'],
]

],
],

[
"label" => 'Member',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-users',
'active_contain'=>'admin.member.index,admin.member.create,admin.member.edit,admin.designation.index',
'menu_permission'=>['Member List','Member Create','Member Edit/Update','Member Delete','Designation List','Designation
Create','Designation Edit/Update','Designation Delete'],
"child" =>
[
[
"label" => 'Designation List',
"route" => route("admin.designation.index"),
"active"=>'admin.designation.index',
'smenu_permission'=>['Designation List'],
],
[
"label" => 'Members List',
"route" => route("admin.member.index"),
"active"=>'admin.member.index,admin.member.create,admin.member.edit',
'smenu_permission'=>['Member List'],
],
],
],

[
"label" => 'User Management',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-users-cog',
'active_contain'=>'admin.user.index,admin.user.create,admin.user.edit,admin.role.index,admin.permission.index,admin.assign_permission_to_role.index,admin.assigncategory.index,admin.writer.index',
'menu_permission'=>['User List','User Create','User Edit/Update','User Delete','Writer List','Writer Create','Writer
Edit/Update','Writer Delete'],
"child" =>
[
[
"label" => __('route.role'),
"route" => route("admin.role.index"),
"active"=>'admin.role.index,admin.assign_permission_to_role.index',
'smenu_permission'=>['Category List'],
],
[
"label" => __('route.permission'),
"route" => route("admin.permission.index"),
"active"=>'admin.permission.index',
'smenu_permission'=>['Category List'],
],

[
"label" => __('Users List'),
"route" => route("admin.user.index"),
"active"=>'admin.user.index,admin.user.create,admin.user.edit,admin.assigncategory.index',
'smenu_permission'=>['Category List'],
],

],
],

[
"label" => 'Activities',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-hand-holding-heart',
'active_contain'=>'admin.activities.index,admin.activities.create,admin.activities.edit,admin.donate.index',
'menu_permission'=>[],
"child" =>
[
[
"label" => 'All Activities',
"route" => route("admin.activities.index"),
"active"=>'admin.activities.index,admin.activities.create,admin.activities.edit',
'smenu_permission'=>[],
],
[
"label" => 'Donate Settings',
"route" => route("admin.donate.index"),
"active"=>'admin.donate.index',
'smenu_permission'=>[],
],
],
],
[
"label" => 'Contact Messages',
"route" => route("admin.contact_messages.index"),
"icon" => 'fas fa-envelope',
'active' => 'admin.contact_messages.index,admin.contact_messages.show',
'menu_permission'=>[],
'active_contain'=>'admin.contact_messages.index,admin.contact_messages.show',
],
[
"label" => 'Website Settings',
"route" => 'javascript:void(0)',
"icon" => 'fas fa-globe',
'active_contain'=>'admin.setting.index,admin.socialmedia.index,admin.prayertimer.index,admin.footer.index,admin.footer.edit,admin.website_info.index',
'menu_permission'=>['Title,Logo,Banner Update','Social Media Update','Prayer Time Update','Footer Widget Update'],
"child" =>
[
[
"label" => 'Logo,Banner,Title, Menu',
"route" => route("admin.setting.index"),
"active"=>'admin.setting.index',
'smenu_permission'=>['Title,Logo,Banner Update'],
],
[
"label" => 'Social Media',
"route" => route("admin.socialmedia.index"),
"active"=>'admin.socialmedia.index',
'smenu_permission'=>['Social Media Update'],
],
[
"label" => 'Website Info',
"route" => route("admin.website_info.index"),
"active"=>'admin.website_info.index,admin.website_info.edit',
'smenu_permission'=>['Website Info Update'],
],
[
"label" => 'Footer Widgets',
"route" => route("admin.footer.index"),
"active"=>'admin.footer.index,admin.footer.edit',
'smenu_permission'=>['Footer Widget Update'],
],
],
],

];

$cur_routeName = Route::currentRouteName();
$cur_url = URL::current();

@endphp

<style>
:root {
    --sidebar-bg: #0f172a;
    --sidebar-active-bg: rgba(255, 255, 255, 0.08);
    --sidebar-active-text: #ffffff;
    --sidebar-accent: #c9962a;
    --sidebar-item-gap: 6px;
}

.app-sidebar {
    background-color: var(--sidebar-bg) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.06);
    position: relative;
}

.sidebar-brand {
    border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
    padding: 1.1rem 1rem !important;
    background: rgba(255, 255, 255, 0.02);
}

.sidebar-wrapper {
    height: calc(100vh - 140px) !important;
    overflow-y: auto;
}

.sidebar-menu .nav-item .nav-link {
    border-radius: 10px;
    padding: 0.6rem 0.9rem !important;
    transition: all 0.25s ease;
    color: rgba(255, 255, 255, 0.62);
    display: flex;
    align-items: center;
    font-size: 13.5px;
    font-weight: 500;
    letter-spacing: 0.2px;
}

.sidebar-menu .nav-item .nav-link:hover {
    background: rgba(255, 255, 255, 0.06);
    color: #fff;
}

.sidebar-menu .nav-item>.nav-link.active {
    background: var(--sidebar-active-bg) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-weight: 600;
}

.nav-treeview {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    margin: 0 0.8rem 5px 0.8rem !important;
    padding: 5px 0;
    display: none;
}

.nav-item.menu-open>.nav-treeview {
    display: block;
}

/* prevent AdminLTE auto arrow duplication - hide second arrow if injected */
.nav-arrow+.nav-arrow {
    display: none !important;
}

.nav-treeview .nav-link {
    margin: 2px 10px !important;
    font-size: 0.9rem;
}

.nav-arrow {
    transition: transform 0.3s ease;
    margin-left: auto;
}

.menu-open>.nav-link>.nav-arrow {
    transform: rotate(90deg);
}

.sidebar-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.btn-website {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-radius: 8px;
    text-align: center;
    display: block;
    padding: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.btn-website:hover {
    background: #fff;
    color: #00043a;
}
</style>

<aside class="shadow app-sidebar" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-decoration-none">
            <img src="{{ asset('storage/'.$settings->logo) }}" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text fw-bold ms-2 text-white">{{ $settings->short_name }}</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
                @php $hasMenuAccess = empty($menu['menu_permission']) || (auth()->check() &&
                (auth()->user()->hasRole('Super Admin') || auth()->user()->canAny($menu['menu_permission']))); @endphp
                @if($hasMenuAccess)
                @php
                $activeContainArray = !empty($menu['active_contain']) ? explode(',', $menu['active_contain']) : [];
                $isActiveParent = in_array($cur_routeName, $activeContainArray);
                @endphp

                @if(isset($menu["child"]))

                <li class="nav-item {{ $isActiveParent ? 'menu-open' : '' }}">
                    <a href="{{ $menu['route'] }}" class="nav-link">
                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu['label'] }}
                            <i class="nav-arrow fas fa-chevron-right small"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($menu["child"] as $child)
                        @php $hasChildAccess = empty($child['smenu_permission']) || (auth()->check() &&
                        (auth()->user()->hasRole('Super Admin') || auth()->user()->canAny($child['smenu_permission'])));
                        @endphp
                        @if($hasChildAccess)
                        @php
                        $childActiveArray = explode(',', $child['active']);
                        $isChildActive = in_array($cur_routeName, $childActiveArray);
                        @endphp
                        <li class="nav-item">
                            <a href="{{ $child['route'] }}" class="nav-link {{ $isChildActive ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>{{ $child["label"] }}</p>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @else

                <li class="nav-item">
                    <a href="{{ $menu['route'] }}"
                        class="nav-link {{ in_array($cur_routeName, explode(',', $menu['active'])) ? 'active' : '' }}">
                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                        <p>{{ $menu['label'] }} @if($menu['label']=='Contact Messages' && ($unreadContact ?? 0) >
                            0)<span class="badge bg-danger ms-2">{{ $unreadContact }}</span>@endif</p>
                    </a>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </nav>
    </div>

    <div class="sidebar-footer">
        <a href="{{ url('/') }}" target="_blank" class="btn-website">
            <i class="fas fa-external-link-alt me-2"></i> Go to Website
        </a>
    </div>
</aside>