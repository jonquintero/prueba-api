<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"> <el-button type="primary" @click="clickCreate">BUSCAR</el-button></div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Colleccion</th>
                                    <th class="text-center">Encontrado en</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-if="lists" v-for="(task, index) in lists" :key="index" :id="index">
                                    <td class="text-center"><span>{{ task.name }}</span></td>
                                    <td class="text-center"><span>{{ task.category }}</span></td>
                                    <td class="text-center"><span>{{ task.collection }}</span></td>
                                    <td class="text-center"><span><img :src="task.find" alt="" style="width: 50px; height: 50px"></span></td>
                                </tr>
                                <tr v-else>
                                    <td colspan="8">No hay registro !!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <search-form :showDialog.sync="showDialog"></search-form>
    </div>
</template>

<script>
    import SearchForm from "./SearchFormComponent";

    export default {
        name: "SearchListComponent",
        components: {SearchForm},

        data(){
            return {
                mute: false,
                lists: [],
                showDialog: false,
            }
        },
        created: function(){
            this.$eventHub.$on('reloadData', (lists) => {
              this.lists = lists;
            });


        },
        methods: {
            clickCreate() {
               this.showDialog = true
            },

        }
    }
</script>

<style scoped>

</style>
