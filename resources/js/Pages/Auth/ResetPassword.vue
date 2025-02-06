<script setup>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Lock } from 'lucide-vue-next'

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

function submit() {
  // eslint-disable-next-line no-undef
  form.post(route('password.store'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
  })
}
</script>

<template>
  <Head title="Reset Password" />
  <div class="relative flex h-screen items-center justify-center">
    <div
      class="absolute h-full w-full bg-[radial-gradient(theme(colors.border/90%)_1px,transparent_1px)] [background-size:20px_20px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"
    />
    <div class="relative z-[2] w-full max-w-[340px] px-5">
      <div
        class="mx-auto mb-6 flex size-14 items-center justify-center rounded-lg border bg-background"
      >
        <Lock />
      </div>

      <div class="flex flex-col items-center text-center">
        <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">
          New Password
        </h1>
        <p class="mt-1 text-muted-foreground">
          Enter your new password below.
        </p>
      </div>

      <form class="mt-10" @submit.prevent="submit">
        <div class="grid gap-4">
          <!-- Email Field -->
          <div class="grid gap-2">
            <Input
              v-model="form.email"
              autofocus

              placeholder="m@example.com"
              required
              type="hidden"
            />
          </div>

          <!-- Password Field -->
          <div class="grid gap-2">
            <Label for="password">Password</Label>
            <Input
              id="password" v-model="form.password" :disabled="form.processing"
              autocomplete="current-password" autofocus
              placeholder="••••••••"
              required
              type="password"
            />
            <InputError :message="form.errors.password" />
          </div>  <!-- Confirm Password Field -->
          <div class="grid gap-2">
            <Label for="confirm_password">Confirm Password</Label>
            <Input
              id="confirm_password" v-model="form.password_confirmation" :disabled="form.processing"

              name="confirmPassword"
              placeholder="••••••••"
              required
              type="password"
            />
            <InputError :message="form.errors.password_confirmation" />
          </div>
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full"
            type="submit"
          >
            Set new password
          </Button>
        </div>
      </form>
      <p class="mt-8 text-center text-sm">
        <Link :href="route('login')" class="font-semibold text-primary underline-offset-2 hover:underline">
          Back to Log in
        </Link>
      </p>
    </div>
  </div>
</template>
