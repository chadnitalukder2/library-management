<template>
    <div id="library-management_app">
        <div class="library-management_main_nav">
            <div class="topnav">
                <router-link v-for="menuItem in topMenus" :key="menuItem.route" active-class="ninja-tab-active" exact :class="['ninja-tab']" :to="{ name: menuItem.route }">
                    {{ menuItem.title }}
                </router-link>
            </div>

        </div>
       <router-view></router-view>
    </div>
</template>

<script>
  export default {
      name: 'AdminApp',
      data() {
          return {
              topMenus: []
          }
      },
      methods: {
          setTopmenu() {
              this.topMenus = this.applyFilters('library-management_top_level_menu', [
                  {
                      route: 'dashboard',
                      title: 'Dashboard'
                  },
                  {
                      route: 'settings',
                      title: 'Settings'
                  },
                  {
                      route: 'supports',
                      title: 'Supports'
                  }
              ])
          }
      },
      mounted() {
          this.setTopmenu();
      }
  }
</script>
