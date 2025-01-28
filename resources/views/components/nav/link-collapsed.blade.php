<a class="nav-link collapsed" href="#"
    data-bs-toggle="collapse"
    data-bs-target="#{{$id}}"
    aria-expanded="false"
    aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="{{$icon}}"></i></div>
    {{$content}}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="{{$id}}"
    aria-labelledby="headingOne"
    data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        {{$slot}}
    </nav>
</div>