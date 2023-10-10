@php
	$isSuccess    = session()->has('success');
	$bgColor      = $isSuccess ? 'green' : (session()->has('failure') ? 'red' : '');
	$displayAlert = !empty($bgColor);
@endphp

@if ($displayAlert)
	<div x-data="{ show: true }"
		x-init="setTimeout(() => show = false, 4000)"
		x-show="show">
		<div 
			style="bottom: 2%; position: fixed; z-index: 9999;"
			class="d-flex fixed-bottom justify-content-evenly">

			<button 
				style="background-color: {{ $bgColor }}; border-radius: 20px; padding: 5px 15px 5px 15px; color: white; border: 0px; font-weight: bold; box-shadow: 1px 0px 20px #d1d1d1 !important;" 
				class="alert-message-container">
				<span class="alert-message-content">{{ ($isSuccess ? session('success') : session('failure')) }}</span> <i class="bi bi-{{ ($isSuccess ? 'check2-circle' : 'exclamation-circle-fill') }} ps-2"></i>
			</button>

		</div>
	</div>
@endif