<script setup>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/shadcn/ui/dialog'
import { Input } from '@/Components/shadcn/ui/input'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref (null)

const form = useForm({
  password: '',
})

function deleteUser() {
  // eslint-disable-next-line no-undef
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => {
      form.reset()
    },
  })
}

function closeModal() {
  confirmingUserDeletion.value = false

  form.clearErrors()
  form.reset()
}
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="flex justify-between md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium">
          Delete Account
        </h3>
      </div>
    </div>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
        your account, please download any data or information that you wish to retain.
      </div>

      <span>
        <Dialog v-model:open="confirmingUserDeletion">
          <DialogTrigger>
            <Button class="mt-4" variant="destructive">
              Delete Account
            </Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Delete Account</DialogTitle>
              <DialogDescription>
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.
              </DialogDescription>

            </DialogHeader>

            <div class="mt-4">
              <Input
                ref="passwordInput"
                v-model="form.password"
                autocomplete="current-password"
                class="mt-1 block"
                placeholder="Password"
                type="password"
                @keyup.enter="deleteUser"
              />

              <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <DialogFooter class="mt-4">
              <DialogClose as-child>
                <Button variant="secondary" @click="closeModal">
                  Cancel
                </Button>
              </DialogClose>

              <Button
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ms-3"
                @click="deleteUser"
              >
                Delete Account
              </Button>
            </DialogFooter>

          </DialogContent>
        </Dialog>
      </span>
    </div>
  </div>
</template>
