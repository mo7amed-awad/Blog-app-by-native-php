<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Company name</a>
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <svg class="bi me-2" width="40" height="32">
      <use xlink:href="#bootstrap" />
    </svg>
    <span class="fs-4">Simple header</span>
  </a>

  <ul class="nav nav-pills">
    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>

    <?php if (session('locale') == 'ar'): ?>
      <li class="nav-item"><a href="{{url(ADMIN.'/lang?lang=en')}}" class="nav-link">En</a></li>
    <?php else: ?>
      <li class="nav-item"><a href="{{url(ADMIN.'/lang?lang=ar')}}" class="nav-link">عربي</a></li>
    <?php endif; ?>
  </ul>

</header>