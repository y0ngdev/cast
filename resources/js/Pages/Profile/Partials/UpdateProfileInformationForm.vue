<script setup>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const user = usePage().props.auth.user

const form = useForm({
  name: user.name,
  email: user.email,
})

const verificationLinkSent = ref(false)
function sendEmailVerification() {
  verificationLinkSent.value = true
}
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="flex justify-between md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium">
          Profile Information
        </h3>

        <p class="mt-1 text-sm">
          Update your account's profile information and email address.
        </p>
      </div>
    </div>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <form @submit.prevent="form.patch(route('profile.update'))">
        <div class="  bg-background px-4 py-5  sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
              <Label for="name">Name</Label>
              <Input
                id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                autocomplete="name"
              />
              <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <Label for="email">Email</Label>
              <Input
                id="email"
                v-model="form.email"
                disabled
                type="email"
                class="mt-1 block w-full"
                required
                autocomplete="username"
              />
              <InputError :message="form.errors.email" class="mt-2" />

              <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm">
                  Your email address is unverified.

                  <Link
                    :href="route('verification.send')" method="post" as="button"
                    class="rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2"
                    @click.prevent="sendEmailVerification"
                  >
                    Click here to re-send the verification email.
                  </Link>
                </p>

                <div v-show="verificationLinkSent" class="mt-2 text-sm font-medium">
                  A new verification link has been sent to your email address.
                </div>
              </div>
            </div>
          </div>
        </div>

        <div

          class="flex items-center  bg-background py-3 text-end sm:rounded-b-md"
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
      </form>
    </div>
  </div>
</template>
