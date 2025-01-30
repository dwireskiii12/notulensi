		@include('layouts.header')
		@include('layouts.menu')
        <div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
				@yield('content')
				</div>
				</div>
				</div>
				<!-- content-wrapper ends -->
		@include('layouts.footer')

