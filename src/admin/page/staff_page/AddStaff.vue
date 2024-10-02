<template>
    <div class="lmt_form_wrapper">

        <div class="input-wrapper">
            <p class="form-label" for="name"> Name *</p>
            <el-input class="lmt_input" v-model="staffs.name" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ name_error }}</p>
        </div>
        <div class="input-wrapper">
            <p class="form-label" for="name">Email *</p>
            <el-input class="lmt_input" v-model="staffs.email" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ email_error }}</p>
        </div>
        <div class="input-wrapper">
            <p class="form-label" for="name">Phone *</p>
            <el-input class="lmt_input" v-model="staffs.phone" style="width: 100%" placeholder="Please Input" size="large" />
            <p class="error-message">{{ phone_error }}</p>
        </div>
        <div class="input-wrapper">
            <p class="form-label" for="name">Address *</p>
            <el-input class="lmt_input" v-model="staffs.address" style="width: 100%" placeholder="Please Input" size="large" />
        </div>
       
        <div class="input-wrapper">
            <p class="form-label" for="name">Role  *</p>
            <el-select class="lmt_input" v-model="staffs.role" placeholder="Discount Type" size="large"style="width: 100%">
                <el-option label="Admin" value="admin" />
                <el-option label="Librarian" value="librarian" />
            </el-select>
            <p class="error-message">{{ role_error }}</p>
        </div>

        <div class="input-wrapper">
            <p class="form-label" for="name">Joined Date *</p>
            <el-date-picker class="lmt_input" v-model="staffs.joined_date" type="date" style="width: 100%"
            placeholder="Start Date " size="large" />
        </div>
      
<br>

        <div class="input-wrapper" @click="saveStaffs()">
            <el-button size="large" type="primary">Save Staff</el-button>
        </div>

    </div>
</template>

<script>

export default {

   
    data() {
        return {
            staffs: {
                name: "",
                email: "",
                phone: "",
                address: "",
                role: "",
                joined_date: "",
            },
            name_error: "",
            email_error: "",
            phone_error: "",
            role_error: "",
        }
    },
    props: {
        staffs_data: {
            type: Object,
        }
    },
    watch: {
        // Its required to watch the staffs_data to update the category object
        staffs_data: {
            handler: function (val) {
                this.staffs = val;
            },
            deep: true
        }
    },
    methods:{
        saveStaffs(){
            this.name_error = "";
            this.phone_error = "";
            this.email_error = "";
            this.role_error = "";
            if (this.staffs.name === "") {
                this.name_error = "Staff Name is required";
                return;
            }
            if (this.staffs.email === "") {
                this.email_error = "Staff Name is required";
                return;
            }
            if (this.staffs.phone === "") {
                this.phone_error = "Staff Name is required";
                return;
            }
            if (this.staffs.role === "") {
                this.role_error = "Staff Name is required";
                return;
            }
            

            jQuery
            .post(ajaxurl, {
                action: "lmt_staffs",
                route: "post_staffs",
                lmt_admin_nonce: window.libraryManagementAdmin.lmt_admin_nonce,
                data: this.staffs
            }).then((response) => {
                console.log(response);
                this.$emit("updateDataAfterNewAdd", this.staffs);
                this.staffs = {
                    name: "",
                    email: "",
                    phone: "",
                    address: "",
                    role: "",
                    joined_date: "",
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
        if (this.staffs_data) {
            this.staffs = this.staffs_data;
        }
    }
  
  
}
</script>