<template>
    <div class="lmt_form_wrapper">

        <div class="input-wrapper">
            <p class="form-label" for="name">Borrow Status *</p>
            <el-select class="lmt_input" v-model="borrow_record.status" placeholder=" Select One" size="large"style="width: 100%">
                <el-option label="Borrowed" value="borrowed" />
                <el-option label="Returned" value="returned" />
                <el-option label="Overdue" value="overdue" />
            </el-select>
        </div>
    <br>

        <div class="input-wrapper" @click="saveBorrow()">
            <el-button size="large" type="primary">Save Borrow</el-button>
        </div>

    </div>
</template>

<script>

export default {

   
    data() {
        return {
            borrow_record: {
              status : "",
            },
        }
    },
    props: {
        borrow_data: {
            type: Object,
        }
    },
    watch: {
        // Its required to watch the borrow_data to update the category object
        borrow_data: {
            handler: function (val) {
                this.borrow_record = val;
            },
            deep: true
        }
    },
    methods:{
        saveBorrow(){
         
            jQuery
            .post(ajaxurl, {
                action: "lmt_borrow_record",
                route: "post_borrow_record",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                data: this.borrow_record
            }).then((response) => {
                console.log(response);
                this.$emit("updateDataAfterNewAdd", this.borrow_record);
                this.borrow_record = {
                   status : ""
                };
                this.$notify({
                    title: 'Success',
                    message: response.data,
                    type: 'success',
                    position: 'bottom-right',
                })
                
            });
          
        }
    },
  
    mounted() {
        if (this.borrow_data) {
            this.borrow_record = this.borrow_data;
        }
    }
  
  
}
</script>