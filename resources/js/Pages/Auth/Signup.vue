<script setup lang="ts">
    import Layout from "@/Layouts/Layout.vue";
    import {ref} from "vue";
    import {useForm, Link} from "@inertiajs/vue3";

    let form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    })

    const submit = () => {
        form.post(route('signup.store'), {
            onFinish: () => {
                form.reset('password', 'password_confirmation')
                console.log(form.errors)
            }
        })

    }
</script>

<template>
    <Layout>
        <div class="w-screen h-screen justify-center items-center flex">
            <div class="card bg-base-100 w-96 shadow-xl">
                <div class="card-body flex flex-col gap-4">
                    <h1 class="card-title">Sign Up</h1>
                    <form
                        @submit.prevent="submit"
                        class="flex flex-col gap-4"
                    >
                        <div>
                            <label class="text-sm" for="name">Name</label>
                            <input
                                class="w-full input max-w-xs input-bordered"
                                type="text"
                                name="name"
                                id="name"
                                v-model="form.name"
                                required
                            >
                        </div>
                        <div>
                            <label for="email">Email</label>
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
                            <label for="password">Password</label>
                            <input
                                class="w-full input max-w-xs input-bordered"
                                type="password"
                                name="password"
                                id="password"
                                v-model="form.password"
                                required
                            >
                            <p class="text-sm text-red-600" v-if="form.errors.password">{{form.errors.password}}</p>
                        </div>
                        <div>
                            <label for="confirmPassword">Confirm Password</label>
                            <input
                                class="w-full input max-w-xs input-bordered"
                                type="password"
                                name="password_confirmation"
                                id="confirmPassword"
                                v-model="form.password_confirmation"
                                required
                            >
                        </div>
                        <input type="submit" value="Sign Up" class="btn btn-neutral w-full max-w-xs mt-6">
                        <p class="text-sm">Already have an account? <Link :href="route('login.create')">Log In</Link></p>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
