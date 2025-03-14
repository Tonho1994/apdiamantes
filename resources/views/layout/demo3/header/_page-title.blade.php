@php
    $breadcrumb = bootstrap()->getBreadcrumb();
@endphp

<!--begin::Page title-->
<div
    class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0"
    data-kt-swapper="true"
    data-kt-swapper-mode="prepend"
    data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">

    <!--begin::Heading-->
    <h1 class="d-flex flex-column text-dark fw-bolder my-0 fs-1 user-select-none">
        {{ theme()->getOption('page', 'title') }}
        @if (theme()->getOption('layout', 'page-title/description') && theme()->hasOption('page', 'description'))
            <small class="text-muted fs-6 fw-bold ms-1 pt-1">{{ theme()->getOption('page', 'description') }}</small>
        @endif
    </h1>
    <!--end::Heading-->

    @if ( theme()->getOption('layout', 'page-title/breadcrumb') && !empty($breadcrumb) )
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb fw-bold fs-base my-1 user-select-none">
            @foreach ($breadcrumb as $item)
                @if ( $item['active'] === true )
                    <li class="breadcrumb-item text-dark">
                        {{ $item['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item text-muted">
                        {{ $item['title'] }}
                    </li>
                @endif

            @endforeach
        </ul>
        <!--end::Breadcrumb-->
    @endif
</div>
<!--end::Page title--->
