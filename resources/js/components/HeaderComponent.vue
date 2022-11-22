<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1" v-text="taskId"></span>
                <slot></slot>
                <div>
                    <router-link v-bind:to="{name: 'task.list'}">
                        <button class="btn btn-success">List</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'task.create'}">
                        <button class="btn btn-success">ADD</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            taskId: String
        },

    }
</script>
