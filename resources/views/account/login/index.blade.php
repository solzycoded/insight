<x-layout>
    @include ('._header')

    <section id="log-in">
        <x-form.section :action="'/login'" :method="'POST'" :header="['title' => 'Log In', 'description' => 'you need to login, to pubish your work.']">

            <div>
                {{-- email input --}}
                <x-form.input type="email" placeholder="Enter your email address" required :name="'email'" :display="'Email Address'" />

                {{-- password input --}}
                <x-form.input type="password" placeholder="*********" required :name="'password'" :display="'Password'" />
            </div>

            <div class="text-center">
                <x-form.submit-button>
                    Login <i class="bi bi-arrow-right"></i>
                </x-form.submit-button>

                <p>Don't have an account yet? <a href="/signup">Signup</a></p>
            </div>

        </x-form.section>
    </section>
</x-layout>