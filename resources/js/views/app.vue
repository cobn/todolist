<template>
    <div>
<Navitem></Navitem>       <div class="row justify-content-center" style="margin:20px;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header d-flex justify-content-between align-items-center">
Your Todo List
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal2">Add Task</button>
                        </h5></div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(tag,index) in laravelData.data"  :key="index" style="height:auto;"><p class="w-75">{{ tag.content }}</p><span class="badge  badge-pill">
<span @click="edit(index)" data-toggle="modal" data-target="#exampleModal" id="tag.id"><i class="fas fa-edit fa-lg"  ></i></span>
                            <span @click="deleteitem(index)" focusable="true">  <i class="fas fa-trash fa-lg" ></i></span>
                                <label class="switch">
<input type="checkbox" :checked="tag.state==1" @click="updatestate(index)">
  <span  class="slider round"></span>

</label>
</span>
                            </li>
                        </ul>
                        <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Content:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  @click="submitedit"  class="btn btn-primary">Edit task</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Edit task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Content:</label>
                                <textarea class="form-control" id="message-text2"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="additem" class="btn btn-primary">Add task</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
import Navitem from './nav.vue'

export default {
    metaInfo: {
        title: 'Homepage'
    },
    mounted() {
        console.log('Component mounted.');
        lastindex:"";
    },
    components: {
        'Navitem': Navitem
    },
    data() {
        return {
            laravelData: {},

        }
    },
    created() {
        this.getResults();

    },
    methods: {
        getResults(page) {
            console.log(this.$store.state.token );
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.$axios.post('/api/getitems?page=' + page, {}, {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.token //the token is a variable which holds the token
                    }
                }
            ).then(response => {
                this.laravelData = response.data;
            });


        },
        edit(index){
this.lastindex=index;
            document.getElementById("message-text").value = this.laravelData.data[index].content;

        },
        submitedit(){
            this.$axios.post('/api/edititem', {

                    "content1":  document.getElementById("message-text").value,
                    "id": this.laravelData.data[this.lastindex].id,
                }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.token //the token is a variable which holds the token
                    }
                }
            ).then(response => {
                this.laravelData.data[this.lastindex].content=document.getElementById("message-text").value;
$("#exampleModal").modal('toggle');
            });
        },
        additem(){
            this.$axios.post('/api/createitem', {
"content1":document.getElementById("message-text2").value
                }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.token //the token is a variable which holds the token
                    }
                }
            ).then(response => {
                this.laravelData.data.push(response.data);
                $("#exampleModal2").modal('toggle');
                document.getElementById("message-text2").value="";


            });

        },

        deleteitem(index) {
            this.$axios.post('/api/deleteitem', {

                    "id": this.laravelData.data[index].id,
                }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.token //the token is a variable which holds the token
                    }
                }
            ).then(response => {
                this.laravelData.data.splice(index, 1);

            });
        },
        updatestate(index) {
            this.$axios.post('/api/updatestate', {
'id':this.laravelData.data[index].id,
                    "state": (this.laravelData.data[index].state==0) ? 1 : 0,
                }, {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.token //the token is a variable which holds the token
                    }
                }
            ).then(response => {
                this.laravelData.data[index].state=!(this.laravelData.data[index].state)? 0 : 1;
            });
        }
    },
    computed: {
        inputValue: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('updated', val);
            }
        }
    }
}
</script>
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 17px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 13px;
    width: 13px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(13px);
    -ms-transform: translateX(13px);
    transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 17px;
}

.slider.round:before {
    border-radius: 50%;
}
span{
    cursor:pointer;
}
</style>
