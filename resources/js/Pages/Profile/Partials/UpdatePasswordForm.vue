<script setup>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const passwordInput = ref (null)
const currentPasswordInput = ref (null)

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

function updatePassword() {
  // eslint-disable-next-line no-undef
  form.put(route('password.update'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    },
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value?.focus()
      }
      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value?.focus()
      }
    },
  })
}
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="flex justify-between md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium">
          Update Password
        </h3>

        <p class="mt-1 text-sm">
          Ensure your account is using a long, random password to stay
          secure.
        </p>
      </div>
    </div>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <form @submit.prevent="updatePassword">
        <div class="  bg-background px-4 py-5  sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">
              <Label for="current_password">Current Password</Label>
              <Input
                id="current_password"
                ref="currentPasswordInput"
                v-model="form.current_password"
                type="password"
                class="mt-1 block w-full" autocomplete="current-password"
              />
              <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <Label for="password">New Password</Label>
              <Input
                id="password" ref="passwordInput" v-model="form.password" type="password"
                class="mt-1 block w-full" autocomplete="new-password"
              />
              <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <Label for="password_confirmation">Confirm Password</Label>
              <Input
                id="password_confirmation" v-model="form.password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password"
              />
              <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>
          </div>

          <div

            class="flex items-center  bg-background my-6 text-end sm:rounded-b-md"
          >
            <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Save
            </Button>
            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p
                v-if="form.recentlySuccessful"
                class="text-sm text-gray-600"
              >
                Saved.
              </p>
            </Transition>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
