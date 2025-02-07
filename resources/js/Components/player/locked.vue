<script setup lang="ts">
import { Button } from '@/Components/shadcn/ui/button'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="container rounded relative z-0 sm:p-8 grid sm:aspect-video w-full place-items-center">
    <!-- Image -->
    <img class="absolute inset-0 -z-10 h-full w-full rounded-xl object-cover blur-[5px]" src="video_frame.png" alt="">

    <!-- Overlay Component -->

    <div class="relative w-full max-w-xl overflow-hidden h-72 bg-background text-center shadow-2xl">
      <div class="grid place-items-center" />
      <div
        class="mx-auto mb-6 flex size-14 items-center justify-center  "
      >
        <!--                  <MailCheck class="size-8" /> -->
      </div>
      <!-- Title -->
      <div class="space-y-2 pt-5 text-center">
        <div class="text-xl lg:text-3xl  font-medium">
          Authentication needed!
        </div>
        <div class="lg:text-lg font-medium ">
          Sign in to access this content.
        </div>
      </div>
      <Button class="relative mt-8 inline-flex items-center gap-3 px-5">
        <Link :href="route('login')">
          Login
        </Link>
      </Button>
    </div>
  </div>
</template>

<style scoped>

</style>
