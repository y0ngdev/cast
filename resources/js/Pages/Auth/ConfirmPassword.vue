<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import InputError from '@/Components/InputError.vue'
import Button from '@/Components/shadcn/ui/button/Button.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/shadcn/ui/card'
import Input from '@/Components/shadcn/ui/input/Input.vue'
import Label from '@/Components/shadcn/ui/label/Label.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { inject, ref } from 'vue'

const route = inject('route')
const form = useForm({
  password: '',
})

const passwordInput = ref(null)

function submit() {
  form.post(route('password.confirm'), {
    onFinish: () => {
      form.reset()
      passwordInput.value.focus()
    },
  })
}
</script>

<template>
  <Head title="Secure Area" />

  <div class="flex min-h-screen flex-col items-center justify-center">
    <Card class="mx-auto max-w-lg">
      <CardHeader>
        <CardTitle class="flex justify-center">
          <ApplicationLogo />
        </CardTitle>
        <CardDescription class="text-center text-2xl">
          Confirm your password
        </CardDescription>
      </CardHeader>

      <CardContent>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
          This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
          <div class="grid gap-4">
            <div class="grid gap-2">
              <Label for="password">Password</Label>
              <Input
                id="password" ref="passwordInput" v-model="form.password" autocomplete="current-password" autofocus
                required type="password"
              />
              <InputError :message="form.errors.password" />
            </div>

            <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
              Confirm
            </Button>
          </div>
        </form>
      </CardContent>
    </Card>
  </div>
</template>
