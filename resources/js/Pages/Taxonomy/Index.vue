<script lang=ts setup>
import { Badge } from '@/Components/shadcn/ui/badge'
import { Button } from '@/Components/shadcn/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuTrigger,
} from '@/Components/shadcn/ui/dropdown-menu'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/shadcn/ui/table'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Link } from '@inertiajs/vue3'
import { CirclePlus, MoreHorizontal } from 'lucide-vue-next'
</script>

<template>
  <DashboardLayout title="Manage Taxonomy ">
    <template #header>
      Taxonomy
    </template>
    <template #description>
      Manage your categories.
    </template>
    <template #button>
      <Link :href="route('taxonomy.create')">
        <Button
          type="button"
        >
          <CirclePlus height="24" width="24" />
          Add Taxonomy
        </Button>
      </Link>
    </template>
    <template #content>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead class="hidden w-[100px] sm:table-cell">
              <span class="sr-only">img</span>
            </TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Status</TableHead>
            <TableHead class="hidden md:table-cell">
              Price
            </TableHead>
            <TableHead class="hidden md:table-cell">
              Total Sales
            </TableHead>
            <TableHead class="hidden md:table-cell">
              Created at
            </TableHead>
            <TableHead>
              <span class="sr-only">Actions</span>
            </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow>
            <TableCell class="hidden sm:table-cell">
              <img
                alt="Product image"
                class="aspect-square rounded-md object-cover"
                height="64"
                src="/placeholder.svg"
                width="64"
              >
            </TableCell>
            <TableCell class="font-medium">
              Laser Lemonade Machine
            </TableCell>
            <TableCell>
              <Badge variant="outline">
                Draft
              </Badge>
            </TableCell>
            <TableCell class="hidden md:table-cell">
              $499.99
            </TableCell>
            <TableCell class="hidden md:table-cell">
              25
            </TableCell>
            <TableCell class="hidden md:table-cell">
              2023-07-12 10:42 AM
            </TableCell>
            <TableCell>
              <DropdownMenu>
                <DropdownMenuTrigger as-child>
                  <Button
                    aria-haspopup="true"
                    size="icon"
                    variant="ghost"
                  >
                    <MoreHorizontal class="h-4 w-4" />
                    <span class="sr-only">Toggle menu</span>
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                  <DropdownMenuLabel>Actions</DropdownMenuLabel>
                  <DropdownMenuItem>Edit</DropdownMenuItem>
                  <DropdownMenuItem>Delete</DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </template>
  </DashboardLayout>
</template>
