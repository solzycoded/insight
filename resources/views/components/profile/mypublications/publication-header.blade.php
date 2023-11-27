@props(['publication', 'status'])

<h5 class="card-header text-capitalize bg-{{ $status[$publication->status->name] }} text-white">{{ $publication->title }}</h5>