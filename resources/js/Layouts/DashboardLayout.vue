<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/Components/shadcn/ui/avatar'

import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbList,
  BreadcrumbSeparator,
} from '@/Components/shadcn/ui/breadcrumb'

import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/Components/shadcn/ui/collapsible'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuTrigger,
} from '@/Components/shadcn/ui/dropdown-menu'
import { Separator } from '@/Components/shadcn/ui/separator'
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarGroupLabel,
  SidebarHeader,
  SidebarInset,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarMenuSub,
  SidebarMenuSubButton,
  SidebarMenuSubItem,
  SidebarProvider,
  SidebarRail,
  SidebarTrigger,
} from '@/Components/shadcn/ui/sidebar'
import { Link, usePage } from '@inertiajs/vue3'
import {
  AudioWaveform,
  BadgeCheck,
  Bell,
  BookOpen,
  Bot,
  ChevronRight,
  ChevronsUpDown,
  Command,
  CreditCard,
  GalleryVerticalEnd,
  LogOut,
  Plus,
  Settings2,
  Sparkles,
  SquareTerminal,
} from 'lucide-vue-next'
import { computed, ref } from 'vue'

// This is sample data.
const data = {
  user: {
    name: 'shadcn',
    email: 'm@example.com',
    avatar: '/avatars/shadcn.jpg',
  },
  teams: [
    {
      name: 'Acme Inc',
      logo: GalleryVerticalEnd,
      plan: 'Enterprise',
    },
    {
      name: 'Acme Corp.',
      logo: AudioWaveform,
      plan: 'Startup',
    },
    {
      name: 'Evil Corp.',
      logo: Command,
      plan: 'Free',
    },
  ],
  navMain: [

    {
      title: 'Overview',
      url: '#',
      icon: SquareTerminal,
      collapsible: false,
    },
    {
      title: 'Users',
      url: '#',
      icon: SquareTerminal,
      collapsible: false,
    },
    {
      title: 'Taxonomy',
      url: '#',
      icon: SquareTerminal,
      // isActive: ,
      collapsible: true,
      items: [
        {
          title: 'Manage Categories',
          // eslint-disable-next-line no-undef
          url: route('taxonomy.index'),
        },
        {
          title: 'Manage Topics',
          url: '#',
        },

      ],
    },
    {
      title: 'Models',
      url: '#',
      icon: Bot,
      collapsible: true,
      items: [
        {
          title: 'Genesis',
          url: '#',
        },
        {
          title: 'Explorer',
          url: '#',
        },
        {
          title: 'Quantum',
          url: '#',
        },
      ],
    },
    {
      title: 'Documentation',
      url: '#',
      icon: BookOpen,
      collapsible: true,
      items: [
        {
          title: 'Introduction',
          url: '#',
        },
        {
          title: 'Get Started',
          url: '#',
        },
        {
          title: 'Tutorials',
          url: '#',
        },
        {
          title: 'Changelog',
          url: '#',
        },
      ],
    },
    {
      title: 'Settings',
      url: '#',
      icon: Settings2,
      collapsible: false,
      items: [
        {
          title: 'General',
          url: '#',
        },
        {
          title: 'Team',
          url: '#',
        },
        {
          title: 'Billing',
          url: '#',
        },
        {
          title: 'Limits',
          url: '#',
        },
      ],
    },
  ],
}

const activeTeam = ref(data.teams[0])

function setActiveTeam(team) {
  activeTeam.value = team
}

const page = usePage()

// Generate breadcrumbs dynamically based on the URL path
const breadcrumbs = computed(() => {
  const pathSegments = page.url.split('/').filter(segment => segment)
  let fullPath = ''

  return pathSegments.map((segment, index) => {
    fullPath += `/${segment}`
    return {
      label: segment.charAt(0).toUpperCase() + segment.slice(1),
      path: fullPath,
      isLast: index === pathSegments.length - 1, // Check if it's the last breadcrumb
    }
  })
})
</script>

