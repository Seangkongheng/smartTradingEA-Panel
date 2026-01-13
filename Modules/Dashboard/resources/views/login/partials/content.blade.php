<main >
    <section>
        <div class="container min-h-screen flex mx-auto">
            <div class="form-login w-full flex  items-center justify-center px-2 md:px-0">
                <!-- Start Form Login -->
                @include('dashboard::login.partials.formCreate.formCreate')
                <!-- End Form Login -->
            </div>
        </div>
    </section>
</main>
<script>
    function showPassword() {
        const textPassword = document.getElementById('txtPassword');
        const iconShowPasswordjs = document.getElementById('iconShowPassword');
        const iconHiddenPasswordjs = document.getElementById('iconHiddenPassword');
        iconHiddenPasswordjs.toggle.classList.remove
        if (textPassword.type === "password") {
            textPassword.type = "text";
        } else {
            textPassword.type = "password";
        }
    }
</script>
