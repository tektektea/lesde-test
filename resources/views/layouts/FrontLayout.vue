<template>
    <main class="h-screen w-full bg-gray-100">
        <header class="w-full px-5 bg-white shadow-lg h-16">
            <nav class="flex h-full  w-full justify-between items-center">
                <a href="#" class="text-md text-bold">Brand</a>

                <div class="flex gap-5 items-center">
                    <ul class="sm:hidden flex gap-5">
                        <li><a href="#">One</a> </li>
                        <li><a href="#">two</a> </li>
                        <li><a href="#">three</a> </li>
                        <li><a href="#">four</a> </li>
                    </ul>
                    <a :href="route('login')" class="btn-blue">Login</a>
                </div>

            </nav>
        </header>
            <section class="page-container">
                <slot name="content"></slot>
            </section>
        <footer class="bg-white">
            <FooterComponent/>
        </footer>
    </main>
</template>
<script>
import FooterComponent from "../components/FooterComponent.vue";
export default {
    components: {FooterComponent}
}
</script>
