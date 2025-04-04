<!--begin::Aside-->
<div
	id="kt_aside"
	class="aside py-9 user-select-none {{ theme()->printHtmlClasses('aside', false) }}"
	data-kt-drawer="true"
	data-kt-drawer-name="aside"
	data-kt-drawer-activate="{default: true, lg: false}"
	data-kt-drawer-overlay="true"
	data-kt-drawer-width="{default:'200px', '300px': '250px'}"
	data-kt-drawer-direction="start"
	data-kt-drawer-toggle="#kt_aside_toggle"
	>

    <!--begin::Brand-->
    <div class="flex-column-auto px-9 mb-9" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ theme()->getPageUrl('') }}" class="d-flex flex-column align-items-center">
            <img alt="Logo" src="{{ asset('apdiamantes/media/apdiamantes-dark.svg') }}" class="h-50px mb-2" />
            <img alt="Logo" src="{{ asset('apdiamantes/media/logo_blanco_2.png') }}" class="h-40px" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
	<div class="aside-menu flex-column-fluid ps-5 pe-3 mb-9" id="kt_aside_menu">
        {{ theme()->getView('layout/aside/_menu') }}
    </div>
    <!--end::Aside menu-->

    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
        <!--begin::User panel-->
        <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-circle symbol-40px">
                    <img src="{{ auth()->user()->getAvatarUrlAttribute() }}" alt="photo"/>
                </div>
                <!--end::Avatar-->

                <!--begin::User info-->
                <div class="ms-2">
                    <!--begin::Name-->
                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder lh-1">{{ auth()->user()->name }}</a>
                    <!--end::Name-->

                    <!--begin::Major-->
                    <span class="text-muted fw-bold mt-2 d-block fs-7 lh-1">Nivel<i class="ms-2 fas fa-solid fa-certificate"></i><i class="ms-2 fas fa-solid fa-ribbon"></i><i class="ms-2 fas fa-solid fa-otter"></i></span>
                    <!--end::Major-->
                </div>
                <!--end::User info-->
            </div>
            <!--end::Wrapper-->

            <!--begin::User menu-->
            <div class="ms-1">
                <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                    {!! theme()->getSvgIcon("icons/duotune/coding/cod001.svg", "svg-icon-1") !!}
                </div>
                {{ theme()->getView('partials/topbar/_user-menu', array(
                    "language-menu-placement" => "right-end",
                    "language-menu-flip" => "{default: 'top', lg: ''}",
                    "subscription-menu-placement" => "right-end",
                    "subscription-menu-flip" => "{default: 'bottom', lg: ''}"
                )) }}
            </div>
            <!--end::User menu-->
        </div>
        <!--end::User panel-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Aside-->
