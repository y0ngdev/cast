<script setup>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { Sonner } from '@/Components/shadcn/ui/sonner'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { KeyRound } from 'lucide-vue-next'
import { toast } from 'vue-sonner'

defineProps({
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
})

function submit() {
  // eslint-disable-next-line no-undef
  form.post(route('password.email'), {

    onSuccess: (d) => {
      toast('Link sent!', {
        description: d.props.status,

      })
    },
  })
}
</script>

<template>
  <Head title="Forgot Password" />
  <Sonner position="top-right" />
  <div class="relative flex h-screen items-center justify-center">
    <div
      class="absolute h-full w-full bg-[radial-gradient(theme(colors.border/90%)_1px,transparent_1px)] [background-size:20px_20px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"
    />
    <div class="relative z-[2] w-full max-w-[340px] px-5">
      <div
        class="mx-auto mb-6 flex size-14 items-center justify-center rounded-lg border bg-background"
      >
        <KeyRound class="size-6" />
      </div>

      <div class="flex flex-col items-center text-center">
        <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">
          Forgot Password
        </h1>
        <p class="mt-1 text-muted-foreground">
          No worries, we'll send you reset instructions.
        </p>
      </div>

      <form class="mt-10" @submit.prevent="submit">
        <div class="grid gap-5">
          <Label for="email">Email</Label>
          <Input
            id="email" v-model="form.email" :disabled="form.processing" autocomplete="username"
            autofocus
            placeholder="m@example.com" required
            type="email"
          />
          <InputError :message="form.errors.email" />
          <!-- Submit Button -->
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full"
            type="submit"
          >
            Send Link
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
