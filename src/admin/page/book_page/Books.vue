<template>
    <div class="lmt_books_wrapper">
        <SideNavBar :routes="routes"/>
        <div class="lmt_books_content_wrapper">
            <router-view></router-view>
        </div>
    </div>
   
</template>
<script>
import SideNavBar from '../../Components/SideNavBar.vue';

export default{
    components: {
        SideNavBar
    },
  data(){
    return{
        routes: [
            {
                label: 'All Books',
                to: '/books/'
            },
            {
                label: 'Category',
                to: '/books/category'
            }
        ]
    }
  }

}
</script>