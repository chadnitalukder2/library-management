<template>
    <div>
        <Plus v-if="icon === 'lmt-plus'" />
        <Cancel v-if="icon === 'lmt-cancel'" />
        <Edit v-if="icon === 'lmt-edit'" />
        <Delete v-if="icon === 'lmt-delete'" />
        <Eye v-if="icon === 'lmt-eye'" />
        <Money v-if="icon === 'lmt-money'" />
        <Pending v-if="icon === 'lmt-pending'" />
    </div>

  </template>
  

<script>
import Plus from "./Plus.vue";
import Cancel from "./Cancel.vue";
import Edit from "./Edit.vue";
import Delete from "./Delete.vue";
import Eye from "./Eye.vue";
import Money from "./Money.vue";
import Pending from "./PendingIcon.vue";

export default {
    components: {
        Plus,
        Cancel,
        Edit,
        Delete,
        Eye,
        Money,
        Pending
    },
    props: {
        icon: {
            type: String,
        }
    }
}
</script>