<x-layout>

    <section style="padding: 30px 60px">
        {{-- header --}}
        <h4>Publish Your Work</h4>
    
        <div class="pt-0">
            <p>In order for us to publish your work, we’ll need a few details from you.</p>
            <p>Don’t worry, this won’t take longer than 10 mins of your time, you’ll be done in “5” steps. </p>
            <p class="fw-bold">Click “Continue” below, whenever you’re ready to start.</p>

            <div class="ms-10" style="max-width: 160px">
                <a href="/publish-your-work/personal-details" 
                    class="nav-link btn text-white ps-2 pe-2 rounded-4"
                    style="background-color: #6200AF; font-size: 22px">
                    Continue <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        @php
            // forget "journal" session
            session()->forget(['journal', 'manuscript']);
        @endphp
    </section>
</x-layout>