<script setup lang=ts>
import InputError from '@/Components/InputError.vue'
import { Button } from '@/Components/shadcn/ui/button'
import { Input } from '@/Components/shadcn/ui/input'
import { Label } from '@/Components/shadcn/ui/label'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  slug: '',
  order: false,
})

function submit() {
  // eslint-disable-next-line no-undef
  form.post(route('taxonomy.store'), {
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <DashboardLayout title="Create Taxonomy">
    <template #header>
      Create  Taxonomy
    </template>
    <template #description>
      This are some sort of category grouping for the series
    </template>

    <template #content>
      <form class="" @submit.prevent="submit">
        <div class="grid gap-4">
          <!-- Email Field -->
          <div class="grid gap-2">
            <Label for="email">Name</Label>
            <Input
              id="name" v-model="form.name" :disabled="form.processing"
              autofocus
              placeholder="" required
              type="text"
            />
            <InputError :message="form.errors.name" />
          </div>

          <!-- Password Field -->
          <div class="grid gap-2">
            <Label for="password">Slug</Label>
            <Input
              id="slug" v-model="form.slug" :disabled="form.processing"
              required
              type="text"
            />
            <InputError :message="form.errors.slug" />
          </div><div class="grid gap-2">
            <Label for="password">Order</Label>
            <Input
              id="order" v-model="form.order" :disabled="form.processing"
              required
              type="number"
            />
            <InputError :message="form.errors.order" />
          </div>

          <!-- Submit Button -->
          <Button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-min"
            type="submit"
          >
            Submit
          </Button>
        </div>
      </form>
    </template>
  </DashboardLayout>
</template>
