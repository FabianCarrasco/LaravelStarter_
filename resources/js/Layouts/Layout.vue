<script setup lang="ts">
    import {computed, ComputedRef} from "vue";
    import {usePage, router, Link} from "@inertiajs/vue3";
    import {PageProps, Page} from "@inertiajs/core"
    import {User} from "@/types";

    const page: Page<PageProps> = usePage()
    const user: ComputedRef<User> = computed(() => page.props.auth.user)

    const isNotLoginOrSignup = computed(() => {
        const currentPath = page.url
        const loginPath = new URL(route('login.create')).pathname
        const signupPath = new URL(route('signup.create')).pathname

        return currentPath !== loginPath && currentPath !== signupPath
    })

    const logout = () => {
        router.post(route('logout.destroy'));
    }
</script>

<template>
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <Link :href="route('welcome')" class="btn btn-ghost text-xl">Site</Link>
        </div>
        <div v-if="isNotLoginOrSignup" class="flex-none">
            <ul v-if="user" class="menu menu-horizontal px-1">
                <li>
                    <details>
                        <summary>{{user.name}}</summary>
                        <ul class="bg-base-100 rounded-t-none p-2">
                            <li>
                                <button @click="logout">Logout</button>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
            <ul v-else class="menu menu-horizontal px-1">
                <li>
                    <Link :href="route('login.create')">Login</Link>
                </li>
            </ul>
        </div>
    </div>
    <slot/>
</template>

<style scoped>

</style>
