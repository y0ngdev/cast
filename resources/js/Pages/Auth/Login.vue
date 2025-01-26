<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Checkbox } from '@/Components/shadcn/ui/checkbox'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { Separator } from '@/Components/shadcn/ui/separator'
import { Sonner } from '@/Components/shadcn/ui/sonner'
import { Icon } from '@iconify/vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { toast } from 'vue-sonner'

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  oauth: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const page = usePage()

function submit() {
  // eslint-disable-next-line no-undef
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}

function signInWithGithub() {
  toast('Logged in successfully!', {
    description: 'You have successfully logged in with Github.',

  })
}
onMounted(() => {
  try {
    if (page.props.flash.error) {
      toast.error(page.props.flash.error)
    }
  }
  catch (e) {

  }
})
</script>

<template>
  <Head title="Log in" />
  <Sonner position="top-right" />
  <div class="relative flex h-screen items-center justify-center">
    <div
      class="absolute h-full w-full bg-[radial-gradient(theme(colors.border/90%)_1px,transparent_1px)] [background-size:20px_20px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"
    />
    <div class="relative w-full max-w-[350px] px-5">
      <ApplicationLogo />

      <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">
          Log in
        </h1>
        <p class="mt-1 text-muted-foreground">
          Enter your email & password to log in.
        </p>
      </div>
      <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
        {{ status }}
      </div>
      <form class="mt-10" @submit.prevent="submit">
        <div class="grid gap-4">
          <!-- Email Field -->
          <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input
              id="email" v-model="form.email" :disabled="form.processing" autocomplete="username"
              autofocus
              placeholder="m@example.com" required
              type="email"
            />
            <InputError :message="form.errors.email" />
          </div>

          <!-- Password Field -->
          <div class="grid gap-2">
            <Label for="password">Password</Label>
            <Input
              id="password" v-model="form.password" :disabled="form.processing"
              autocomplete="current-password"
              required
              type="password"
            />
            <InputError :message="form.errors.password" />
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <Checkbox
                id="remember" v-model:checked="form.remember" :disabled="form.processing"
                name="remember"
              />
              <Label
                class="px-2"
                for="remember"
              >
                Remember me
              </Label>
            </div>
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"

              class="text-sm font-medium text-primary underline underline-offset-2"
            >
              Forgot password?
            </Link>
          </div>

          <!-- Submit Button -->
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full"
            type="submit"
          >
            Log in
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
          Don't have an account?
          <Link
            :href="route('register')"
            class="font-semibold text-primary underline-offset-2 hover:underline"
          >
            Create account
          </Link>
        </div>
      </form>
    </div>
  </div>
</template>
