<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { Separator } from '@/Components/shadcn/ui/separator'
import Sonner from '@/Components/shadcn/ui/sonner/Sonner.vue'
import { Icon } from '@iconify/vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Eye, EyeClosed } from 'lucide-vue-next'
import { ref } from 'vue'

defineProps({
  oauth: {
    type: Boolean,
  },

})
const form = useForm({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
})
const show = ref(false)

function submit() {
  // eslint-disable-next-line no-undef
  form.post(route('register'), {
    onFinish: () => form.reset('password'),
  })
}

function signInWithGithub() {
  // eslint-disable-next-line no-undef
  window.location.href = route('github.redirect')
}
</script>

<template>
  <Head title="Register" />
  <Sonner position="top-right" />

  <div class="relative flex h-screen items-center justify-center">
    <div
      class="absolute h-full w-full bg-[radial-gradient(theme(colors.border/90%)_1px,transparent_1px)] [background-size:20px_20px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"
    />
    <div class=" relative w-full max-w-[350px] px-5">
      <ApplicationLogo />

      <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">
          Sign Up
        </h1>
        <p class="mt-1 text-muted-foreground">
          Create an account to get started.
        </p>
      </div>

      <form class="mt-10" @submit.prevent="submit">
        <div class="grid gap-4">
          <!-- Username Field -->
          <div class="grid gap-2">
            <Label for="username">Username</Label>
            <Input
              id="username" v-model="form.username" :disabled="form.processing"
              autofocus
              placeholder="JohnDoe" required
            />
            <InputError :message="form.errors.username" />
          </div>
          <!-- Email Field -->
          <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input
              id="email" v-model="form.email" :disabled="form.processing" autocomplete="email"

              placeholder="m@example.com" required
              type="email"
            />
            <InputError :message="form.errors.email" />
          </div>

          <!-- Password Field -->
          <!--                    todo: password meter -->

          <div class="grid gap-2">
            <Label for="password">Password</Label>
            <div class="relative w-full max-w-sm items-center">
              <Input
                id="password" v-model="form.password" :disabled="form.processing"
                :type="show ? 'text' : 'password'"
                autocomplete="current-password"
                placeholder="Enter Password"
                required
              />
              <span
                class="absolute end-0 inset-y-0 flex items-center justify-center px-4 cursor-pointer"
                @click="show = !show"
              >
                <Eye v-if="!show" class="size-4" />
                <EyeClosed v-else class="size-4" />
              </span>
            </div>
            <InputError :message="form.errors.password" />
          </div>

          <!-- Submit Button -->
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full"
            type="submit"
          >
            Create account
          </Button>
        </div>
        <div v-if="oauth">
          <!-- OAuth Divider -->
          <Separator class="my-8 " label="OR" />

          <!-- OAuth Providers -->
          <Button
            :disabled="form.processing" class="w-full" type="button" variant="outline"
            @click="signInWithGithub()"
          >
            <Icon height="24" icon="mdi:github" width="24" />
            <span class="ml-2">Continue with Github</span>
          </Button>
        </div>

        <!-- Register Link -->
        <div class="mt-4 text-center text-sm text-muted-foreground">
          Already have an account?
          <Link
            :href="route('login')"
            class="font-semibold text-primary underline-offset-2 hover:underline"
          >
            Log in
          </Link>
        </div>
      </form>
    </div>
  </div>
</template>
