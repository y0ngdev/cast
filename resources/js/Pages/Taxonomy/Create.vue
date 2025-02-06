<script setup lang=ts>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Link } from '@inertiajs/vue3'
import { CirclePlus } from 'lucide-vue-next'
</script>

<template>
  <DashboardLayout>
    <div>
      <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
        <div class="flex justify-between mt-6">
          <div>
            <div class="text-2xl font-medium">
              Taxonomy
            </div>
            <p class="mt-2 text-sm text-muted-foreground">
              View all Categories
            </p>
          </div>

          <Link :href="route('taxonomy.create')">
            <Button
              type="button" variant=""
            >
              <CirclePlus height="24" width="24" />
              Add Taxonomy
            </Button>
          </Link>
        </div>
        <Card>
          <CardHeader>
            <CardTitle>Products</CardTitle>
            <CardDescription>
              Manage your products and view their sales performance.
            </CardDescription>
          </CardHeader>
          <CardContent />
          <CardFooter>
            <div class="text-xs text-muted-foreground">
              Showing <strong>1-10</strong> of <strong>32</strong>
              products
            </div>
          </CardFooter>
        </Card>
      </main>
    </div>
  </DashboardLayout>
</template>
