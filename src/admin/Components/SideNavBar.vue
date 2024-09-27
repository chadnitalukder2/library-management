<template>
     <div class="lmt-side-navbar-wrapper" :style="{ width: width }">
        <ul class="lmt-side-navbar">
            <li v-for="route in routes" :key="route.label">
                <router-link :to="route.to">
                    <span>{{ route.label }}</span>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>

export default{
    name: "SideNavBar",

    props: {
        routes: {
            type: Array,
            required: true
        },
        width: {
            type: String,
            default: "200px"
        }  
    }

}


</script>