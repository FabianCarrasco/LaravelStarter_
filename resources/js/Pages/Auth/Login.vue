<script setup lang="ts">
    import {ref, onErrorCaptured} from "vue";
    import {useForm, router, Link} from "@inertiajs/vue3";
    import {route} from "ziggy-js";
    import Layout from "@/Layouts/Layout.vue";

    const form = useForm({
        email: '',
        password: '',
        remember: false
    })

    const submit = () => {
        form.post(route('login.store') ,  {
            onFinish: () => {
                form.reset('password')
            }
        })
    }
</script>

<template>
    <Layout>
        <div class="w-screen h-screen justify-center items-center flex ">
            <div class="card bg-base-100 w-96 shadow-xl">
                <div class="card-body flex flex-col gap-4">
                    <h1 class="card-title">Login</h1>
                    <form
                        @submit.prevent="submit"
                        class="flex flex-col gap-4"
                    >
                        <div>
                            <label class="text-sm" for="email">Email</label>
                            <input
                                class="w-full input max-w-xs input-bordered"
                                type="email"
                                name="email"
                                id="email"
                                v-model="form.email"
                                required
                            >
                            <p class="text-sm text-red-600" v-if="form.errors.email">{{form.errors.email}}</p>
                        </div>
                        <div>
                            <label class="text-sm" for="password">Password</label>
                            <input
                                class="w-full input max-w-xs input-bordered"
                                type="password"
                                name="password"
                                id="password"
                                v-model="form.password"
                                required
                            >
                        </div>
                        <input type="submit" value="Login" class="btn btn-neutral w-full max-w-xs mt-6">
                        <p class="text-sm">Don't have an account? <Link :href="route('signup.create')">Sign Up</Link></p>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
