<x-layout>
    @include ('._header')

    <section id="sign-up">
        <x-form.section :action="'/signup'" :method="'POST'" :header="['title' => 'Sign Up', 'description' => 'you need to signup, to pubish your work.']">

            <div>
                {{-- email input --}}
                <x-form.input type="email" placeholder="Enter your email address" required :name="'email'" :display="'Email Address'" />

                {{-- password input --}}
                <x-form.input type="password" placeholder="*********" required :name="'password'" :display="'Password'" />

                {{-- password input --}}
                <x-form.input type="password" placeholder="*********" required :name="'re_password'" :display="'Re-Password'" />
            </div>

            <div class="text-center">
                <x-form.submit-button>
                    Proceed <i class="bi bi-arrow-right"></i>
                </x-form.submit-button>

                <p>Already have an account? <a href="/login">Signin</a></p>
            </div>

        </x-form.section>
    </section>
</x-layout>