<template>
  <SidebarProvider>
    <Sidebar collapsible="icon">
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <SidebarMenuButton
                  class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                  size="lg"
                >
                  <div
                    class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground"
                  >
                    <component :is="activeTeam.logo" class="size-4" />
                  </div>
                  <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{ activeTeam.name }}</span>
                    <span class="truncate text-xs">{{ activeTeam.plan }}</span>
                  </div>
                  <ChevronsUpDown class="ml-auto" />
                </SidebarMenuButton>
              </DropdownMenuTrigger>
              <DropdownMenuContent
                :side-offset="4"
                align="start"
                class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
                side="bottom"
              >
                <DropdownMenuLabel class="text-xs text-muted-foreground">
                  Teams
                </DropdownMenuLabel>
                <DropdownMenuItem
                  v-for="(team, index) in data.teams"
                  :key="team.name"
                  class="gap-2 p-2"
                  @click="setActiveTeam(team)"
                >
                  <div class="flex size-6 items-center justify-center rounded-sm border">
                    <component :is="team.logo" class="size-4 shrink-0" />
                  </div>
                  {{ team.name }}
                  <DropdownMenuShortcut>⌘{{ index + 1 }}</DropdownMenuShortcut>
                </DropdownMenuItem>
                <DropdownMenuSeparator />
                <DropdownMenuItem class="gap-2 p-2">
                  <div
                    class="flex size-6 items-center justify-center rounded-md border bg-background"
                  >
                    <Plus class="size-4" />
                  </div>
                  <div class="font-medium text-muted-foreground">
                    Add team
                  </div>
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel />
          <SidebarMenu>
            <div
              v-for="item in data.navMain"
              :key="item.title"
            >
              <template v-if="!item.collapsible">
                <SidebarMenuItem class="my-1">
                  <SidebarMenuButton as-child>
                    <Link :href="item.url">
                      <component :is="item.icon" />
                      <span>{{ item.title }}</span>
                    </Link>
                  </SidebarMenuButton>
                </SidebarMenuItem>
              </template>
              <template v-else>
                <Collapsible

                  :default-open="item.isActive"
                  as-child
                  class="group/collapsible"
                >
                  <SidebarMenuItem>
                    <CollapsibleTrigger as-child>
                      <SidebarMenuButton :tooltip="item.title">
                        <component :is="item.icon" />
                        <span>{{ item.title }}</span>
                        <ChevronRight
                          class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90"
                        />
                      </SidebarMenuButton>
                    </CollapsibleTrigger>
                    <CollapsibleContent>
                      <SidebarMenuSub>
                        <SidebarMenuSubItem
                          v-for="subItem in item.items"
                          :key="subItem.title"
                        >
                          <SidebarMenuSubButton as-child>
                            <Link :href="subItem.url">
                              <span>{{ subItem.title }}</span>
                            </Link>
                          </SidebarMenuSubButton>
                        </SidebarMenuSubItem>
                      </SidebarMenuSub>
                    </CollapsibleContent>
                  </SidebarMenuItem>
                </Collapsible>
              </template>
            </div>
          </SidebarMenu>
        </SidebarGroup>
      </SidebarContent>
      <SidebarFooter>
        <SidebarMenu>
          <SidebarMenuItem>
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <SidebarMenuButton
                  class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                  size="lg"
                >
                  <Avatar class="h-8 w-8 rounded-lg">
                    <AvatarImage :alt="data.user.name" :src="data.user.avatar" />
                    <AvatarFallback class="rounded-lg">
                      CN
                    </AvatarFallback>
                  </Avatar>
                  <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{ data.user.name }}</span>
                    <span class="truncate text-xs">{{ data.user.email }}</span>
                  </div>
                  <ChevronsUpDown class="ml-auto size-4" />
                </SidebarMenuButton>
              </DropdownMenuTrigger>
              <DropdownMenuContent
                :side-offset="4"
                align="end" class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg" side="bottom"
              >
                <DropdownMenuLabel class="p-0 font-normal">
                  <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                    <Avatar class="h-8 w-8 rounded-lg">
                      <AvatarImage :alt="data.user.name" :src="data.user.avatar" />
                      <AvatarFallback class="rounded-lg">
                        CN
                      </AvatarFallback>
                    </Avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                      <span class="truncate font-semibold">{{ data.user.name }}</span>
                      <span class="truncate text-xs">{{ data.user.email }}</span>
                    </div>
                  </div>
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuGroup>
                  <DropdownMenuItem>
                    <Sparkles />
                    Upgrade to Pro
                  </DropdownMenuItem>
                </DropdownMenuGroup>
                <DropdownMenuSeparator />
                <DropdownMenuGroup>
                  <DropdownMenuItem>
                    <BadgeCheck />
                    Account
                  </DropdownMenuItem>
                  <DropdownMenuItem>
                    <CreditCard />
                    Billing
                  </DropdownMenuItem>
                  <DropdownMenuItem>
                    <Bell />
                    Notifications
                  </DropdownMenuItem>
                </DropdownMenuGroup>
                <DropdownMenuSeparator />
                <DropdownMenuItem>
                  <LogOut />
                  Log out
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarFooter>
      <SidebarRail />
    </Sidebar>
    <SidebarInset>
      <header
        class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12"
      >
        <div class="flex items-center gap-2 px-4">
          <SidebarTrigger class="-ml-1" />
          <Separator class="mr-2 h-4" orientation="vertical" />

          <Breadcrumb>
            <BreadcrumbList>
              <template v-for="(breadcrumb, index) in breadcrumbs" :key="breadcrumb.path">
                <BreadcrumbSeparator v-if="index > 0" />
                <BreadcrumbItem>
                  <Link
                    v-if="!breadcrumb.isLast"
                    :href="breadcrumb.path"
                    class="hover:text-black"
                  >
                    {{ breadcrumb.label }}
                  </Link>
                  <span v-else class="text-black">{{ breadcrumb.label }}</span>
                </BreadcrumbItem>
              </template>
            </BreadcrumbList>
          </Breadcrumb>
        </div>
      </header>
      <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
        <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
          <div class="flex justify-between items-center mt-6 mb-4">
            <div class="text-start">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">
                <slot name="header" />
              </h3>
              <p class="text-sm text-muted-foreground pt-2">
                <slot name="description" />
              </p>
            </div>
            <slot name="button" />
          </div>
          <div>
            <slot name="content" />
          </div>
        </main>
      </div>
    </SidebarInset>
  </SidebarProvider>
</template>
