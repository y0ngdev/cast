<script setup>
import { Button } from '@/Components/shadcn/ui/button'
import { Sonner } from '@/Components/shadcn/ui/sonner'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { MailCheck } from 'lucide-vue-next'
import { computed } from 'vue'
import { toast } from 'vue-sonner'

// eslint-disable-next-line no-unused-vars
const props = defineProps({
  status: {
    type: String,
  },
})

const form = useForm({})

function submit() {
    // eslint-disable-next-line no-undef
  form.post(route('verification.send'), {

    onSuccess: (d) => {
      if (d.props.status === 'verification-link-sent') {
        toast('Link sent!', {
          description: ' A new verification link has been sent to the email address you provided in your profile settings.',

        })
      }
    },
  })
}

const page = usePage()

const user = computed(() => page.props.auth.user)
</script>

<template>
  <Head title="Email Verification" />

  <Sonner position="top-right" />
  <div class="relative flex h-screen items-center justify-center">
    <div
      class="absolute h-full w-full bg-[radial-gradient(theme(colors.border/90%)_1px,transparent_1px)] [background-size:20px_20px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_60%,transparent_100%)]"
    />
    <div class="relative w-full max-w-[380px] px-5">
      <div
        class="mx-auto mb-6 flex size-14 items-center justify-center rounded-lg border bg-background"
      >
        <MailCheck class="size-8" />
      </div>
      <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">
          Check your email
        </h1>
      </div>

      <div class="my-4 text-sm text-gray-600 dark:text-gray-400">
        We sent you a mail to <span class="font-semibold">{{ user.email }}</span>. If you didn't receive the email, we will gladly send you another.
      </div>

      <form @submit.prevent="submit">
        <div class="mt-6 ">
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full"
            type="submit"
          >
            Resend Verification Email
          </Button>
          <div>
            <div class="mt-4 text-center text-sm text-muted-foreground">
              <Link
                :href="route('logout')"
                class="font-semibold text-primary underline-offset-2 hover:underline"
                method="post"
              >
                Logout
              </Link>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
