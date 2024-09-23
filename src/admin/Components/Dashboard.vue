<template>
    <div>
        <!-- example content  start -->
        <el-container>
            <el-header>
                <h1>This is the plugin main Dashboard</h1>
            </el-header>
         
        </el-container>
        <!-- example content end -->
    </div>
</template>
<script>
export default {
    name: 'Dashboard',
    data(){
        return {
            vueJs: 'https://vuejs.org/'
        }
    },
    methods: {
        reDirrect() {
          window.open(this.vueJs, "_blank");    
        }
    }
}
</script>

