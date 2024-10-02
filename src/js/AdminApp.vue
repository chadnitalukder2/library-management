<template>
    <div id="library-management_app" class="lmt-admin-page">
            <div class="lmt-main-menu">
                <div class="lmt-menu-logo">
                    <h3>Library Management</h3>
                </div>
                <div class="menu-item">
                     <router-link class="lmt-menu-item" to="/books" >
                        Books
                    </router-link>
                    <router-link class="lmt-menu-item" to="/members" >
                        Members
                    </router-link>
                    <router-link class="lmt-menu-item" to="/settings" >
                        Settings
                    </router-link>
                </div>
            </div>
       <router-view></router-view>
    </div>
</template>

<script>
 
</script>
