<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
      <div class="p-6 space-y-8 md:space-y-6 sm:p-8">
        <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xle">
          Sign in to your account
        </h1>
        <form @submit.prevent="submit" class="flex flex-col space-y-6">

          <div>
            <InputLabel for="email" value="Email" class="block mb-2 text-sm font-medium text-gray-900"/>

            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full bg-gray-50 text-sm"
              v-model="form.email"
              placeholder="name@example.com"
              required
              autofocus
              autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email"/>
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Password" class="block mb-2 text-sm font-medium text-gray-900"/>

            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full bg-gray-50 text-sm"
              v-model="form.password"
              placeholder="••••••••"
              required
              autocomplete="current-password"
            />

            <InputError class="mt-2" :message="form.errors.password"/>
          </div>

          <div class="flex items-center justify-between">
            <div class="block">
              <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember"/>
                <span class="text-sm text-gray-600 ml-2">Remember me</span>
              </label>
            </div>
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="text-sm font-medium text-blue-500 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Forgot password?
            </Link>
          </div>

          <PrimaryButton class="w-full flex justify-center" :class="{ 'opacity-25': form.processing }"
                         :disabled="form.processing">
            Log in
          </PrimaryButton>
          <p class="text-sm text-center font-light text-gray-500">
            Don’t have an account yet? <a :href="route('register')"
                                          class="font-medium text-blue-500 hover:underline">Sign
            up</a>
          </p>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>
